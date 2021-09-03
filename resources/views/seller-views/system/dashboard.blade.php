@extends('layouts.back-end.app-seller')

@section('title','Dashboard')

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .grid-card {
            border: 2px solid #00000012;
            border-radius: 10px;
            padding: 10px;
        }

        .label_1 {
            position: absolute;
            font-size: 10px;
            background: #FF4C29;
            color: #ffffff;
            width: 80px;
            padding: 2px;
            font-weight: bold;
            border-radius: 6px;
            text-align: center;
        }

        .center-div {
            text-align: center;
            border-radius: 6px;
            padding: 6px;
            border: 2px solid #8080805e;
        }
    </style>
@endpush

@section('content')

    <div class="content container-fluid">
        <!-- Page Heading -->
        <div class="page-header pb-0" style="border-bottom: 0!important">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title">{{trans('messages.Dashboard')}}</h1>
                </div>

                <div class="col-sm-auto">
                    <a class="btn btn-primary" href="{{route('seller.product.list')}}">
                        <i class="tio-premium-outlined mr-1"></i> {{trans('messages.Products')}}
                    </a>
                </div>
            </div>
        </div>


        <div class="card mb-3">
            <div class="card-body">
                <div class="row gx-2 gx-lg-3 mb-2">
                    <div class="col-9">
                        <h4><i style="font-size: 30px"
                               class="tio-chart-bar-4"></i>{{__('messages.dashboard_order_statistics')}}</h4>
                    </div>
                    <div class="col-3">
                        <select class="custom-select" name="statistics_type" onchange="order_stats_update(this.value)">
                            <option
                                value="overall" {{session()->has('statistics_type') && session('statistics_type') == 'overall'?'selected':''}}>
                                Overall Statistics
                            </option>
                            <option
                                value="today" {{session()->has('statistics_type') && session('statistics_type') == 'today'?'selected':''}}>
                                Today's Statistics
                            </option>
                            <option
                                value="today" {{session()->has('statistics_type') && session('statistics_type') == 'this_month'?'selected':''}}>
                                This Month's Statistics
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row gx-2 gx-lg-3" id="order_stats">
                    @include('seller-views.partials._dashboard-order-stats',['data'=>$data])
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 for-card col-md-6 mb-4">
                <div class="card for-card-body-2 shadow h-100  badge-primary" style="background: #362222!important;">
                    <div class="card-body text-light">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold  text-uppercase for-card-text mb-1">
                                    {{trans('messages.balance')}}
                                </div>
                                @php
                                    $wallet = \App\Model\SellerWallet::where('seller_id',auth('seller')->id())->first();
                                    if(isset($wallet)==false){
                                        \Illuminate\Support\Facades\DB::table('seller_wallets')->insert([
                                            'seller_id'=>auth('seller')->id(),
                                            'balance'=>0,
                                            'withdrawn'=>0,
                                            'created_at'=>now(),
                                            'updated_at'=>now()
                                        ]);
                                        $wallet = \App\Model\SellerWallet::where('seller_id',auth('seller')->id())->first();
                                    }
                                @endphp
                                <div
                                    class="for-card-count">{{\App\CPU\Convert::default($wallet->balance)}} {{\App\CPU\BackEndHelper::currency_symbol()}}</div>
                            </div>
                            <div class="col-auto  for-margin">
                                <a href="javascript:" style="background: #3A6351!important;" class="btn btn-primary"
                                   data-toggle="modal" data-target="#balance-modal">
                                    <i class="tio-wallet-outlined"></i> Withdraw
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 for-card col-md-6 mb-4" style="cursor: pointer">
                <div class="card  shadow h-100 for-card-body-3 badge-info" style="background: #171010!important;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div
                                    class=" font-weight-bold for-card-text text-uppercase mb-1">{{trans('messages.withdrawn')}}</div>
                                <div
                                    class="for-card-count">{{\App\CPU\Convert::default($wallet->withdrawn) }} {{\App\CPU\BackEndHelper::currency_symbol()}}</div>
                            </div>
                            <div class="col-auto for-margin">
                                <i class="fas fa-money-bill fa-2x for-fa-3 text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-4 for-card col-md-6 mb-4" style="cursor: pointer">
                <div class="card r shadow h-100 for-card-body-4  badge-success" style="background: #2B2B2B!important;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div
                                    class=" for-card-text font-weight-bold  text-uppercase mb-1">{{trans('messages.total_earning')}}</div>
                                <div
                                    class="for-card-count">{{ \App\CPU\Convert::default($wallet->balance+$wallet->withdrawn )}} {{\App\CPU\BackEndHelper::currency_symbol()}}</div>
                            </div>
                            <div class="col-auto for-margin">
                                <i class="fas fa-money-bill for-fa-fa-4  fa-2x text-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="balance-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Withdraw Request</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('seller.withdraw.request')}}" method="post">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Amount:</label>
                                <input type="number" name="amount"
                                       value="{{\App\CPU\BackEndHelper::usd_to_currency($wallet->balance)}}"
                                       class="form-control" id="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            @if(auth('seller')->user()->account_no==null || auth('seller')->user()->bank_name==null)
                                <button type="button" class="btn btn-primary" onclick="call_duty()">Incomplete bank
                                    info
                                </button>
                            @else
                                <button type="submit" class="btn btn-primary">Request</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row gx-2 gx-lg-3">
            <div class="col-lg-12 mb-3 mb-lg-12">
                <!-- Card -->
                <div class="card h-100">
                    <!-- Body -->
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-12 mb-3 border-bottom">
                                <h5 class="card-header-title float-left mb-2">
                                    <i style="font-size: 30px" class="tio-chart-pie-1"></i>
                                    Earning statistics for business analytics
                                </h5>
                                <!-- Legend Indicators -->
                                <h5 class="card-header-title float-right mb-2">This Year Earning
                                    <i style="font-size: 30px" class="tio-chart-bar-2"></i>
                                </h5>
                                <!-- End Legend Indicators -->
                            </div>
                            <div class="col-6 graph-border-1">
                                <div class="mt-2 center-div">
                                      <span class="h6 mb-0">
                                          <i class="legend-indicator bg-success"
                                             style="background-color: #B6C867!important;"></i>
                                         Your Earnings : {{\App\CPU\BackEndHelper::usd_to_currency(array_sum($seller_data))." ".\App\CPU\BackEndHelper::currency_symbol()}}
                                    </span>
                                </div>
                            </div>
                            <div class="col-6 graph-border-1">
                                <div class="mt-2 center-div">
                                      <span class="h6 mb-0">
                                          <i class="legend-indicator bg-danger"
                                             style="background-color: #01937C!important;"></i>
                                        Commission Given : {{\App\CPU\BackEndHelper::usd_to_currency(array_sum($commission_data))." ".\App\CPU\BackEndHelper::currency_symbol()}}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End Row -->

                        <!-- Bar Chart -->
                        <div class="chartjs-custom">
                            <canvas id="updatingData" style="height: 20rem;"
                                    data-hs-chartjs-options='{
                            "type": "bar",
                            "data": {
                              "labels": ["Jan","Feb","Mar","April","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
                              "datasets": [{
                                "data": [{{$seller_data[1]}},{{$seller_data[2]}},{{$seller_data[3]}},{{$seller_data[4]}},{{$seller_data[5]}},{{$seller_data[6]}},{{$seller_data[7]}},{{$seller_data[8]}},{{$seller_data[9]}},{{$seller_data[10]}},{{$seller_data[11]}},{{$seller_data[12]}}],
                                "backgroundColor": "#B6C867",
                                "borderColor": "#B6C867"
                              },
                              {
                                "data": [{{$commission_data[1]}},{{$commission_data[2]}},{{$commission_data[3]}},{{$commission_data[4]}},{{$commission_data[5]}},{{$commission_data[6]}},{{$commission_data[7]}},{{$commission_data[8]}},{{$commission_data[9]}},{{$commission_data[10]}},{{$commission_data[11]}},{{$commission_data[12]}}],
                                "backgroundColor": "#01937C",
                                "borderColor": "#01937C"
                              }]
                            },
                            "options": {
                              "scales": {
                                "yAxes": [{
                                  "gridLines": {
                                    "color": "#e7eaf3",
                                    "drawBorder": false,
                                    "zeroLineColor": "#e7eaf3"
                                  },
                                  "ticks": {
                                    "beginAtZero": true,
                                    "stepSize": 50000,
                                    "fontSize": 12,
                                    "fontColor": "#97a4af",
                                    "fontFamily": "Open Sans, sans-serif",
                                    "padding": 10,
                                    "postfix": " {{\App\CPU\BackEndHelper::currency_symbol()}}"
                                  }
                                }],
                                "xAxes": [{
                                  "gridLines": {
                                    "display": false,
                                    "drawBorder": false
                                  },
                                  "ticks": {
                                    "fontSize": 12,
                                    "fontColor": "#97a4af",
                                    "fontFamily": "Open Sans, sans-serif",
                                    "padding": 5
                                  },
                                  "categoryPercentage": 0.5,
                                  "maxBarThickness": "10"
                                }]
                              },
                              "cornerRadius": 2,
                              "tooltips": {
                                "prefix": " ",
                                "hasIndicator": true,
                                "mode": "index",
                                "intersect": false
                              },
                              "hover": {
                                "mode": "nearest",
                                "intersect": true
                              }
                            }
                          }'></canvas>
                        </div>
                        <!-- End Bar Chart -->
                    </div>
                    <!-- End Body -->
                </div>
                <!-- End Card -->
            </div>

            <div class="col-lg-6 mt-3">
                <!-- Card -->
                <div class="card h-100">
                    @include('seller-views.partials._top-selling-products',['top_sell'=>$data['top_sell']])
                </div>
                <!-- End Card -->
            </div>

            <div class="col-lg-6 mt-3">
                <!-- Card -->
                <div class="card h-100">
                    @include('seller-views.partials._most-rated-products',['most_rated_products'=>$data['most_rated_products']])
                </div>
                <!-- End Card -->
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src="{{asset('public/assets/back-end')}}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{asset('public/assets/back-end')}}/vendor/chart.js.extensions/chartjs-extensions.js"></script>
    <script
        src="{{asset('public/assets/back-end')}}/vendor/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js"></script>
