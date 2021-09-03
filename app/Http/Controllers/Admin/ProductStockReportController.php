<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Product;
use Illuminate\Http\Request;

class ProductStockReportController extends Controller
{
    public function index()
    {
        return view('admin-views.report.product-stock');
    }

    public function filter(Request $request)
    {
        if ($request['seller_id'] == 'all') {
            $products = Product::all();
        } elseif ($request['seller_id'] == 'in_house') {
            $products = Product::where(['added_by' => 'admin'])->get();
        } else {
            $products = Product::where(['added_by' => 'seller', 'user_id' => $request['seller_id']])->get();
        }
        return response()->json([
            'view' => view('admin-views.report.partials.products-stock-table', compact('products'))->render()
        ]);
    }
}
