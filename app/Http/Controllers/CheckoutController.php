<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\users;
use App\Models\Cart;
use Midtrans\Snap;
use Midtrans\config;

class CheckoutController extends Controller
{
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
        Config::$isProduction = false; // Sandbox
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details'=>[
                'order_id' => $order->order_numer,
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

        return view('web.payment', compact('order', 'snapToken'));
    }
}
