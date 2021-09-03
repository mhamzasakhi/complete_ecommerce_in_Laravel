<?php

namespace App\Http\Controllers\Admin;

use App\CPU\Convert;
use App\CPU\ImageManager;
use App\CPU\BackEndHelper;
use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Product;
use App\Model\Seller;
use App\Model\WithdrawRequest;
use App\Model\SellerWallet;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SellerController extends Controller
{
    public function index()
    {
        $sellers = Seller::with(['orders', 'product'])->paginate(25);
        return view('admin-views.seller.index', compact('sellers'));
    }

    public function view($id)
    {
        $seller = Seller::findOrFail($id);
        return view('admin-views.seller.view', compact('seller'));
    }

    public function updateStatus(Request $request)
    {
        $order = Seller::findOrFail($request->id);
        $order->status = $request->status;
        if ($request->status == "approved") {
            Toastr::success('Seller has been approved successfully');
        } else if ($request->status == "rejected") {
            Toastr::info('Seller has been rejected successfully');
        } else if ($request->status == "suspended") {
            $order->auth_token = Str::random(80);
            Toastr::info('Seller has been suspended successfully');
        }
        $order->save();
        return back();
    }

    public function order_list($seller_id)
    {
        $order_det = OrderDetail::where('seller_id', $seller_id)->get();
        $order_ids = [];
        foreach ($order_det as $det) {
            if (in_array($det->seller_id, $order_ids) == false) {
                array_push($order_ids, $det->order_id);
            }
        }
        $orders = Order::with(['details'])->whereIn('id', $order_ids)->latest()->paginate(10);
        $seller = Seller::findOrFail($seller_id);
        return view('admin-views.seller.order-list', compact('orders', 'seller'));
    }

    public function product_list($seller_id)
    {
        $product = Product::where(['user_id' => $seller_id, 'added_by' => 'seller'])->latest()->paginate(10);
        $seller = Seller::findOrFail($seller_id);
        return view('admin-views.seller.porduct-list', compact('product', 'seller'));
    }

    public function order_details($order_id, $seller_id)
    {
        $order = Order::with('shipping')->where(['id' => $order_id])->first();
        return view('admin-views.seller.order-details', compact('order', 'seller_id'));
    }

    public function withdraw()
    {
        $all = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'all' ? 1 : 0;
        $active = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'approved' ? 1 : 0;
        $denied = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'denied' ? 1 : 0;
        $pending = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'pending' ? 1 : 0;

        $withdraw_req = WithdrawRequest::with(['seller'])
            ->when($all, function ($query) {
                return $query;
            })
            ->when($active, function ($query) {
                return $query->where('approved', 1);
            })
            ->when($denied, function ($query) {
                return $query->where('approved', 2);
            })
            ->when($pending, function ($query) {
                return $query->where('approved', 0);
            })
            ->orderBy('id', 'desc')
            ->latest()
            ->paginate(25);

        return view('admin-views.seller.withdraw', compact('withdraw_req'));
    }

    public function withdraw_view($withdraw_id, $seller_id)
    {
        $seller = WithdrawRequest::with(['seller'])->where(['id' => $withdraw_id])->first();
        return view('admin-views.seller.withdraw-view', compact('seller'));
    }

    public function withdrawStatus(Request $request, $id)
    {
        $withdraw = WithdrawRequest::findOrFail($id);
        $withdraw->approved = $request->approved;
        $withdraw->transaction_note = $request['note'];
        if ($request->approved == 1) {
            SellerWallet::where('seller_id', $withdraw->seller_id)->increment('withdrawn', $withdraw['amount']);
            $withdraw->save();
            Toastr::success('Seller Payment has been approved successfully');
            return redirect()->route('admin.sellers.withdraw_list');
        } else if ($request->approved == 2) {
            SellerWallet::where('seller_id', $withdraw->seller_id)->increment('balance', $withdraw['amount']);
            $withdraw->save();
            Toastr::info('Seller Payment request has been Denied successfully');
            return redirect()->route('admin.sellers.withdraw_list');
        } else {
            Toastr::error('Something went wrong');
            return back();
        }
    }

    public function sales_commission_update(Request $request, $id)
    {
        if ($request['status'] == 1 && $request['commission'] == null) {
            Toastr::error('You did not set commission percentage field.');
            return back();
        }

        $seller = Seller::find($id);
        $seller->sales_commission_percentage = $request['status'] == 1 ? $request['commission'] : null;
        $seller->save();

        Toastr::success('Commission percentage for this seller has been updated.');
        return back();
    }
}
