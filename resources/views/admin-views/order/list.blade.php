@extends('layouts.back-end.app')

@section('title','Order List')

@push('css_or_js')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 48px;
            height: 23px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 15px;
            width: 15px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #377dff;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #377dff;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        #banner-image-modal .modal-content {
            width: 1116px !important;
            margin-left: -264px !important;
        }

        @media (max-width: 768px) {
            #banner-image-modal .modal-content {
                width: 698px !important;
                margin-left: -75px !important;
            }


        }

        @media (max-width: 375px) {
            #banner-image-modal .modal-content {
                width: 367px !important;
                margin-left: 0 !important;
            }

        }

        @media (max-width: 500px) {
            #banner-image-modal .modal-content {
                width: 400px !important;
                margin-left: 0 !important;
            }


        }


    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header mb-1">
            <div class="row align-items-center">
                <div class="col-sm">
                    <h1 class="page-header-title">{{trans('messages.Orders')}} <span
                            class="badge badge-soft-dark ml-2">{{$orders->total()}}</span></h1>
                </div>
                <div class="col-sm">
                    <i class="tio-shopping-cart float-right" style="font-size: 30px"></i>
                </div>
            </div>
            <!-- End Row -->

            <!-- Nav Scroller -->
            <div class="js-nav-scroller hs-nav-scroller-horizontal">
            <span class="hs-nav-scroller-arrow-prev" style="display: none;">
              <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                <i class="tio-chevron-left"></i>
              </a>
            </span>

                <span class="hs-nav-scroller-arrow-next" style="display: none;">
              <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                <i class="tio-chevron-right"></i>
              </a>
            </span>

                <!-- Nav -->
                <ul class="nav nav-tabs page-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Order List</a>
                    </li>
                </ul>
                <!-- End Nav -->
            </div>
            <!-- End Nav Scroller -->
        </div>
        <!-- End Page Header -->

        <!-- Card -->
        <div class="card">
            <!-- Header -->
            <div class="card-header">
                <div class="row justify-content-between align-items-center flex-grow-1">
                    <div class="col-lg-6 mb-3 mb-lg-0">
                        <form action="javascript:">
                            <!-- Search -->
                            <div class="input-group input-group-merge input-group-flush">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tio-search"></i>
                                    </div>
                                </div>
                                <input id="datatableSearch" type="search" class="form-control"
                                       placeholder="Search orders" aria-label="Search orders">
                            </div>
                            <!-- End Search -->
                        </form>
                    </div>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3">
                        <label> In-House orders only : </label>
                        <label class="switch ml-3">
                            <input type="checkbox" class="status"
                                   onclick="filter_order()" {{session()->has('show_inhouse_orders') && session('show_inhouse_orders')==1?'checked':''}}>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <!-- End Row -->
            </div>
            <!-- End Header -->

            <!-- Table -->
            <div class="table-responsive datatable-custom">
                <table id="datatable"
                       class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                       style="width: 100%"
                       data-hs-datatables-options='{
                     "columnDefs": [{
                        "targets": [0],
                        "orderable": false
                      }],
                     "order": [],
                     "info": {
                       "totalQty": "#datatableWithPaginationInfoTotalQty"
                     },
                     "search": "#datatableSearch",
                     "entries": "#datatableEntries",
                     "pageLength": 25,
                     "isResponsive": false,
                     "isShowPaging": false,
                     "pagination": "datatablePagination"
                   }'>
                    <thead class="thead-light">
                    <tr>
                        <th class="">
                            {{trans('messages.SL#')}}
                        </th>
                        <th class=" ">{{trans('messages.Order')}}</th>
                        <th>{{trans('messages.Date')}}</th>
                        <th>{{trans('messages.customer_name')}}</th>
                        <th>{{trans('messages.Status')}}</th>
                        <th>{{trans('messages.Total')}}</th>
                        <th>{{trans('messages.Order')}} {{trans('messages.Status')}} </th>
                        <th>{{trans('messages.Action')}}</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($orders as $key=>$order)

                        <tr class="status-{{$order['order_status']}} class-all">
                            <td class="">
                                {{$key+1}}
                            </td>
                            <td class="table-column-pl-0">
                                <a href="{{route('admin.orders.details',['id'=>$order['id']])}}">{{$order['id']}}</a>
                            </td>
                            <td>{{date('d M Y',strtotime($order['created_at']))}}</td>
                            <td>
                                @if($order->customer)
                                    <a class="text-body text-capitalize"
                                       href="{{route('admin.orders.details',['id'=>$order['id']])}}">{{$order->customer['f_name'].' '.$order->customer['l_name']}}</a>
                                @else
                                    <label class="badge badge-danger">Invalid Customer data</label>
                                @endif
                            </td>
                            <td>
                                @if($order->payment_status=='paid')
                                    <span class="badge badge-soft-success">
                                      <span class="legend-indicator bg-success"></span>Paid
                                    </span>
                                @else
                                    <span class="badge badge-soft-danger">
                                      <span class="legend-indicator bg-danger"></span>Unpaid
                                    </span>
                                @endif
                            </td>
                            <td> {{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order->order_amount))}}</td>
                            <td class="text-capitalize">
                                @if($order['order_status']=='pending')
                                    <span class="badge badge-soft-info ml-2 ml-sm-3">
                                        <span class="legend-indicator bg-info"></span>{{str_replace('_',' ',$order['order_status'])}}
                                      </span>

                                @elseif($order['order_status']=='processing')
                                    <span class="badge badge-soft-warning ml-2 ml-sm-3">
                                        <span class="legend-indicator bg-warning"></span>{{str_replace('_',' ',$order['order_status'])}}
                                      </span>
                                @elseif($order['order_status']=='failed')
                                    <span class="badge badge-danger ml-2 ml-sm-3">
                                        <span class="legend-indicator bg-warning"></span>{{str_replace('_',' ',$order['order_status'])}}
                                      </span>
                                @elseif($order['order_status']=='delivered')
                                    <span class="badge badge-soft-success ml-2 ml-sm-3">
                                        <span class="legend-indicator bg-success"></span>{{str_replace('_',' ',$order['order_status'])}}
                                      </span>
                                @else
                                    <span class="badge badge-soft-danger ml-2 ml-sm-3">
                                        <span class="legend-indicator bg-danger"></span>{{str_replace('_',' ',$order['order_status'])}}
                                      </span>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        <i class="tio-settings"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item"
                                           href="{{route('admin.orders.details',['id'=>$order['id']])}}"><i
                                                class="tio-visible"></i> View</a>
                                        <a class="dropdown-item" target="_blank"
                                           href="{{route('admin.orders.generate-invoice',[$order['id']])}}"><i
                                                class="tio-download"></i> Invoice</a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End Table -->

            <!-- Footer -->
            <div class="card-footer">
                <!-- Pagination -->
                <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                    <div class="col-sm-auto">
                        <div class="d-flex justify-content-center justify-content-sm-end">
                            <!-- Pagination -->
                            {!! $orders->links() !!}
                        </div>
                    </div>
                </div>
                <!-- End Pagination -->
            </div>
            <!-- End Footer -->
        </div>
        <!-- End Card -->
    </div>
