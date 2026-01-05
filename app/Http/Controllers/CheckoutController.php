<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\users;
use App\Models\Cart;
use App\Models\Product;
use App\Models\product_variation;
use Midtrans\Snap;
use Midtrans\Config;

class CheckoutController extends Controller
{
    // menampilkan halaman checkout
    public function index()
    {
        $cart = Cart::with(['product'])->where('user_id', auth()->id())->get();

        $subTotal = $cart->sum(function($cart){
            return $cart->product_variation->price * $cart->quantity;
        });

        if($cart->isEmpty()) {
        return redirect()->route('web.all-produk');
    }

    return view('checkout.checkout', compact('cart', 'subtotal'));
    }
    
    // proses pembayaran
    public function process(Request $request){
        // simpan data order dan alamat
        $order = new Order();
        $order->order_number = 'INV-' . uniqid();
        $order->user_id = auth()->id();
        $order->receiver_name = $request->receiver_name;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->total_price = $request->total_price;
        $order->save();
        
        // konfigurasi MIdtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details'=>[
                'order_id' => $order->order_number,
                'gross_amount' => (int) $order->total_price,
            ],
            'customer_details'=>[
                'first_namme'=> $order->receiver_name,
                'phone' => $order->phone,
            ],
        ];

        // ambil snap token
        $snapToken = Snap::getSnapToken($params);
        $order->update(['snap_token' => $snapToken]);

        Cart::where('user_id', auth()->id())->delete();

        return view('web.payment', compact('order', 'snapToken'));
    }
}
