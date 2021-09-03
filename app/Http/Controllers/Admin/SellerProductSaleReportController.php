<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;
use Illuminate\Http\Request;

class SellerProductSaleReportController extends Controller
{
    public function index()
    {
        $products = Product::with(['order_details'])->where(['added_by' => 'seller'])->get();
        $products_array = [];
        foreach ($products as $product) {
            if (!empty($product->order_details)) {
                $qty = 0;
                foreach ($product->order_details as $details) {
                    $qty += $details['qty'];
                }
                array_push($products_array, [
                    'product_name' => $product['name'],
                    'qty' => $qty
                ]);
            }
        }
        $categories = Category::where(['parent_id' => 0])->get();
        return view('admin-views.report.seller-product-sale', compact('products_array', 'categories'));
    }

    public function filter(Request $request)
    {

        if ($request['seller_id'] == 'all') {
            $products = Product::with(['order_details'])->where(['added_by' => 'seller'])->get();
        } else {
            $products = Product::with(['order_details'])->where(['added_by' => 'seller', 'user_id' => $request['seller_id']])->get();
        }

        $products_array = [];
        if ($request['category_id'] == 'all') {
            foreach ($products as $product) {
                if (!empty($product->order_details)) {
                    $qty = 0;
                    foreach ($product->order_details as $details) {
                        $qty += $details['qty'];
                    }
                    array_push($products_array, [
                        'product_name' => $product['name'],
                        'qty' => $qty
                    ]);
                }
            }
        } else {
            foreach ($products as $product) {
                foreach (json_decode($product['category_ids'], true) as $category) {
                    if ($category['id'] == $request['category_id'] && !empty($product->order_details)) {
                        $qty = 0;
                        foreach ($product->order_details as $details) {
                            $qty += $details['qty'];
                        }
                        array_push($products_array, [
                            'product_name' => $product['name'],
                            'qty' => $qty
                        ]);
                    }
                }
            }
        }
        return response()->json([
            'view' => view('admin-views.report.partials.products-table', compact('products_array'))->render()
        ]);
    }
}
