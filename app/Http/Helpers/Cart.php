<?php

namespace App\Http\Helpers;

use App\Models\CartItem;

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
