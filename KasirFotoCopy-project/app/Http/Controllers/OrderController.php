<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
    {
        return view('orders.create');
    }

    public function addToCart(Request $request)
    {
        $dummyProducts = [
            1 => [
                'name' => 'Pensil',
                'price' => 2000
            ],
            2 => [
                'name' => 'Buku',
                'price' => 5000
            ],
            3 => [
                'name' => 'Pulpen',
                'price' => 3000
            ],
        ];

        $productId = $request->product_id;
        $quantity = $request->quantity;

        // cek apakah product ada
        if (!isset($dummyProducts[$productId])) {
            return redirect('/orders/create')
                ->with('error', 'Product tidak ditemukan');
        }

        $product = $dummyProducts[$productId];

        $subtotal = $product['price'] * $quantity;

        $cart = session()->get('cart', []);

        $cart[] = [
            'product_id' => $productId,
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => $quantity,
            'subtotal' => $subtotal
        ];

        session()->put('cart', $cart);

        return redirect('/orders/create');
    }

    public function updateQuantity(Request $request, $index)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$index])) {

            $cart[$index]['quantity'] = $request->quantity;

            $cart[$index]['subtotal'] =
                $cart[$index]['price'] * $request->quantity;

            session()->put('cart', $cart);
        }

        return redirect('/orders/create');
    }

    public function deleteItem($index)
    {
        $cart = session()->get('cart', []);

        unset($cart[$index]);

        session()->put('cart', array_values($cart));

        return redirect('/orders/create');
    }

    public function showCheckout()
    {
        return view('orders.checkout');
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['subtotal'];
        }

        $discount = 0;

        if (session('promo_code') == 'DISKON10') {
            $discount = $total * 0.1;
        }

        $finalTotal = $total - $discount;

        session()->put('checkout', [
            'payment_method' => $request->payment_method,
            'discount' => $discount,
            'final_total' => $finalTotal,
            'total' => $total,
            'promo_code' => session('promo_code'),
            'date' => now()->format('d/m/Y H:i')
        ]);

        return redirect('/orders/receipt');
    }

    public function applyPromo(Request $request)
    {
        session()->put('promo_code', $request->promo_code);

        return redirect('/orders/checkout');
    }

    public function receipt()
    {
        return view('orders.receipt');
    }

    public function resetTransaction()
    {
        session()->forget('cart');
        session()->forget('checkout');
        session()->forget('promo_code');

        return redirect('/orders/create');
    }
}