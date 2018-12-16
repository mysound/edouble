@include('admin.layouts.errors_admin')

<label>Tracking number</label>
<input type="test" name="shipping_no" value="{{ $order->shipping_no or "" }}">
<input type="hidden" name="order_id" value="{{ $order->id }}">
<br><br>
<input class="btn btn-success" type="submit" value="Save">
<a href="{{ route('admin.order.index') }}" class="btn btn-info">Cancel</a>