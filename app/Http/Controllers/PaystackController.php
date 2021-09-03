<?php

namespace App\Http\Controllers;

use App\CPU\Helpers;
use App\Model\Order;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Paystack;


class PaystackController extends Controller
{
    public function redirectToGateway(Request $request)
    {
        try {
            $order = Order::with(['details'])->where(['id' => $request['orderID']])->first();
            DB::table('orders')
                ->where('id', $order['id'])
                ->update([
                    'payment_method' => 'paystack',
                    'order_status' => 'failed',
                    'transaction_ref' => $request['reference'],
                    'updated_at' => now(),
                ]);

            return Paystack::getAuthorizationUrl()->redirectNow();
        } catch (\Exception $e) {
            Toastr::error('Your currency is not supported by Paystack.');
            return Redirect::back();
        }
    }

    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();
        $order = Order::where(['id' => session('order_id')])->first();

        if ($paymentDetails['status'] == true) {
            DB::table('orders')
                ->where('id',session('order_id'))
                ->update(['order_status' => 'confirmed', 'payment_status' => 'paid','transaction_ref'=> $paymentDetails['data']['reference']]);
            try {
                $fcm_token = $order->customer->cm_firebase_token;
                $value = Helpers::order_status_update_message('confirmed');
                if ($value) {
                    $data = [
                        'title' => 'Order',
                        'description' => $value,
                        'order_id' => $order['id'],
                        'image' => '',
                    ];
                    Helpers::send_push_notif_to_device($fcm_token, $data);
                }
            } catch (\Exception $e) {}

            if (session()->has('payment_mode') && session('payment_mode') == 'app') {
                return redirect()->route('payment-success');
            }
            $order_id = $order['id'];

            session()->forget('cart');
            session()->forget('coupon_code');
            session()->forget('coupon_discount');
            session()->forget('payment_method');
            session()->forget('shipping_method_id');
            session()->forget('order_id');

            return view('web-views.checkout-complete', compact('order_id'));

        } else {
            if (session()->has('payment_mode') && session('payment_mode') == 'app') {
                return redirect()->route('payment-fail');
            }
            Toastr::error('Payment process failed');
            return back();
        }
    }
}
