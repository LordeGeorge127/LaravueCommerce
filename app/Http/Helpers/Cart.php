<?php

namespace App\Http\Helpers;

use App\Models\CartItem;
use App\Models\Customer;
use App\Models\User;

class Cart
{
    public static function getCartItemsCount(): int
    {
        $request = request();
        $user = $request->user();
        if ($user) {
            return CartItem::where('user_id', $user->id)->sum('quantity');
        } else {
            $cartItems = self::getCookieCartItems();
            return array_reduce(
                $cartItems, fn($carry, $item) => $carry + $item['quantity'],
                0
            );
//            array_reduce(['2', '3', '4'], function($ax, $dx) { return $ax + (int)$dx; }, 1)  // Returns 10
        }
    }

    public static function getCartItems()
    {
        $request = request();
        $user = $request->user();
        if ($user) {
            return CartItem::where('user_id', $user->id)->get()->map(
                fn($item) => ['product_id' => $item->product_id, 'quantity' => $item->quantity]
            );
        }else{
            return self::getCookieCartItems();
        }
    }

    public static function getCookieCartItems()
    {
        $request = request();
        return json_decode($request->cookie('cart_items', '[]'), true);
    }

    public static function getCountFromItems($cartItems)
    {
        return array_reduce(
            $cartItems, fn($carry, $item) => $carry + $item['quantity'], 0
        );
    }
public static function createCustomerFromExistingUser(){
    $request = request();
    $user = $request->user();

    $customer = new Customer();
    $name = explode(" ",$user->name);
    $customer->user_id = $user->id;
    $customer->first_name = $name[0];
    $customer->last_name = $name[1] ?? '';
    $customer->save();
}
    public static function moveCartItemsToDb()
    {
        $request = request();
        $cookiecartItems = self::getCookieCartItems();
        $dbCartItems = CartItem::where(['user_id' => $request->user()->id])->get()->keyBy('product_id');
        $newCartItems = [];
        foreach ($cookiecartItems as $cookiecartItem) {
            if (isset($dbCartItems[$cookiecartItem['product_id']])) {
                continue;
            }
            $newCartItems[] = [
                'user_id' => $request->user()->id,
                'product_id' => $cookiecartItem['product_id'],
                'quantity' => $cookiecartItem['quantity']
            ];

        }
        if (!empty($newCartItems)) {
            CartItem::insert($newCartItems);
        }
    }

}
