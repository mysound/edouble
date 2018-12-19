<?php

namespace App\Http\Controllers;

use App\Address;
use App\State;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AddressesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.addresses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.addresses.create', [
            'states' => State::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'state_id'  =>  'required|not_in:0'
        ]);
        
        Auth::user()->addresses()->create($request->all());

       //return redirect()->route('addresses.index');
        return redirect($request->referer);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        return view('user.addresses.edit', [
            'address' => $address,
            'states' => State::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        $this->validate(request(), [
            'state_id'  =>  'required|not_in:0'
        ]);

        Auth::user()->addresses()
                    ->where('id', '=', $address->id)
                    ->update($request->except(['_token', '_method', 'referer']));

        return redirect($request->referer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        Auth::user()->addresses()
                    ->where('id', '=', $address->id)
                    ->delete();

        return redirect()->route('addresses.index');
    }
}
