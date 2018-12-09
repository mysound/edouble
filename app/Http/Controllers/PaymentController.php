<?php

namespace App\Http\Controllers;

use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\ItemList;
use PayPal\Api\Item;
use PayPal\Api\Transaction;
use PayPal\Api\ShippingAddress;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

use Illuminate\Http\Request;

use App\Order;
use App\Transaction as PaymentStatus;

class PaymentController extends Controller
{
    public function create(Request $request)
    {
    	$apiContext = new \PayPal\Rest\ApiContext(
	        new \PayPal\Auth\OAuthTokenCredential(
	        	config('services.paypal.id'),
	        	config('services.paypal.secret')
	        )
	    );

    	$payer = new Payer();
		$payer->setPaymentMethod("paypal");

		$itemList = new ItemList();

		$order = Order::find($request->orderID);

		//Order shipping_address text
		$order->shipping_address = $order->address->last_name.' '.$order->address->first_name.', '.$order->address->address.', '.$order->address->city.', '.$order->address->state.', '.$order->address->zip_code.', '.$order->address->country_id.', '.$order->address->phone;
		$order->save();

		$products = $order->products;

	    foreach ($products as $product) {
	    	$item = new Item();
	    	$item->setName($product->name.' '.$product->title.' ('.$product->category->title.')')
	    		->setCurrency('USD')
	    		->setQuantity($product->pivot->quantity)
	    		->setSku($product->sku)
	    		->setPrice($product->price);

	    	$itemList->addItem($item);
	    }

	    $amount = new Amount();
		$amount->setCurrency("USD")
		    ->setTotal($order->total);

		$address = new ShippingAddress();
		$address->setCity($order->address->city)
			->setCountryCode('US')
			->setPostalCode($order->address->zip_code)
			->setLine1($order->address->address)
			->setState($order->address->state)
			->setRecipientName($order->address->first_name.' '.$order->address->last_name);
		
		$itemList->setShippingAddress($address);

		$transaction = new Transaction();
		$transaction->setAmount($amount)
		    ->setItemList($itemList)
		    ->setDescription("Payment description")
		    ->setInvoiceNumber(uniqid());

		$redirectUrls = new RedirectUrls();
		$redirectUrls->setReturnUrl("http://127.0.0.1:8000/execute-payment/".$request->orderID)
			->setCancelUrl("http://127.0.0.1:8000");	

		$payment = new Payment();
		$payment->setIntent("sale")
			->setPayer($payer)
			->setRedirectUrls($redirectUrls)
			->setTransactions(array($transaction));

		try {
	        $payment->create($apiContext);
	    } catch (Exception $ex) {
	        echo $ex;
	        exit(1);
	    }

		return redirect($payment->getApprovalLink());

    }

    public function execute(Request $request, Order $order)
    {
    	$apiContext = new \PayPal\Rest\ApiContext(
	        new \PayPal\Auth\OAuthTokenCredential(
	        	config('services.paypal.id'),
	        	config('services.paypal.secret')
	        )
	    );

	    $paymentId = $request->paymentId;
    	$payment = Payment::get($paymentId, $apiContext);
    	$execution = new PaymentExecution();
    	$execution->setPayerId($request->PayerID);

    	$result = $payment->execute($execution, $apiContext);

    	$transactions = $payment->getTransactions();
		$relatedResources = $transactions[0]->getRelatedResources();
		$sale = $relatedResources[0]->getSale();
		$saleId = $sale->getId();
		
    	//$order = Order::find($request->orderID);
    	/*$order->comment = $result->getState().' - '.$result->getId();
	   	$order->save();*/
		
		$payment_status = new PaymentStatus;
		$payment_status->order_id = $order->id;
		$payment_status->payment_id = $payment->getId();
		$payment_status->payment_status = $payment->getState();
		$payment_status->transaction_id = $saleId;
		$payment_status->sale_status = $sale->getState();
		$payment_status->amount = $sale->getAmount()->getTotal();
		$payment_status->transaction_fee = $sale->getTransactionFee()->getValue();
		$payment_status->save();

    	//return $result;
    	return redirect(route('payment-approved'));
    }

    public function approved()
    {
    	return redirect()->route('shop')->with('message', 'Thank you for your purchase!');
    }
}
