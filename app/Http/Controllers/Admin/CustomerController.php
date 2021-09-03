<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Order;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function customer_list()
    {
        $customers = User::with(['orders'])->latest()->paginate(25);
        return view('admin-views.customer.list', compact('customers'));
    }

    public function status_update(Request $request)
    {
        User::where(['id' => $request['id']])->update([
            'is_active' => $request['status']
        ]);

        DB::table('oauth_access_tokens')
            ->where('user_id', $request['id'])
            ->delete();

        return response()->json([], 200);
    }

    public function view($id)
    {
        $customer = User::find($id);
        if (isset($customer)) {
            $orders = Order::latest()->where(['customer_id' => $id])->paginate(5);
            return view('admin-views.customer.customer-view', compact('customer', 'orders'));
        }
        Toastr::error('Customer not found!');
        return back();
    }
}
