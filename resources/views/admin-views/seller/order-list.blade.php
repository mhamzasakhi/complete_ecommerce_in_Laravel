@extends('layouts.back-end.app')
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
                    class="badge badge-soft-dark ml-2">{{\App\Model\OrderDetail::where('seller_id',auth('seller')->id())->count()}}</span>
            </h1>

        </div>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-black-50">{{trans('messages.Seller')}} : {{$seller['f_name'].' '.$seller['l_name']}} , ID : {{$seller['id']}}</h1>
    </div>

    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Order Table</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered"  width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th>{{trans('messages.SL#')}}</th>
                                    <th>{{trans('messages.Order')}}</th>
                                    <th>{{trans('messages.customer_name')}}</th>
                                    <th>{{trans('messages.Phone')}}</th>
                                    <th>{{trans('messages.Status')}} </th>
                                    <th>{{trans('messages.Payment')}}</th>
                                    
                                    <th style="width: 30px">{{trans('messages.Action')}}</th>
                                </tr>
                                </thead>
                            <tbody>
                            @foreach($orders as $k=>$order)
                                <tr>
                                    <th scope="row">{{$k+1}}</th>
                                    <td>
                                        <a href="{{route('admin.sellers.order-details',[$order['id'],$seller['id']])}}">{{$order['id']}}</a>
                                    </td>
                                    <td>{{$order->customer['f_name']}}</td>
                                    <td>
                                        {{$order->customer['phone']}}
                                    </td>
                                    <td class="text-capitalize ">
                                        @if($order->order_status=='pending')
                                            <label class="badge badge-primary">{{$order->order_status}}</label>
                                        @elseif($order->order_status=='processing')
                                            <label class="badge badge-warning">{{$order->order_status}}</label>
                                        @elseif($order->order_status=='processed')
                                            <label class="badge badge-warning">{{$order->order_status}}</label>
                                        @elseif($order->order_status=='delivered')
                                            <label class="badge badge-success">{{$order->order_status}}</label>
                                        @elseif($order->order_status=='returned')
                                            <label class="badge badge-warning">{{$order->order_status}}</label>
                                        @elseif($order->order_status=='failed')
                                            <label class="badge badge-danger">{{$order->order_status}}</label>
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
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="tio-settings"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item"
                                                   href="{{route('admin.sellers.order-details',[$order['id'],$seller['id']])}}"><i
                                                        class="tio-visible"></i> View</a>
                                                <a class="dropdown-item" target="_blank"
                                                   href="{{route('admin.orders.generate-invoice',[$order->id])}}"><i
                                                        class="tio-download"></i> Invoice</a>
                                            </div>
                                        </div>
                                        {{-- <a href="{{route('admin.sellers.order-details',[$order['id'],$seller['id']])}}"
                                           class="btn btn-outline-info btn-block">
                                            <i class="fa fa-eye"></i>
                                        </a> --}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <!-- Pagination -->
                    <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                       

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
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endpush
