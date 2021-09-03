<?php

namespace App\Http\Controllers\Seller;

use App\CPU\Helpers;
use App\CPU\OrderManager;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\Model\AdminWallet;
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
        if ($status != 'all') {
            $orders = OrderDetail::with('order.customer', 'order')->where(['seller_id' => auth('seller')->id(), 'delivery_status' => $status])->latest()->paginate(25);
        } else {
            $orders = OrderDetail::with('order.customer', 'order')->where(['seller_id' => auth('seller')->id()])->latest()->paginate(25);
        }
        return view('seller-views.order.list', compact('orders'));
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
        OrderManager::wallet_manage_on_order_status_change($order, $request);
        $data = $request->delivery_status;

        return response()->json($data);
    }

    public function details($id)
    {
        $sellerId = auth('seller')->id();
        $order = Order::with(['details' => function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        }])->with('customer', 'shipping')
            ->where('id', $id)->first();
        return view('seller-views.order.order-details', compact('order'));
    }

    public function generate_invoice($id)
    {
        $sellerId = auth('seller')->id();
        $order = Order::with(['details' => function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        }])->with('customer', 'shipping')
            ->where('id', $id)->first();
        // $order = OrderDetail::with('order.customer', 'shipping')->where('id', $id)->first();
        // dd($order);
        $data["email"] = $order->customer["email"];
        $data["client_name"] = $order->customer["f_name"] . ' ' . $order->customer["l_name"];
        $data["order"] = $order;
        //return view('seller-views.order.invoice', compact('order'));
        $pdf = PDF::loadView('seller-views.order.invoice', $data);
        return $pdf->stream($order->id . '.pdf');
    }
}
