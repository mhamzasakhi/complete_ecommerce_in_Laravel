<?php

namespace App\Http\Controllers\api\v2\seller;

use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list(Request $request){
        $data = Helpers::get_seller_by_token($request);

        if ($data['success'] == 1) {
            $seller = $data['data'];
        } else {
            return response()->json([
                'auth-001' => 'Your existing session token does not authorize you any more'
            ], 401);
        }

        return response()->json(Product::where(['added_by'=>'seller','id'=>$seller['id']])->get(),200);
    }
}
