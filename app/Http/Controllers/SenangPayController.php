<?php

namespace App\Http\Controllers;

use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Order;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SenangPayController extends Controller
{
    public function return_senang_pay(Request $request)
    {
        if ($request['status_id'] == 1) {
            DB::table('orders')
                ->where('id', $request['order_id'])
                ->update([
                    'payment_method' => 'senang_pay',
                    'transaction_ref' => $request['transaction_id'],
                    'order_status' => 'confirmed',
                    'payment_status' => 'paid',
                    'updated_at' => now(),
                ]);

            $order = Order::find($request['order_id']);
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

            if (session()->has('payment_mode') && session('payment_mode') == 'app') {
                return redirect()->route('payment-success');
            }

            $order_id = $request['order_id'];

            session()->forget('cart');
            session()->forget('coupon_code');
            session()->forget('coupon_discount');
            session()->forget('payment_method');
            session()->forget('shipping_method_id');
            session()->forget('order_id');

            return view('web-views.checkout-complete', compact('order_id'));
        }else{
            DB::table('orders')
                ->where('id', $request['order_id'])
                ->update([
                    'payment_method' => 'senang_pay',
                    'transaction_ref' => $request['transaction_id'],
                    'order_status' => 'failed',
                    'payment_status' => 'unpaid',
                    'updated_at' => now(),
                ]);
        }

        if (session()->has('payment_mode') && session('payment_mode') == 'app') {
            return redirect()->route('payment-fail');
        }

        Toastr::error('Payment process failed');
        return back();
    }

    public function success()
    {
        if (auth('customer')->check()) {
            Toastr::success('Payment success.');
            return redirect('/account-oder');
        }
        return response()->json(['message' => 'Payment succeeded'], 200);
    }

    public function fail()
    {
        if (auth('customer')->check()) {
            Toastr::error('Payment failed.');
            return redirect('/account-oder');
        }
        return response()->json(['message' => 'Payment failed'], 403);
    }
}
