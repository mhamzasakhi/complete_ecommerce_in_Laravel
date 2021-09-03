<?php

namespace App\Http\Controllers\Seller;

use App\CPU\BackEndHelper;
use App\Http\Controllers\Controller;
use App\Model\ShippingMethod;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShippingMethodController extends Controller
{
    public function index()
    {
        $shipping_methods = ShippingMethod::where(['creator_id' => auth('seller')->id(), 'creator_type' => 'seller'])->get();
        return view('seller-views.shipping-method.add-new', compact('shipping_methods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:200',
            'duration' => 'required',
            'cost' => 'numeric'
        ]);

        DB::table('shipping_methods')->insert([
            'creator_id' => auth('seller')->id(),
            'creator_type' => 'seller',
            'title' => $request['title'],
            'duration' => $request['duration'],
            'cost' => BackEndHelper::currency_to_usd($request['cost']),
            'status' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Toastr::success('Successfully added.');
        return back();
    }

    public function status_update(Request $request)
    {
        ShippingMethod::where(['id' => $request['id']])->update([
            'status' => $request['status']
        ]);
        return response()->json([
            'success' => 1,
        ], 200);
    }

    public function edit($id)
    {
        $method = ShippingMethod::where(['id' => $id])->first();
        return view('seller-views.shipping-method.edit', compact('method'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:200',
            'duration' => 'required',
            'cost' => 'numeric'
        ]);

        DB::table('shipping_methods')->where(['id' => $id])->update([
            'creator_id' => auth('seller')->id(),
            'creator_type' => 'seller',
            'title' => $request['title'],
            'duration' => $request['duration'],
            'cost' => BackEndHelper::currency_to_usd($request['cost']),
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Toastr::success('Successfully updated.');
        return redirect()->route('seller.business-settings.shipping-method.add');
    }

    public function delete($id)
    {
        try {
            ShippingMethod::where(['id' => $id])->delete();
        } catch (\Exception $e) {

        }
        Toastr::success('Successfully removed.');
        return back();
    }
}
