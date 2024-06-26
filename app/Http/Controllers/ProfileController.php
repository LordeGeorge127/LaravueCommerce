<?php

namespace App\Http\Controllers;

use App\Enums\AddressType;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Country;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Attribute\AsController;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function view(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        /** @var Customer $customer */
        $customer = $user->customer;

//        dd($customer->_getAddresses());
        if ($customer !== null) {
            $shippingAddress = $customer->shippingAddress ?: new CustomerAddress(['type' => AddressType::Shipping]);
            $billingAddress = $customer->billingAddress ?: new CustomerAddress(['type' => AddressType::Billing]);

            //below is for shipping addrss with ()
//            $shippingAddress = $customer->shippingAddress() ?: new CustomerAddress(['type' => AddressType::Shipping]);
//            $billingAddress = $customer->billingAddress() ?: new CustomerAddress(['type' => AddressType::Billing]);

        } else {
            echo 'Customer Not Found';
        }


        $countries = Country::query()->orderBy('name')->get();
//        dd($customer,$shippingAddress,$billingAddress);//        return \view('profile.view', compact('customer', 'user', 'shippingAddress', 'billingAddress', 'countries'));
        return \view('profile.view', compact('customer', 'user', 'shippingAddress', 'billingAddress', 'countries'));
    }

    public function store(ProfileRequest $request)
    {
        $customerData = $request->validated();
        $shippingData = $customerData['shipping'];
        $billingData = $customerData['billing'];

//        dd($shippingData);
        /** @var User $user */
        $user = $request->user();
        /** @var Customer $customer */
        $customer = $user->customer;
        $customer->update($customerData);

        if ($customer->shippingAddress) {
            $customer->shippingAddress->update($shippingData);
        } else {
            $shippingData['customer_id'] = $customer->user_id;
            $shippingData['type'] = AddressType::Shipping->value;
            CustomerAddress::create($shippingData);
        }
        if ($customer->billingAddress) {
            $customer->billingAddress->update($billingData);
        } else {
            $billingData['customer_id'] = $customer->user_id;
            $billingData['type'] = AddressType::Billing->value;
            CustomerAddress::create($billingData);
        }

        $request->session()->flash('flash_message', 'Profile was Successfully Updated ');
        return \redirect()->route('profile');
    }

    public function updatePassword(PasswordUpdateRequest $request)
    {
      /** @var User $user */
        $user = $request->user();

        $passwordData = $request->validated();

        $user->password = Hash::make($passwordData['new_password']);
        $user->save();

        $request->session()->flash('flash_message','Password was updated successfully');
        return \redirect()->route('profile');
    }

}
