<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Model\AdminWalletHistory;
use App\Model\Brand;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Product;
use App\Model\SellerWalletHistory;
use App\Model\Shop;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $top_sell = OrderDetail::with(['product'])->where(['seller_id'=>auth('seller')->id()])
            ->select('product_id', DB::raw('SUM(qty) as count'))
            ->groupBy('product_id')
            ->orderBy("count", 'desc')
            ->take(6)
            ->get();

        $most_rated_products = Product::where(['user_id'=>auth('seller')->id()])->rightJoin('reviews', 'reviews.product_id', '=', 'products.id')
            ->groupBy('product_id')
            ->select(['product_id',
                DB::raw('AVG(reviews.rating) as ratings_average'),
                DB::raw('count(*) as total')
            ])
            ->orderBy('total', 'desc')
            ->take(6)
            ->get();

        $from = Carbon::now()->startOfYear()->format('Y-m-d');
        $to = Carbon::now()->endOfYear()->format('Y-m-d');

        $seller_data = [];
        $seller_earnings = SellerWalletHistory::select(
            DB::raw('IFNULL(sum(amount),0) as sums'),
            DB::raw('YEAR(created_at) year, MONTH(created_at) month')
        )->whereBetween('created_at', [$from, $to])->groupby('year', 'month')->get()->toArray();
        for ($inc = 1; $inc <= 12; $inc++) {
            $seller_data[$inc] = 0;
            foreach ($seller_earnings as $match) {
                if ($match['month'] == $inc) {
                    $seller_data[$inc] = $match['sums'];
                }
            }
        }

        $commission_data = [];
        $seller_products = Product::where(['added_by' => 'seller'])->pluck('id')->toArray();
        $commission_earnings = AdminWalletHistory::whereIn('product_id', $seller_products)->select(
            DB::raw('IFNULL(sum(amount),0) as sums'),
            DB::raw('YEAR(created_at) year, MONTH(created_at) month')
        )->whereBetween('created_at', [$from, $to])->groupby('year', 'month')->get()->toArray();
        for ($inc = 1; $inc <= 12; $inc++) {
            $commission_data[$inc] = 0;
            foreach ($commission_earnings as $match) {
                if ($match['month'] == $inc) {
                    $commission_data[$inc] = $match['sums'];
                }
            }
        }

        $data = self::order_stats_data();

        $data['customer'] = User::count();
        $data['store'] = Shop::count();
        $data['product'] = Product::count();
        $data['order'] = Order::count();
        $data['brand'] = Brand::count();

        $data['top_sell'] = $top_sell;
        $data['most_rated_products'] = $most_rated_products;

        return view('seller-views.system.dashboard', compact('data', 'seller_data', 'commission_data'));
    }

    public function order_stats(Request $request)
    {
        session()->put('statistics_type', $request['statistics_type']);
        $data = self::order_stats_data();

        return response()->json([
            'view' => view('seller-views.partials._dashboard-order-stats', compact('data'))->render()
        ], 200);
    }

    public function order_stats_data()
    {
        $today = session()->has('statistics_type') && session('statistics_type') == 'today' ? 1 : 0;
        $this_month = session()->has('statistics_type') && session('statistics_type') == 'this_month' ? 1 : 0;

        $pending = OrderDetail::where(['seller_id'=>auth('seller')->id()])->where(['delivery_status' => 'pending'])
            ->when($today, function ($query) {
                return $query->whereDate('created_at', Carbon::today());
            })
            ->when($this_month, function ($query) {
                return $query->whereMonth('created_at', Carbon::now());
            })
            ->count();
        $confirmed = OrderDetail::where(['seller_id'=>auth('seller')->id()])->where(['delivery_status' => 'confirmed'])
            ->when($today, function ($query) {
                return $query->whereDate('created_at', Carbon::today());
            })
            ->when($this_month, function ($query) {
                return $query->whereMonth('created_at', Carbon::now());
            })
            ->count();
        $processing = OrderDetail::where(['seller_id'=>auth('seller')->id()])->where(['delivery_status' => 'processing'])
            ->when($today, function ($query) {
                return $query->whereDate('created_at', Carbon::today());
            })
            ->when($this_month, function ($query) {
                return $query->whereMonth('created_at', Carbon::now());
            })
            ->count();
        $out_for_delivery = OrderDetail::where(['seller_id'=>auth('seller')->id()])->where(['delivery_status' => 'out_for_delivery'])
            ->when($today, function ($query) {
                return $query->whereDate('created_at', Carbon::today());
            })
            ->when($this_month, function ($query) {
                return $query->whereMonth('created_at', Carbon::now());
            })
            ->count();
        $delivered = OrderDetail::where(['seller_id'=>auth('seller')->id()])->where(['delivery_status' => 'delivered'])
            ->when($today, function ($query) {
                return $query->whereDate('created_at', Carbon::today());
            })
            ->when($this_month, function ($query) {
                return $query->whereMonth('created_at', Carbon::now());
            })
            ->count();
        $canceled = OrderDetail::where(['seller_id'=>auth('seller')->id()])->where(['delivery_status' => 'canceled'])
            ->when($today, function ($query) {
                return $query->whereDate('created_at', Carbon::today());
            })
            ->when($this_month, function ($query) {
                return $query->whereMonth('created_at', Carbon::now());
            })
            ->count();
        $returned = OrderDetail::where(['seller_id'=>auth('seller')->id()])->where(['delivery_status' => 'returned'])
            ->when($today, function ($query) {
                return $query->whereDate('created_at', Carbon::today());
            })
            ->when($this_month, function ($query) {
                return $query->whereMonth('created_at', Carbon::now());
            })
            ->count();
        $failed = OrderDetail::where(['seller_id'=>auth('seller')->id()])->where(['delivery_status' => 'failed'])
            ->when($today, function ($query) {
                return $query->whereDate('created_at', Carbon::today());
            })
            ->when($this_month, function ($query) {
                return $query->whereMonth('created_at', Carbon::now());
            })
            ->count();

        $data = [
            'pending' => $pending,
            'confirmed' => $confirmed,
            'processing' => $processing,
            'out_for_delivery' => $out_for_delivery,
            'delivered' => $delivered,
            'canceled' => $canceled,
            'returned' => $returned,
            'failed' => $failed
        ];

        return $data;
    }
}
