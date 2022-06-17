<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * all addresses for user
     *
     * @param User $user
     * @return Response
     */
    public function index(User $user)
    {
        return view("profile.addresses", ["content" => $user->addresses()->get(), "user" => $user]);
    }

    public function new(User $user)
    {
        Address::create(["user_id" => $user->id]);
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function editForm(Address $address)
    {
        return view("profile.edit-address", ["address" => $address]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, Address $address)
    {
        $validated = $request->validate([
            "order_address" => "required",
            "country" => "required|not_in:--Select country--",
        ]);

        $address->update($validated);


        return redirect()->route("addresses.index", ["user" => Auth::user()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Address $adsdress
     * @return Response
     */
    public function destroy(Address $address)
    {
        Address::query()->where("id", "=", $address->id)->delete();
        return redirect()->back();
    }

    /**
     * @param User $user
     */
    public function clear(User $user)
    {
        $user->addresses()->delete();
        return redirect()->back();

    }

    public function showOrders(Address $address)
    {
        return view("profile.address-order", ["content" => $address->orders()->get()]);
    }
}
