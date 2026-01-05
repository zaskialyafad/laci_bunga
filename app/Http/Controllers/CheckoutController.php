<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderItem;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Facades\DB;

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

    return view('web.checkout', compact('cart', 'subTotal'));
    }
    
    // PROSES CHECKOUT (Simpan Data & Request Midtrans)
    public function process(Request $request){
        DB::beginTransaction(); 
        try {
            // Buat Order
            $order = Order::create([
                'order_number' => 'INV-' . uniqid(),
                'user_id' => auth()->id(),
                'receiver_name' => $request->receiver_name,
                'phone' => $request->phone,
                'address' => $request->address,
                'total_price' => $request->total_price,
                'status' => 'pending',
            ]);

        $carts = Cart::with(['product', 'product_variation'])->where('user_id', auth()->id())->get();
        
        foreach($carts as $cart) {
            // pindahkan Keranjang ke Order Items
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'product_variation_id' => $cart->product_variation_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->product_variation->price,
                ]);
                // Kurangi Stok Produk
                $cart->product_variation->decrement('stock', $cart->quantity);
        }

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
            DB::commit();
            return redirect()->route('checkout.payment', $order->id);    
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal checkout: ' . $e->getMessage());
        }
    }

    // HALAMAN PEMBAYARAN (Tampil Token & Cek Status)
    public function payment($id)
    {
        $order = Order::with('items.product', 'items.product_variation')->where('user_id', auth()->id())->findOrFail($id);
        return view('web.payment', compact('order'));
    }

    // JIKA SUKSES BAYAR (Update Status Jadi Paid)
    public function success($id)
    {
        // 1. Cari order punya user yang login
        $order = Order::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        $order->update(['status' => 'paid']);
        
        // 3. Tampilkan halaman sukses
        return view('web.success', compact('order'));
    }
    

}
