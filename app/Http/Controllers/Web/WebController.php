<?php

namespace App\Http\Controllers\Web;

use App\CPU\Helpers;
use App\CPU\OrderManager;
use App\CPU\ProductManager;
use App\CPU\CartManager;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\Model\Brand;
use App\Model\BusinessSetting;
use App\Model\Category;
use App\Model\DealOfTheDay;
use App\Model\FlashDeal;
use App\Model\FlashDealProduct;
use App\Model\HelpTopic;
use App\Model\OrderDetail;
use App\Model\Product;
use App\Model\Review;
use App\Model\Seller;
use App\Model\Shop;
use App\Model\Order;
use App\User;
use App\Model\Wishlist;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class WebController extends Controller
{
    public function maintenance_mode()
    {
        $maintenance_mode = Helpers::get_business_settings('maintenance_mode') ?? 0;
        if ($maintenance_mode) {
            return view('web-views.maintenance-mode');
        }
        return redirect()->route('home');
    }

    public function home()
    {
        $home_categories = Category::where('home_status', true)->get();

        //products based on top seller
        $top_sellers = Seller::where(['status'=>'approved'])->with('shop')
            ->withCount(['orders'])->orderBy('orders_count','DESC')->take(15)->get();
        //end

        //feature products finding based on selling
        $featured_products = Product::with(['reviews'])->active()
            ->where('featured', 1)
            ->withCount(['order_details'])->orderBy('order_details_count','DESC')
            ->take(12)
            ->get();
        //end

        $latest_products = Product::with(['reviews'])->active()->orderBy('id', 'desc')->take(8)->get();
        $categories = Category::where('position', 0)->take(12)->get();
        $brands = Brand::take(15)->get();
        //best sell product
        $bestSellProduct = OrderDetail::with('product.reviews')
            ->whereHas('product',function ($query){
                $query->active();
            })
            ->select('product_id', DB::raw('COUNT(product_id) as count'))
            ->groupBy('product_id')
            ->orderBy("count", 'desc')
            ->take(4)
            ->get();
        //Top rated
        $topRated = Review::with('product')
            ->whereHas('product',function ($query){
                $query->active();
            })
            ->select('product_id', DB::raw('AVG(rating) as count'))
            ->groupBy('product_id')
            ->orderBy("count", 'desc')
            ->take(4)
            ->get();

        if ($bestSellProduct->count() == 0) {
            $bestSellProduct = $latest_products;
        }

        if ($topRated->count() == 0) {
            $topRated = $bestSellProduct;
        }

        $deal_of_the_day = DealOfTheDay::join('products', 'products.id', '=', 'deal_of_the_days.product_id')->select('deal_of_the_days.*', 'products.unit_price')->where('deal_of_the_days.status', 1)->first();

        return view('web-views.home', compact('featured_products', 'topRated', 'bestSellProduct', 'latest_products', 'categories', 'brands', 'deal_of_the_day', 'top_sellers', 'home_categories'));
    }

    public function flash_deals($id)
    {
        $deal = FlashDeal::with(['products.product.reviews'])->where(['id' => $id, 'status' => 1])->whereDate('start_date', '<=', date('Y-m-d'))->whereDate('end_date', '>=', date('Y-m-d'))->first();

        $discountPrice = FlashDealProduct::with(['product'])->get()->map(function ($data) {
            return [
                'discount' => $data->discount,
                'sellPrice' => $data->product->unit_price,
                'discountedPrice' => $data->product->unit_price - $data->discount,

            ];
        })->toArray();
        // dd($deal->toArray());

        if (isset($deal)) {
            return view('web-views.deals', compact('deal', 'discountPrice'));
        }
        Toastr::warning('no such deal found!');
        return back();
    }

    public function search_shop(Request $request)
    {
        $key = explode(' ', $request['shop_name']);
        $sellers = Shop::where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('name', 'like', "%{$value}%");
            }
        })->whereHas('seller', function ($query) {
            return $query->where(['status' => 'approved']);
        })->paginate(30);
        return view('web-views.sellers', compact('sellers'));
    }

    public function all_categories()
    {
        $categories = Category::all();
        return view('web-views.categories', compact('categories'));
    }

    public function categories_by_category($id)
    {
        $category = Category::with(['childes.childes'])->where('id', $id)->first();
        return response()->json([
            'view' => view('web-views.partials._category-list-ajax', compact('category'))->render(),
        ]);
    }

    public function all_brands()
    {
        $brands = Brand::paginate(12);
        return view('web-views.brands', compact('brands'));
    }

    public function all_sellers()
    {
        $sellers = Shop::paginate(30);
        return view('web-views.sellers', compact('sellers'));
    }

    public function seller_profile($id)
    {
        $seller_info = Seller::find($id);
        return view('web-views.seller-profile', compact('seller_info'));
    }

    public function searched_products(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Product name is required!',
        ]);

        $result = ProductManager::search_products($request['name']);
        $products = $result['products'];

        return response()->json([
            'result' => view('web-views.partials._search-result', compact('products'))->render(),
        ]);
    }

    public function checkout_details()
    {
        if (session()->has('shipping_method_id') == false) {
            Toastr::info('Select shipping method first!');
            return redirect('shop-cart');
        }

        if (session()->has('cart') && count(session('cart')) > 0) {
            return view('web-views.checkout-details');
        }
        Toastr::info('No items in your basket!');
        return redirect('/');
    }

    public function checkout_shipping(Request $request)
    {
        if (session()->has('shipping_method_id') == false) {
            Toastr::info('Select shipping method first!');
            return redirect('shop-cart');
        }

        if (session()->has('cart') && count(session('cart')) > 0) {
            return view('web-views.checkout-shipping');
        }
        Toastr::info('No items in your basket!');
        return redirect('/');
    }

    public function checkout_payment()
    {
        if (session()->has('shipping_method_id') == false) {
            Toastr::info('Select shipping method first!');
            return redirect('shop-cart');
        }

        if (session()->has('order_id')) {
            Order::where(['id' => session('order_id')])->delete();
            OrderDetail::where(['order_id' => session('order_id')])->delete();
            $order_id = session('order_id');
        } else {
            $order_id = 100000 + Order::all()->count() + 1;
        }

        $customer_info = session('customer_info');
        $discount = session()->has('coupon_discount') ? session('coupon_discount') : 0;

        try {
            $or = [
                'id' => $order_id,
                'customer_id' => auth('customer')->id(),
                'customer_type' => 'customer',
                'payment_status' => 'unpaid',
                'order_status' => 'pending',
                'payment_method' => 'not choosen yet',
                'transaction_ref' => null,
                'discount_amount' => $discount,
                'discount_type' => $discount == 0 ? null : 'coupon_discount',
                'order_amount' => CartManager::cart_grand_total(session('cart')) - $discount,
                'shipping_address' => $customer_info['address_id'],
                'created_at' => now(),
                'updated_at' => now()
            ];

            $order_id = DB::table('orders')->insertGetId($or);

            foreach (session('cart') as $c) {
                $product = Product::where(['id' => $c['id']])->first();
                $or_d = [
                    'order_id' => $order_id,
                    'product_id' => $c['id'],
                    'seller_id' => $product->added_by == 'seller' ? $product->user_id : '0',
                    'product_details' => $product,
                    'qty' => $c['quantity'],
                    'price' => $c['price'],
                    'tax' => $c['tax'] * $c['quantity'],
                    'discount' => $c['discount'] * $c['quantity'],
                    'discount_type' => 'discount_on_product',
                    'variant' => $c['variant'],
                    'variation' => json_encode($c['variations']),
                    'delivery_status' => 'pending',
                    'shipping_method_id' => $c['shipping_method_id'],
                    'payment_status' => 'unpaid',
                    'created_at' => now(),
                    'updated_at' => now()
                ];

                if ($c['variant'] != null) {
                    $type = $c['variant'];
                    $var_store = [];
                    foreach (json_decode($product['variation'], true) as $var) {
                        if ($type == $var['type']) {
                            $var['qty'] -= $c['quantity'];
                        }
                        array_push($var_store, $var);
                    }
                    Product::where(['id' => $product['id']])->update([
                        'variation' => json_encode($var_store),
                    ]);
                }

                Product::where(['id' => $product['id']])->update([
                    'current_stock' => $product['current_stock'] - $c['quantity']
                ]);

                DB::table('order_details')->insert($or_d);
            }

            session()->put('order_id', $order_id);
        } catch (\Exception $e) {
            Toastr::error('Invalid informations.');
            return back();
        }

        if (session()->has('customer_info') && session()->has('cart') && count(session('cart')) > 0) {
            return view('web-views.checkout-payment');
        }

        Toastr::error('Incomplete info!');
        return back();
    }

    public function checkout_complete(Request $request)
    {
        if (session()->has('shipping_method_id') == false) {
            Toastr::info('Select shipping method first!');
            return redirect('shop-cart');
        }

        if (session()->has('cart') == false || count(session('cart')) == 0) {
            Toastr::info('Your cart is empty.');
            return redirect()->route('home');
        }

        try {
            $fcm_token = User::where(['id' => auth('customer')->id()])->first()->cm_firebase_token;
            $value = \App\CPU\Helpers::order_status_update_message('pending');
            if ($value) {
                $data = [
                    'title' => 'Order',
                    'description' => $value,
                    'order_id' => session('order_id'),
                    'image' => '',
                ];
                Helpers::send_push_notif_to_device($fcm_token, $data);
            }
        } catch (\Exception $e) {
            Toastr::error('FCM token config issue.');
        }

        $order_id = session('order_id');
        Order::where(['id' => $order_id])->update(['payment_method' => $request['payment_method']]);
        try {
            $seller_ids = OrderDetail::Where(['order_id' => $order_id])->pluck('seller_id')->toArray();
            foreach (array_unique($seller_ids) as $seller_id) {
                if ($seller_id == 0) {
                    $email = Admin::where(['admin_role_id' => 1])->first()->email;
                } else {
                    $email = Seller::where('id', $seller_id)->first()->email;
                }
                Mail::to($email)->send(new \App\Mail\OrderReceivedNotifySeller(session('order_id')));
            }
            Mail::to(auth('customer')->user()->email)->send(new \App\Mail\OrderPlaced(session('order_id')));
        } catch (\Exception $mail_exception) {
            Toastr::error('Invalid mail or configuration.');
        }

        session()->forget('cart');
        session()->forget('coupon_code');
        session()->forget('coupon_discount');
        session()->forget('payment_method');
        session()->forget('customer_info');
        session()->forget('shipping_method_id');
        session()->forget('order_id');

        return view('web-views.checkout-complete', compact('order_id'));
    }

    public function shop_cart()
    {
        if (session()->has('cart') && count(session('cart')) > 0) {
            return view('web-views.shop-cart');
        }
        Toastr::info('No items in your basket!');
        return redirect('/');
    }

    //for seller Shop

    public function seller_shop(Request $request, $id)
    {
        //review+rating+order count
        $products = Product::active()
            ->when($id == 0, function ($query) {
                return $query->where(['added_by' => 'admin']);
            })
            ->when($id != 0, function ($query) use ($id) {
                return $query->where(['added_by' => 'seller'])
                    ->where('user_id', $id);
            })
            ->paginate(12);

        $reviews = [];
        foreach ($products as $product) {
            $x = Review::where('product_id', $product->id)->get();
            array_push($reviews, $x->first());
        }
        $total_review = count(array_filter($reviews));

        $ratings = 0;
        foreach ($reviews as $review) {
            if ($review != null) {
                $ratings .= $review->rating;
            }
        }
        if (count(array_filter($reviews)) > 0) {
            $total_rating = $ratings / count(array_filter($reviews));
        } else {
            $total_rating = $ratings;
        }

        $orders = [];
        foreach ($products as $product) {
            $x = OrderDetail::where('product_id', $product->id)->get();
            array_push($orders, $x->first());
        }
        $total_order = count(array_filter($orders));
        //end

        //finding category ids
        $products = Product::active()
            ->when($id == 0, function ($query) {
                return $query->where(['added_by' => 'admin']);
            })
            ->when($id != 0, function ($query) use ($id) {
                return $query->where(['added_by' => 'seller'])
                    ->where('user_id', $id);
            })
            ->paginate(12);

        $category_info = [];
        foreach ($products as $product) {
            array_push($category_info, $product['category_ids']);
        }

        $category_info_decoded = [];
        foreach ($category_info as $category_info) {
            array_push($category_info_decoded, json_decode($category_info));
        }

        $category_ids = [];
        foreach ($category_info_decoded as $category_info_decoded) {
            foreach ($category_info_decoded as $category_info_decoded) {
                array_push($category_ids, $category_info_decoded->id);
            }
        }

        $categories = [];
        foreach ($category_ids as $category_id) {
            $category = Category::with(['childes.childes'])->where('position', 0)->find($category_id);
            if ($category != null) {
                array_push($categories, $category);
            }
        }
        $categories = array_unique($categories);
        //end

        //products
        if ($request->product_name) {
            $products = Product::active()
                ->when($id == 0, function ($query) {
                    return $query->where(['added_by' => 'admin']);
                })
                ->when($id != 0, function ($query) use ($id) {
                    return $query->where(['added_by' => 'seller'])
                        ->where('user_id', $id);
                })
                ->where('name', 'like', $request->product_name . '%')
                ->paginate(12);
        } elseif ($request->category_id) {
            $products = Product::active()
                ->when($id == 0, function ($query) {
                    return $query->where(['added_by' => 'admin']);
                })
                ->when($id != 0, function ($query) use ($id) {
                    return $query->where(['added_by' => 'seller'])
                        ->where('user_id', $id);
                })
                ->whereJsonContains('category_ids', [
                    ['id' => strval($request->category_id)],
                ])->paginate(12);
        } else {
            $products = Product::active()
                ->when($id == 0, function ($query) {
                    return $query->where(['added_by' => 'admin']);
                })
                ->when($id != 0, function ($query) use ($id) {
                    return $query->where(['added_by' => 'seller'])
                        ->where('user_id', $id);
                })
                ->paginate(12);
        }
        //end

        if ($id == 0) {
            $shop = [
                'id' => 0,
                'name' => 'SixValley',
            ];
        } else {
            $shop = Shop::where('seller_id', $id)->first();
        }

        return view('web-views.shop-page', compact('products', 'shop', 'categories'))
            ->with('seller_id', $id)
            ->with('total_review', $total_review)
            ->with('total_rating', $total_rating)
            ->with('total_order', $total_order);
    }

    //ajax filter (category based)
    public function seller_shop_product(Request $request, $id)
    {
        $products = Product::active()->with('shop')->where(['added_by' => 'seller'])
            ->where('user_id', $id)
            ->whereJsonContains('category_ids', [
                ['id' => strval($request->category_id)],
            ])
            ->paginate(12);
        $shop = Shop::where('seller_id', $id)->first();
        if ($request['sort_by'] == null) {
            $request['sort_by'] = 'latest';
        }

        return response()->json([
            'view' => view('web-views.products._ajax-products', compact('products'))->render(),
            //'paginator' => view('web-views.products._ajax-paginator', compact('data', 'page'))->render(),
        ], 200);

        return '<h1>Successful</h1>';

        return view('web-views.shop-page', compact('products', 'shop'))->with('seller_id', $id);
    }

    public function quick_view(Request $request)
    {
        $product = ProductManager::get_product($request->product_id);
        $order_details = OrderDetail::where('product_id', $product->id)->get();
        $wishlists = Wishlist::where('product_id', $product->id)->get();
        $countOrder = count($order_details);
        $countWishlist = count($wishlists);
        $relatedProducts = Product::with(['reviews'])->where('category_ids', $product->category_ids)->where('id', '!=', $product->id)->limit(12)->get();
        return response()->json([
            'success' => 1,
            'view' => view('web-views.partials._quick-view-data', compact('product', 'countWishlist', 'countOrder', 'relatedProducts'))->render(),
        ]);
    }

    public function product($slug)
    {
        $product = Product::active()->with(['reviews'])->where('slug', $slug)->first();
        if ($product != null) {
            $countOrder = OrderDetail::where('product_id', $product->id)->count();
            $countWishlist = Wishlist::where('product_id', $product->id)->count();
            $relatedProducts = Product::with(['reviews'])->active()->where('category_ids', $product->category_ids)->where('id', '!=', $product->id)->limit(12)->get();
            $deal_of_the_day = DealOfTheDay::where('product_id', $product->id)->where('status', 1)->first();

            return view('web-views.products.details', compact('product', 'countWishlist', 'countOrder', 'relatedProducts', 'deal_of_the_day'));
        }

        Toastr::error('Product not found!');
        return back();
    }

    public function products(Request $request)
    {
        if ($request['sort_by'] == null) {
            $request['sort_by'] = 'latest';
        }

        if ($request['data_from'] == 'category') {
            $products = Product::active()->get();
            $product_ids = [];
            foreach ($products as $product) {
                foreach (json_decode($product['category_ids'], true) as $category) {
                    if ($category['id'] == $request['id']) {
                        array_push($product_ids, $product['id']);
                    }
                }
            }

            $query = Product::with(['reviews'])->whereIn('id', $product_ids);
            if ($request['sort_by'] == 'latest') {
                $fetched = $query->latest();
            } elseif ($request['sort_by'] == 'low-high') {
                $fetched = $query->orderBy('unit_price', 'ASC');
            } elseif ($request['sort_by'] == 'high-low') {
                $fetched = $query->orderBy('unit_price', 'DESC');
            } elseif ($request['sort_by'] == 'a-z') {
                $fetched = $query->orderBy('name', 'ASC');
            } elseif ($request['sort_by'] == 'z-a') {
                $fetched = $query->orderBy('name', 'DESC');
            } else {
                $fetched = $query;
            }
        }

        if ($request['data_from'] == 'brand') {
            $query = Product::with(['reviews'])->active()->where('brand_id', $request['id']);
            if ($request['sort_by'] == 'latest') {
                $fetched = $query->latest();
            } elseif ($request['sort_by'] == 'low-high') {
                $fetched = $query->orderBy('unit_price', 'ASC');
            } elseif ($request['sort_by'] == 'high-low') {
                $fetched = $query->orderBy('unit_price', 'DESC');
            } elseif ($request['sort_by'] == 'a-z') {
                $fetched = $query->orderBy('name', 'ASC');
            } elseif ($request['sort_by'] == 'z-a') {
                $fetched = $query->orderBy('name', 'DESC');
            } else {
                $fetched = $query;
            }

        }

        if ($request['data_from'] == 'latest') {
            $query = Product::with(['reviews'])->active()->orderBy('id', 'DESC');
            // dd($query->toArray());
            if ($request['sort_by'] == 'latest') {
                $fetched = $query;
            } elseif ($request['sort_by'] == 'low-high') {
                $fetched = $query->orderBy('unit_price', 'ASC');
            } elseif ($request['sort_by'] == 'high-low') {
                $fetched = $query->orderBy('unit_price', 'DESC');
            } elseif ($request['sort_by'] == 'a-z') {
                $fetched = $query->orderBy('name', 'ASC');
            } elseif ($request['sort_by'] == 'z-a') {
                $fetched = $query->orderBy('name', 'DESC');
            } else {
                $fetched = $query;
            }
        }

        if ($request['data_from'] == 'top-rated') {
            $reviews = Review::select('product_id', DB::raw('AVG(rating) as count'))
                ->groupBy('product_id')
                ->orderBy("count", 'desc')->get();
            $product_ids = [];
            foreach ($reviews as $review) {
                array_push($product_ids, $review['product_id']);
            }
            $query = Product::with(['reviews'])->whereIn('id', $product_ids);

            if ($request['sort_by'] == 'latest') {
                $fetched = $query;
            } elseif ($request['sort_by'] == 'low-high') {
                $fetched = $query->orderBy('unit_price', 'ASC');
            } elseif ($request['sort_by'] == 'high-low') {
                $fetched = $query->orderBy('unit_price', 'DESC');
            } elseif ($request['sort_by'] == 'a-z') {
                $fetched = $query->orderBy('name', 'ASC');
            } elseif ($request['sort_by'] == 'z-a') {
                $fetched = $query->orderBy('name', 'DESC');
            } else {
                $fetched = $query;
            }
        }

        if ($request['data_from'] == 'best-selling') {
            $details = OrderDetail::with('product')
                ->select('product_id', DB::raw('COUNT(product_id) as count'))
                ->groupBy('product_id')
                ->orderBy("count", 'desc')
                ->get();
            $product_ids = [];
            foreach ($details as $detail) {
                array_push($product_ids, $detail['product_id']);
            }
            $query = Product::with(['reviews'])->active()->whereIn('id', $product_ids);

            if ($request['sort_by'] == 'latest') {
                $fetched = $query;
            } elseif ($request['sort_by'] == 'low-high') {
                $fetched = $query->orderBy('unit_price', 'ASC');
            } elseif ($request['sort_by'] == 'high-low') {
                $fetched = $query->orderBy('unit_price', 'DESC');
            } elseif ($request['sort_by'] == 'a-z') {
                $fetched = $query->orderBy('name', 'ASC');
            } elseif ($request['sort_by'] == 'z-a') {
                $fetched = $query->orderBy('name', 'DESC');
            } else {
                $fetched = $query;
            }
        }

        if ($request['data_from'] == 'most-favorite') {
            $details = Wishlist::with('product')
                ->select('product_id', DB::raw('COUNT(product_id) as count'))
                ->groupBy('product_id')
                ->orderBy("count", 'desc')
                ->get();
            $product_ids = [];
            foreach ($details as $detail) {
                array_push($product_ids, $detail['product_id']);
            }
            $query = Product::with(['reviews'])->active()->whereIn('id', $product_ids);

            if ($request['sort_by'] == 'latest') {
                $fetched = $query;
            } elseif ($request['sort_by'] == 'low-high') {
                $fetched = $query->orderBy('unit_price', 'ASC');
            } elseif ($request['sort_by'] == 'high-low') {
                $fetched = $query->orderBy('unit_price', 'DESC');
            } elseif ($request['sort_by'] == 'a-z') {
                $fetched = $query->orderBy('name', 'ASC');
            } elseif ($request['sort_by'] == 'z-a') {
                $fetched = $query->orderBy('name', 'DESC');
            } else {
                $fetched = $query;
            }

        }

        if ($request['data_from'] == 'featured') {
            $query = Product::with(['reviews'])->active()->where('featured', 1);
            if ($request['sort_by'] == 'latest') {
                $fetched = $query->latest();
            } elseif ($request['sort_by'] == 'low-high') {
                $fetched = $query->orderBy('unit_price', 'ASC');
            } elseif ($request['sort_by'] == 'high-low') {
                $fetched = $query->orderBy('unit_price', 'DESC');
            } elseif ($request['sort_by'] == 'a-z') {
                $fetched = $query->orderBy('name', 'ASC');
            } elseif ($request['sort_by'] == 'z-a') {
                $fetched = $query->orderBy('name', 'DESC');
            } else {
                $fetched = $query;
            }
        }

        if ($request['data_from'] == 'search') {
            $key = explode(' ', $request['name']);
            $query = Product::with(['reviews'])->active()->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%");
                }
            });

            if ($request['sort_by'] == 'latest') {
                $fetched = $query->latest();
            } elseif ($request['sort_by'] == 'low-high') {
                $fetched = $query->orderBy('unit_price', 'ASC');
            } elseif ($request['sort_by'] == 'high-low') {
                $fetched = $query->orderBy('unit_price', 'DESC');
            } elseif ($request['sort_by'] == 'a-z') {
                $fetched = $query->orderBy('name', 'ASC');
            } elseif ($request['sort_by'] == 'z-a') {
                $fetched = $query->orderBy('name', 'DESC');
            } else {
                $fetched = $query;
            }
        }

        if ($request['min_price'] != null || $request['max_price'] != null) {
            $fetched = $fetched->whereBetween('unit_price', [Helpers::convert_currency_to_usd($request['min_price']), Helpers::convert_currency_to_usd($request['max_price'])]);
        }

        $products = $fetched->paginate(20);

        $data = [
            'id' => $request['id'],
            'name' => $request['name'],
            'data_from' => $request['data_from'],
            'sort_by' => $request['sort_by'],
            'page_no' => $request['page'],
            'min_price' => $request['min_price'],
            'max_price' => $request['max_price'],
            'page_number' => $products->lastPage(),
        ];

        if ($request->ajax()) {
            $page = $request['page'];
            return response()->json([
                'view' => view('web-views.products._ajax-products', compact('products'))->render(),
                'paginator' => view('web-views.products._ajax-paginator', compact('data', 'page'))->render(),
            ], 200);
        }
        if ($request['data_from'] == 'category') {
            $data['brand_name'] = Category::find((int)$request['id'])->name;
        }
        if ($request['data_from'] == 'brand') {
            $data['brand_name'] = Brand::find((int)$request['id'])->name;
        }

        return view('web-views.products.view', compact('products', 'data'), $data);
    }

    public function viewWishlist()
    {
        $wishlists = Wishlist::where('customer_id', auth('customer')->id())->get();
        return view('web-views.users-profile.account-wishlist', compact('wishlists'));
    }

    public function storeWishlist(Request $request)
    {
        if ($request->ajax()) {
            if (auth('customer')->check()) {
                $wishlist = Wishlist::where('customer_id', auth('customer')->id())->where('product_id', $request->product_id)->first();
                if (empty($wishlist)) {

                    $wishlist = new Wishlist;
                    $wishlist->customer_id = auth('customer')->id();
                    $wishlist->product_id = $request->product_id;
                    $wishlist->save();

                    $countWishlist = Wishlist::where('customer_id', auth('customer')->id())->get();
                    $data = "Product has been added to wishlist";

                    $product_count = Wishlist::where(['product_id' => $request->product_id])->count();
                    session()->put('wish_list', Wishlist::where('customer_id', auth('customer')->user()->id)->pluck('product_id')->toArray());
                    return response()->json(['success' => $data, 'value' => 1, 'count' => count($countWishlist), 'id' => $request->product_id, 'product_count' => $product_count]);
                } else {
                    $data = "Product already added to wishlist";
                    return response()->json(['error' => $data, 'value' => 2]);
                }

            } else {
                $data = "Please login first";
                return response()->json(['error' => $data, 'value' => 0]);
            }
        }
    }

    public function deleteWishlist(Request $request)
    {
        Wishlist::where(['product_id' => $request['id'], 'customer_id' => auth('customer')->id()])->delete();
        $data = "Product has been remove from wishlist!";
        $wishlists = Wishlist::where('customer_id', auth('customer')->id())->get();
        session()->put('wish_list', Wishlist::where('customer_id', auth('customer')->user()->id)->pluck('product_id')->toArray());
        return response()->json([
            'success' => $data,
            'count' => count($wishlists),
            'id' => $request->id,
            'wishlist' => view('web-views.partials._wish-list-data', compact('wishlists'))->render(),
        ]);
    }

    //for HelpTopic
    public function helpTopic()
    {
        $helps = HelpTopic::Status()->latest()->get();
        return view('web-views.help-topics', compact('helps'));
    }

    //for Contact US Page
    public function contacts()
    {

        return view('web-views.contacts');
    }

    public function about_us()
    {
        $about_us = BusinessSetting::where('type', 'about_us')->first();
        return view('web-views.about-us', [
            'about_us' => $about_us,
        ]);
    }

    public function termsandCondition()
    {
        $terms_condition = BusinessSetting::where('type', 'terms_condition')->first();
        return view('web-views.terms', compact('terms_condition'));
    }

    public function privacy_policy()
    {
        $privacy_policy = BusinessSetting::where('type', 'privacy_policy')->first();
        return view('web-views.privacy-policy', compact('privacy_policy'));
    }

    //order Details

    public function orderdetails()
    {
        return view('web-views.orderdetails');
    }

    public function chat_for_product(Request $request)
    {
        return $request->all();
    }

    public function supportChat()
    {
        return view('web-views.users-profile.profile.supportTicketChat');
    }

    public function error()
    {
        return view('web-views.404-error-page');
    }
}
