<?php

namespace App\Http\Controllers\Admin;

use App\CPU\BackEndHelper;
use App\Http\Controllers\Controller;
use App\Model\AdminWallet;
use App\Model\SellerWallet;
use App\Model\WithdrawRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WithdrawController extends Controller
{
    public function update(Request $request, $id)
    {
        $w = WithdrawRequest::find($id);

        if ($w->approved1 != 1) {
            SellerWallet::where('seller_id', $w->seller_id)->increment('withdrawn', $w->amount);
        }

        $w->approved = $request['approved'];
        $w->transaction_note = $request['note'];
        $w->save();

        Toastr::success('Updated!');
        return redirect()->back();
    }

    public function w_request(Request $request)
    {
        $w = AdminWallet::where('admin_id', auth()->guard('admin')->id())->first();
        if ($w->balance >= BackEndHelper::currency_to_usd($request['amount']) && $request['amount'] > 1) {
            AdminWallet::where('admin_id', auth()->guard('admin')->user()->id)->decrement('balance', BackEndHelper::currency_to_usd($request['amount']));
            AdminWallet::where('admin_id', auth()->guard('admin')->user()->id)->increment('withdrawn', BackEndHelper::currency_to_usd($request['amount']));
            Toastr::success('Withdraw request has been complete.');
            return redirect()->back();
        }

        Toastr::error('invalid request.!');
        return redirect()->back();
    }

    public function status_filter(Request $request){
        session()->put('withdraw_status_filter',$request['withdraw_status_filter']);
        return response()->json(session('withdraw_status_filter'));
    }
}
