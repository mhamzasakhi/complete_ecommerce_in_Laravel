<?php

namespace App\Http\Controllers\Admin;

use App\CPU\Helpers;
use App\CPU\OrderManager;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\Model\AdminWallet;
use App\Model\BusinessSetting;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Product;
use App\Model\SellerWallet;
use App\Model\ShippingMethod;
use Barryvdh\DomPDF\Facade as PDF;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function list($status)
    {
        if (session()->has('show_inhouse_orders') && session('show_inhouse_orders') == 1) {
            $data = OrderDetail::where(['seller_id' => 0])->pluck('order_id')->toArray();
            $query = Order::with(['customer'])->whereIn('id', array_unique($data));
            if ($status != 'all') {
                $orders = $query->where(['order_status' => $status])->latest()->paginate(25);
            } else {
                $orders = $query->latest()->paginate(15);
            }
        } else {
            if ($status != 'all') {
                $orders = Order::with(['customer'])->where(['order_status' => $status])->latest()->paginate(25);
            } else {
                $orders = Order::with(['customer'])->latest()->paginate(25);
            }
        }

        return view('admin-views.order.list', compact('orders'));
    }

    public function details($id)
    {
        $order = Order::with('details', 'details.shipping', 'shipping', 'seller')->where(['id' => $id])->first();
        return view('admin-views.order.order-details', compact('order'));
    }

    public function status(Request $request)
    {
        $order = Order::find($request->id);
        $fcm_token = $order->customer->cm_firebase_token;
        $value = Helpers::order_status_update_message($request->order_status);
        try {
            if ($value) {
                $data = [
                    'title' => 'Order',
                    'description' => $value,
                    'order_id' => $order['id'],
                    'image' => '',
                ];
                Helpers::send_push_notif_to_device($fcm_token, $data);
            }
        } catch (\Exception $e) {
            return response()->json([]);
        }

        $order->order_status = $request->order_status;
        OrderManager::stock_update_on_order_status_change($order, $request->order_status);

        $order->save();
        $data = $request->order_status;
        return response()->json($data);
    }

    public function payment_status(Request $request)
    {
        if ($request->ajax()) {
            $order = Order::find($request->id);
            $order->payment_status = $request->payment_status;
            $order->save();
            $data = $request->payment_status;
            return response()->json($data);
        }
    }

    public function productStatus(Request $request)
    {
        $order = OrderDetail::find($request->id);
        if ($order->delivery_status == 'delivered') {
            return response()->json(['success' => 0, 'message' => 'order is already delivered.'], 200);
        }
        $order->delivery_status = $request->delivery_status;
        OrderManager::stock_update_on_product_status_change($order, $request->delivery_status);
        $order->save();

        if ($request->delivery_status == 'delivered') {
            $complete = true;
            foreach (OrderDetail::where(['order_id' => $order['order_id']])->get() as $order) {
                if ($order['delivery_status'] != 'delivered') {
                    $complete = false;
                }
            }
            if ($complete) {
                Order::where(['id' => $order['order_id']])->update([
                    'order_status' => 'delivered',
                    'updated_at' => now()
                ]);
            }
        }

        $data = $request->delivery_status;
        OrderManager::wallet_manage_on_order_status_change($order, $request);

        return response()->json($data);
    }

    public function generate_invoice($id)
    {
        $order = Order::with('shipping')->where('id', $id)->first();
        // dd($order)->toArray();

        $data["email"] = $order->customer["email"];
        $data["client_name"] = $order->customer["f_name"] . ' ' . $order->customer["l_name"];
        $data["order"] = $order;
        //return view('admin-views.order.invoice', compact('order'));
        $pdf = PDF::loadView('admin-views.order.invoice', $data);
        return $pdf->download($order->id . '.pdf');
    }

    public function inhouse_order_filter()
    {
        if (session()->has('show_inhouse_orders') && session('show_inhouse_orders') == 1) {
            session()->put('show_inhouse_orders', 0);
        } else {
            session()->put('show_inhouse_orders', 1);
        }
        return back();
    }
}
