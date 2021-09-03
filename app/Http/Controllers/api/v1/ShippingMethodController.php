<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Model\ShippingMethod;

class ShippingMethodController extends Controller
{
    public function get_shipping_method_info($id)
    {
        try {
            $shipping = ShippingMethod::find($id);
            return response()->json($shipping, 200);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e], 403);
        }
    }
}