@endsection

@push('script_2')
    <script>
        $(document).on('ready', function () {
            // INITIALIZATION OF NAV SCROLLER
            // =======================================================
            $('.js-nav-scroller').each(function () {
                new HsNavScroller($(this)).init()
            });

            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });


            // INITIALIZATION OF DATATABLES
            // =======================================================
            var datatable = $.HSCore.components.HSDatatables.init($('#datatable'), {
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        className: 'd-none'
                    },
                    {
                        extend: 'excel',
                        className: 'd-none'
                    },
                    {
                        extend: 'csv',
                        className: 'd-none'
                    },
                    {
                        extend: 'pdf',
                        className: 'd-none'
                    },
                    {
                        extend: 'print',
                        className: 'd-none'
                    },
                ],
                select: {
                    style: 'multi',
                    selector: 'td:first-child input[type="checkbox"]',
                    classMap: {
                        checkAll: '#datatableCheckAll',
                        counter: '#datatableCounter',
                        counterInfo: '#datatableCounterInfo'
                    }
                },
                language: {
                    zeroRecords: '<div class="text-center p-4">' +
                        '<img class="mb-3" src="{{asset('public/assets/back-end')}}/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">' +
                        '<p class="mb-0">No data to show</p>' +
                        '</div>'
                }
            });

            $('#datatableSearch').on('mouseup', function (e) {
                var $input = $(this),
                    oldValue = $input.val();

                if (oldValue == "") return;

                setTimeout(function () {
                    var newValue = $input.val();

                    if (newValue == "") {
                        // Gotcha
                        datatable.search('').draw();
                    }
                }, 1);
            });

            // INITIALIZATION OF TAGIFY
            // =======================================================
            $('.js-tagify').each(function () {
                var tagify = $.HSCore.components.HSTagify.init($(this));
            });
        });
    </script>

    <script>
        function filter_order() {
            $.get({
                url: '{{route('admin.orders.inhouse-order-filter')}}',
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    toastr.success('Order filter success.');
                    location.reload();
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        };
    </script>
@endpush
