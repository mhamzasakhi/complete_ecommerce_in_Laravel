<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Model\Order;
use App\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        session()->put('customer_id', $request['customer_id']);
        session()->put('order_id', $request->order_id);
        session()->put('payment_mode', 'app');

        $customer = User::find($request['customer_id']);
        $order = Order::where(['id' => $request->order_id, 'customer_id' => $request['customer_id']])->first();

        if (isset($customer) && isset($order)) {
            $data = [
                'name' => $customer['f_name'],
                'email' => $customer['email'],
                'phone' => $customer['phone'],
            ];
            session()->put('data', $data);
            return view('web-views.mobile-app-view.payment');
        }

        return response()->json(['errors' => ['code' => 'order-payment', 'message' => 'Data not found']], 403);

    }

    public function success()
    {
        return response()->json(['message' => 'Payment succeeded'], 200);
    }

    public function fail()
    {
        return response()->json(['message' => 'Payment failed'], 403);
    }
}
