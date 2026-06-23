<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Discount;

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
        $discounts = Discount::where('is_active', 1)->get();

        return view('orders.checkout', compact('discounts'));
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['subtotal'];
        }

        $discount = 0;

        if (session('promo_percentage')) {
            $discount =
                $total * (session('promo_percentage') / 100);
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
            'promo_code' => session('promo_name'),
            'date' => now()->format('d/m/Y H:i')
        ]);

        return redirect('/orders/receipt');
    }

    public function applyPromo(Request $request)
    {
        $promo = Discount::where(
            'promo_name',
            $request->promo_code
        )
        ->where('is_active', true)
        ->first();

        if (!$promo) {
            return redirect('/orders/checkout')
                ->with('error', 'Promo tidak ditemukan');
        }

        session()->put('promo_name', $promo->promo_name);
        session()->put('promo_percentage', $promo->percentage);

        return redirect('/orders/checkout')
            ->with('success', 'Promo berhasil digunakan');
    }

    public function receipt()
    {
        return view('orders.receipt');
    }

    public function resetTransaction()
    {
        session()->forget('cart');
        session()->forget('checkout');
        session()->forget('promo_name');

        return redirect('/orders/create');
    }
}