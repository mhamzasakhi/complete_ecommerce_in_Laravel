<?php

namespace App\Http\Controllers\Customer;

use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Model\ShippingMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SystemController extends Controller
{
    public function set_payment_method($name)
    {
        if (auth('customer')->check() || session()->has('mobile_app_payment_customer_id')) {
            session()->put('payment_method', $name);
            return response()->json([
                'status' => 1
            ]);
        }
        return response()->json([
            'status' => 0
        ]);
    }

    public function set_shipping_method(Request $request)
    {
        if ($request['id'] != 0) {
            session()->put('shipping_method_id', $request['id']);

            $cart = $request->session()->get('cart', collect([]));
            $cart = $cart->map(function ($object, $key) use ($request) {
                if ($key == $request['key']) {
                    $object['shipping_method_id'] = $request['id'];
                    $object['shipping_cost'] = ShippingMethod::find($request['id'])->cost;
                }
                return $object;
            });
            $request->session()->put('cart', $cart);

            return response()->json([
                'status' => 1
            ]);
        }
        return response()->json([
            'status' => 0
        ]);
    }

    public function choose_shipping_address(Request $request)
    {
        if ($request->save_address == 'on') {
            $address_id = DB::table('shipping_addresses')->insertGetId([
                'customer_id' => auth('customer')->id(),
                'contact_person_name' => $request['contact_person_name'],
                'address_type' => $request['address_type'],
                'address' => $request['address'],
                'city' => $request['city'],
                'country' => $request['country'],
                'zip' => $request['zip'],
                'phone' => $request['phone'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else if ($request['shipping_method_id'] == 0) {

            $validator = Validator::make($request->all(), [
                'contact_person_name' => 'required',
                'address_type' => 'required',
                'address' => 'required',
                'city' => 'required',
                'country' => 'required',
                'zip' => 'required',
                'phone' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => Helpers::error_processor($validator)]);
            }

            $address_id = DB::table('shipping_addresses')->insertGetId([
                'customer_id' => 0,
                'contact_person_name' => $request['contact_person_name'],
                'address_type' => $request['address_type'],
                'address' => $request['address'],
                'city' => $request['city'],
                'country' => $request['country'],
                'zip' => $request['zip'],
                'phone' => $request['phone'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $address_id = $request['shipping_method_id'];
        }

        session()->put('customer_info', [
            'address_id' => $address_id
        ]);

        return response()->json([], 200);
    }

}
