<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Model\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function apply(Request $request)
    {

        try {
            $coupon = Coupon::where(['code' => $request['code']])->first();
        } catch (\Exception $e) {
            return response()->json(['errors' => $e], 403);
        }

        return response()->json($coupon,200);
    }
}
