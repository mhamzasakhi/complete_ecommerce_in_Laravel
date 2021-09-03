@extends('layouts.back-end.app')

@section('title','Seller View')

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
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard.index')}}">{{trans('messages.Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">Seller Details</li>
            </ol>
        </nav>

        <!-- Page Heading -->
        <div class="d-sm-flex row align-items-center justify-content-between mb-2">
            <div class="col-md-6">
                <a href="{{route('admin.sellers.seller-list')}}" class="btn btn-primary mt-3 mb-3">Back to seller
                    list</a>
            </div>
            <div class="col-md-6 mt-3 mb-3">
                @if ($seller->status=="pending")
                    <div class="mt-4 pr-2 float-right">
                        <h4><i class="tio-shop-outlined"></i> Seller request for open a shop.</h4>
                        <div class="text-center">
                            <form class="d-inline-block" action="{{route('admin.sellers.updateStatus')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$seller->id}}">
                                <input type="hidden" name="status" value="approved">
                                <button type="submit" class="btn btn-primary">{{trans('messages.Approve')}}</button>
                            </form>
                            <form class="d-inline-block" action="{{route('admin.sellers.updateStatus')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$seller->id}}">
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="btn btn-danger">{{trans('messages.reject')}}</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-capitalize">
                        {{trans('messages.Seller')}} {{trans('messages.Account')}} <br>
                        @if($seller->status=='approved')
                            <form class="d-inline-block" action="{{route('admin.sellers.updateStatus')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$seller->id}}">
                                <input type="hidden" name="status" value="suspended">
                                <button type="submit"
                                        class="btn btn-outline-danger">{{trans('messages.suspend')}}</button>
                            </form>
                        @elseif($seller->status=='rejected' || $seller->status=='suspended')
                            <form class="d-inline-block" action="{{route('admin.sellers.updateStatus')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$seller->id}}">
                                <input type="hidden" name="status" value="approved">
                                <button type="submit"
                                        class="btn btn-outline-success">{{trans('messages.activate')}}</button>
                            </form>
                        @endif
                    </div>
                    <div class="card-body">
                        <h4>
                            Status : {!! $seller->status=='approved'?'<label class="badge badge-success">Active</label>':'<label class="badge badge-danger">In-Active</label>' !!}
                        </h4>
                        <h5>{{trans('messages.name')}} : {{$seller->f_name}} {{$seller->l_name}}</h5>
                        <h5>{{trans('messages.Email')}} : {{$seller->email}}</h5>
                        <h5>{{trans('messages.Phone')}} : {{$seller->phone}}</h5>
                    </div>
                </div>
            </div>
            @if($seller->shop)
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            {{trans('messages.Shop')}} {{trans('messages.info')}}
                        </div>
                        <div class="card-body">
                            <h5>{{trans('messages.seller_b')}} : {{$seller->shop->name}}</h5>
                            <h5>{{trans('messages.Phone')}} : {{$seller->shop->contact}}</h5>
                            <h5>{{trans('messages.address')}} : {{$seller->shop->address}}</h5>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-header">
                        {{trans('messages.bank_info')}}
                    </div>
                    <div class="card-body">
                        <div class="col-md-8 mt-4">

                            <h4>{{trans('messages.bank_name')}}
                                : {{$seller->bank_name ? $seller->bank_name : 'No Data found'}}</h4>
                            <h6>{{trans('messages.Branch')}}
                                : {{$seller->branch ? $seller->branch : 'No Data found'}}</h6>
                            <h6>{{trans('messages.holder_name')}}
                                : {{$seller->holder_name ? $seller->holder_name : 'No Data found'}}</h6>
                            <h6>{{trans('messages.account_no')}}
                                : {{$seller->account_no ? $seller->account_no : 'No Data found'}}</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mt-3">
                <form action="{{route('admin.sellers.sales-commission-update',[$seller['id']])}}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <label> Sales Commission : </label>
                            <label class="switch ml-3">
                                <input type="checkbox" name="status"
                                       class="status"
                                       value="1" {{$seller['sales_commission_percentage']!=null?'checked':''}}>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="card-body">
                            <small class="badge badge-soft-danger mb-3">
                                If sales commission is disabled here, the system default commission will be applied.
                            </small>
                            <div class="form-group">
                                <label>Commission ( % )</label>
                                <input type="number" value="{{$seller['sales_commission_percentage']}}"
                                       class="form-control" name="commission">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')

@endpush
