@extends('layouts.back-end.app')

@section('title','Seller List')

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard.index')}}">{{trans('messages.Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{trans('messages.Sellers')}}</li>
            </ol>
        </nav>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{trans('messages.seller_table')}}
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table
                                class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{trans('messages.SL#')}}</th>
                                    <th scope="col">{{trans('messages.name')}}</th>
                                    <th scope="col">{{trans('messages.Phone')}}</th>
                                    <th scope="col">{{trans('messages.Email')}}</th>
                                    <th scope="col">{{trans('messages.status')}}</th>
                                    <th scope="col">{{trans('messages.orders')}}</th>
                                    <th scope="col">{{trans('messages.Products')}}</th>
                                    <th scope="col" style="width: 50px">{{trans('messages.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sellers as $key=>$seller)
                                    <tr>
                                        <td scope="col">{{$key+1}}</td>
                                        <td scope="col">{{$seller->f_name}} {{$seller->l_name}}</td>
                                        <td scope="col">{{$seller->phone}}</td>
                                        <td scope="col">{{$seller->email}}</td>
                                        <td scope="col">
                                            {!! $seller->status=='approved'?'<label class="badge badge-success">Active</label>':'<label class="badge badge-danger">In-Active</label>' !!}
                                        </td>
                                        <td scope="col">
                                            <a href="{{route('admin.sellers.order-list',[$seller['id']])}}"
                                               class="btn btn-outline-primary btn-block">
                                                <i class="tio-shopping-cart-outlined"></i>( {{count(array_unique($seller->orders->pluck('order_id')->toArray()))}}
                                                )
                                            </a>
                                        </td>
                                        <td scope="col">
                                            <a href="{{route('admin.sellers.product-list',[$seller['id']])}}"
                                               class="btn btn-outline-primary btn-block">
                                                <i class="tio-premium-outlined mr-1"></i>( {{$seller->product->count()}}
                                                )
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary"
                                               href="{{route('admin.sellers.view',$seller->id)}}">
                                                {{trans('messages.View')}}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {!! $sellers->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

@endpush
