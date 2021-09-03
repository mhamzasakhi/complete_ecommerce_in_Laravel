<?php

namespace App\Http\Controllers\Seller;

use App\CPU\BackEndHelper;
use App\CPU\Convert;
use App\Http\Controllers\Controller;
use App\Model\SellerWallet;
use App\Model\WithdrawRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WithdrawController extends Controller
{
    public function w_request(Request $request)
    {
        $w = SellerWallet::where('seller_id', auth()->guard('seller')->id())->first();
        if ($w->balance >= Convert::usd($request['amount']) && $request['amount'] > 1) {
            $data = [
                'seller_id' => auth()->guard('seller')->user()->id,
                'amount' => Convert::usd($request['amount']),
                'transaction_note' => null,
                'approved' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ];
            DB::table('withdraw_requests')->insert($data);
            SellerWallet::where('seller_id', auth()->guard('seller')->user()->id)->decrement('balance', Convert::usd($request['amount']));
            Toastr::success('Withdraw request has been sent.');
            return redirect()->back();
        }

        Toastr::error('invalid request.!');
        return redirect()->back();
    }

    public function close_request($id)
    {
        $wr = WithdrawRequest::find($id);
        if ($wr->approved == 0) {
            SellerWallet::where('seller_id', auth()->guard('seller')->user()->id)->increment('balance', Convert::usd($wr['amount']));
        }
        $wr->delete();
        Toastr::success('request closed!');
        return back();
    }
}
