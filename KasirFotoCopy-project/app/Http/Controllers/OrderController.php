<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
    {
        return view('orders.create');
    }

    public function addToCart(Request $request)
    {
        $productId = $request->product_id;
        $quantity = $request->quantity;

        $product = Product::find($productId);

        if ($quantity > $product->stock) {
            return redirect('/orders/create')
                ->with(
                    'error',
                    'Stok '.$product->name.' hanya tersisa '.$product->stock
                );
        }

        if (!$product) {
            return redirect('/orders/create')
                ->with('error', 'Product tidak ditemukan');
        }

        $subtotal = $product->price * $quantity;

        $cart = session()->get('cart', []);

        $cart[] = [
            'product_id' => $productId,
            'name' => $product->name,
            'price' => $product->price,
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

        $order = Order::create([
            'invoice_number' => 'INV-' . time(),
            'total_price' => $finalTotal
        ]);

        foreach ($cart as $item) {
            OrderDetail::create([
                'order_id'   => $order->id,
                'product_id' => $item['product_id'],
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
                'subtotal'   => $item['subtotal']
            ]);
        }

        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);
            if ($product) {
                $product->stock -= $item['quantity'];
                $product->save();
            }
        }
       
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