@endpush

@push('script_2')
    <script>
        // INITIALIZATION OF CHARTJS
        // =======================================================
        Chart.plugins.unregister(ChartDataLabels);

        $('.js-chart').each(function () {
            $.HSCore.components.HSChartJS.init($(this));
        });

        var updatingChart = $.HSCore.components.HSChartJS.init($('#updatingData'));
    </script>

    <script>
        function call_duty() {
            toastr.warning('Update your bank info first!', 'Warning!', {
                CloseButton: true,
                ProgressBar: true
            });
        }
    </script>

    <script>
        function order_stats_update(type) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '{{route('seller.dashboard.order-stats')}}',
                data: {
                    statistics_type: type
                },
                beforeSend: function () {
                    $('#loading').show()
                },
                success: function (data) {
                    $('#order_stats').html(data.view)
                },
                complete: function () {
                    $('#loading').hide()
                }
            });
        }

        function business_overview_stats_update(type) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '{{route('admin.dashboard.business-overview')}}',
                data: {
                    business_overview: type
                },
                beforeSend: function () {
                    $('#loading').show()
                },
                success: function (data) {
                    console.log(data.view)
                    $('#business-overview-board').html(data.view)
                },
                complete: function () {
                    $('#loading').hide()
                }
            });
        }
    </script>
@endpush
