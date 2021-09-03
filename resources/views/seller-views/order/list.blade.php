@extends('layouts.back-end.app-seller')
@section('title','Order List')

@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{asset('public/assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
    <!-- Page Heading -->
    <div class="content container-fluid">
        <div class="row align-items-center mb-3">
            <div class="col-sm">
                <h1 class="page-header-title">{{trans('messages.Orders')}} <span
                        class="badge badge-soft-dark ml-2">{{$orders->total()}}</span>
                </h1>
            </div>
        </div>

        <div class="row" style="margin-top: 20px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{trans('messages.order_table')}}</h5>
                    </div>
                    <div class="card-body" style="padding: 0">
                        <div class="table-responsive">
                            <table id="datatable"
                                   class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                                   style="width: 100%">
                                <thead class="thead-light">
                                <tr>
                                    <th>{{trans('messages.SL#')}}</th>
                                    <th>{{trans('messages.Order')}}</th>
                                    <th>{{trans('messages.customer_name')}}</th>
                                    <th>{{trans('messages.Phone')}}</th>
                                    <th>{{trans('messages.Payment')}}</th>
                                    <th>{{trans('messages.Status')}} </th>
                                    <th style="width: 30px">{{trans('messages.Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $k=>$detail)
                                    <tr>
                                        <td>
                                            {{$k+1}}
                                        </td>
                                        <td>
                                            <a href="{{route('seller.orders.details',$detail['order_id'])}}">{{$detail['order_id']}}</a>
                                        </td>
                                        <td>{{ $detail->order->customer->f_name }}</td>
                                        <td>{{ $detail->order->customer->phone }}</td>
                                        <td>
                                            @if($detail->order->payment_status=='paid')
                                                <span class="badge badge-soft-success">
                                      <span class="legend-indicator bg-success"></span>Paid
                                    </span>
                                            @else
                                                <span class="badge badge-soft-danger">
                                      <span class="legend-indicator bg-danger"></span>Unpaid
                                    </span>
                                            @endif
                                        </td>
                                        <td class="text-capitalize ">
                                            @if($detail->order->order_status=='pending')
                                                <label
                                                    class="badge badge-primary">{{$detail->order['order_status']}}</label>
                                            @elseif($detail->order->order_status=='processing')
                                                <label
                                                    class="badge badge-primary">{{$detail->order['order_status']}}</label>
                                            @elseif($detail->order->order_status=='delivered')
                                                <label
                                                    class="badge badge-success">{{$detail->order['order_status']}}</label>
                                            @elseif($detail->order->order_status=='returned')
                                                <label
                                                    class="badge badge-danger">{{$detail->order['order_status']}}</label>
                                            @else
                                                <label
                                                    class="badge badge-danger">{{$detail->order['order_status']}}</label>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- <a href="{{route('seller.orders.details',[$order['order_id']])}}"
                                            class="btn  btn-outline-info btn-sm">
                                            <i class="fa fa-eye"></i>
                                         </a> --}}

                                            <div class="dropdown">
                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <i class="tio-settings"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item"
                                                       href="{{route('seller.orders.details',[$detail['order_id']])}}"><i
                                                            class="tio-visible"></i> View</a>
                                                    <a class="dropdown-item" target="_blank"
                                                       href="{{route('seller.orders.generate-invoice',[$detail['order_id']])}}"><i
                                                            class="tio-download"></i> Invoice</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Footer -->
                    <div class="card-footer">
                        <!-- Pagination -->
                        <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                            {{--<div class="col-sm mb-2 mb-sm-0">
                                <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                                    <span class="mr-2">Showing:</span>

                                    <!-- Select -->
                                    <select id="datatableEntries" class="js-select2-custom"
                                            data-hs-select2-options='{
                                            "minimumResultsForSearch": "Infinity",
                                            "customClass": "custom-select custom-select-sm custom-select-borderless",
                                            "dropdownAutoWidth": true,
                                            "width": true
                                          }'>
                                        <option value="25" selected>25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="200">200</option>
                                    </select>
                                    <!-- End Select -->

                                    <span class="text-secondary mr-2">of</span>

                                    <!-- Pagination Quantity -->
                                    <span id="datatableWithPaginationInfoTotalQty"></span>
                                </div>
                            </div>--}}

                            <div class="col-sm-auto">
                                <div class="d-flex justify-content-center justify-content-sm-end">
                                    <!-- Pagination -->
                                    {!! $orders->links() !!}
                                    {{--<nav id="datatablePagination" aria-label="Activity pagination"></nav>--}}
                                </div>
                            </div>
                        </div>
                        <!-- End Pagination -->
                    </div>
                    <!-- End Footer -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- Page level plugins -->
    <script src="{{asset('public/assets/back-end')}}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('public/assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>
@endpush
