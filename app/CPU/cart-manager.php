<?php

namespace App\CPU;

use App\Model\Color;
use App\Model\Product;

class CartManager
{
    public static function get_cart()
    {
        if (session()->has('cart')) {
            $x = session('cart');
        } else {
            $x = [];
        }

        return $x;
    }

    public static function put_in_cart($request)
    {
        $product = Product::find($request['product_id']);
        $data = [
            'id' => $product['id']
        ];
        $str = '';
        $tax = 0;

        if ($request->has('color')) {
            $data['color'] = $request['color'];
            $str = Color::where('code', $request['color'])->pluck('name')->first();
        }

        $data['variant'] = $str;

        if ($str != null && $product->variant_product) {
            $product_stock = $product->stocks->where('variant', $str)->first();
            $price = $product_stock->price;
            $quantity = $product_stock->qty;

            if ($quantity >= $request['quantity']) {
                // $variations->$str->qty -= $request['quantity'];
                // $product->variations = json_encode($variations);
                // $product->save();
            } else {
                return response()->json([
                    'success' => 0,
                    'messages' => ['0' => 'Out of stock!']
                ]);
            }
        } else {
            $price = $product->unit_price;
        }


        /* if ($product->tax_type == 'percent') {
             $tax = ($price * $product->tax) / 100;
         } elseif ($product->tax_type == 'amount') {
             $tax = $product->tax;
         }*/

        $data['quantity'] = $request['quantity'];
        $data['price'] = $price;
        $data['tax'] = $product->tax;
        $data['tax_type'] = $product->tax_type;
        $data['slug'] = $product->slug;
        $data['name'] = $product->name;
        $data['shipping'] = 0;
        $data['thumbnail'] = $product->thumbnail;

        if ($request['quantity'] == null) {
            $data['quantity'] = 1;
        }

        if ($request->session()->has('cart')) {
            $foundInCart = false;
            $cart = collect();

            foreach ($request->session()->get('cart') as $key => $cartItem) {
                if ($cartItem['id'] == $request->id) {
                    if ($cartItem['variant'] == $str) {
                        $foundInCart = true;
                        $cartItem['quantity'] += $request['quantity'];
                    }
                }
                $cart->push($cartItem);
            }

            if (!$foundInCart) {
                $cart->push($data);
            }
            $request->session()->put('cart', $cart);
        } else {
            $cart = collect([$data]);
            $request->session()->put('cart', $cart);
        }

        return CartManager::get_cart();
    }

    public static function cart_total($cart)
    {
        $total = 0;
        if (!empty($cart)) {
            foreach ($cart as $item) {
                $product_subtotal = $item['price'] * $item['quantity'];
                $total += $product_subtotal;
            }
        }
        return $total;
    }

    public static function cart_total_applied_discount($cart)
    {
        $total = 0;
        if (!empty($cart)) {
            foreach ($cart as $item) {
                $product_subtotal = ($item['price'] - $item['discount']) * $item['quantity'];
                $total += $product_subtotal;
            }
        }
        return $total;
    }

    public static function cart_total_with_tax($cart)
    {
        $total = 0;
        if (!empty($cart)) {
            foreach ($cart as $item) {
                $product_subtotal = ($item['price'] * $item['quantity']) + ($item['tax'] * $item['quantity']);
                $total += $product_subtotal;
            }
        }
        return $total;
    }

    public static function cart_grand_total($cart)
    {
        $total = 0;
        if (!empty($cart)) {
            foreach ($cart as $item) {
                $product_subtotal = ($item['price'] * $item['quantity'])
                    + ($item['tax'] * $item['quantity'])
                    + $item['shipping_cost']
                    - $item['discount']* $item['quantity'];
                $total += $product_subtotal;
            }
        }
        return $total;
    }
}
