<?php

namespace App\Http\Controllers;

use App\CPU\CartManager;
use App\CPU\Helpers;
use App\Model\BusinessSetting;
use App\Model\Order;
use App\Model\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PHPUnit\Exception;
use Stripe\Charge;
use Stripe\Stripe;

class StripePaymentController extends Controller
{
    public function paymentProcess()
    {
        $tran = Str::random(6) . '-' . rand(1, 1000);
        $order_id = session('order_id');

        try {
            $config = Helpers::get_business_settings('stripe');
            Stripe::setApiKey($config['api_key']);
            $token = $_POST['stripeToken'];
            $payment = Charge::create([
                'amount' => (Order::find($order_id)->order_amount) * 100,
                'currency' => 'usd',
                'description' => $tran,
                'source' => $token
            ]);
        } catch (Exception $exception) {
            Toastr::error('Gateway configuration problem.');
            return back();
        }

        if ($payment->status == 'succeeded') {
            DB::table('orders')
                ->where('id', $order_id)
                ->update(['order_status' => 'processing', 'payment_method' => 'stripe', 'transaction_ref' => $tran, 'payment_status' => 'paid']);
        }

        if ($payment->status == 'succeeded' && session()->has('payment_mode') && session('payment_mode') == 'app') {
            return redirect()->route('payment-success');
        } elseif ($payment->status != 'succeeded' && session()->has('payment_mode') && session('payment_mode') == 'app') {
            return redirect()->route('payment-fail');
        }

        session()->forget('cart');
        session()->forget('coupon_code');
        session()->forget('coupon_discount');
        session()->forget('payment_method');
        session()->forget('shipping_method_id');
        session()->forget('order_id');

        return view('web-views.checkout-complete', compact('order_id'));
    }

    public function payment_process_3d()
    {
        $tran = Str::random(6) . '-' . rand(1, 1000);
        $order_id = session('order_id');
        session()->put('transaction_ref', $tran);
        $order = Order::with(['details'])->where(['id' => $order_id])->first();
        $config = \App\CPU\Helpers::get_business_settings('stripe');
        Stripe::setApiKey($config['api_key']);
        header('Content-Type: application/json');

        $YOUR_DOMAIN = url('/');

        $products = [];
        foreach ($order->details as $detail) {
            array_push($products, [
                'name' => $detail->product['name'],
                'image' => 'def.png'
            ]);
        }

        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'unit_amount' => $order->order_amount * 100,
                    'product_data' => [
                        'name' => BusinessSetting::where(['type' => 'company_name'])->first()->value,
                        'images' => [asset('storage/app/public/company') . '/' . BusinessSetting::where(['type' => 'company_web_logo'])->first()->value],
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/pay-stripe/success',
            'cancel_url' => url()->previous(),
        ]);

        return response()->json(['id' => $checkout_session->id]);
    }

    public function success()
    {
        DB::table('orders')
            ->where('id', session('order_id'))
            ->update(['order_status' => 'confirmed', 'payment_method' => 'stripe', 'transaction_ref' => session('transaction_ref'), 'payment_status' => 'paid']);

        if (auth('customer')->check()) {
            Toastr::success('Payment success.');
            $order_id = session('order_id');

            session()->forget('cart');
            session()->forget('coupon_code');
            session()->forget('coupon_discount');
            session()->forget('payment_method');
            session()->forget('shipping_method_id');
            session()->forget('order_id');

            return view('web-views.checkout-complete', compact('order_id'));
        }

        return response()->json(['message' => 'Payment succeeded'], 200);
    }

    public function fail()
    {
        if (auth('customer')->check()) {
            Toastr::error('Payment failed.');
            return redirect('/account-order');
        }
        return response()->json(['message' => 'Payment failed'], 403);
    }
}
