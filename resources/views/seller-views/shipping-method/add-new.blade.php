@extends('layouts.back-end.app-seller')

@section('title','Add Shipping')

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('seller.dashboard.index')}}">{{trans('messages.Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{trans('messages.business_settings')}}</li>
                <li class="breadcrumb-item">{{trans('messages.update')}}</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="h3 mb-0 text-black-50">{{trans('messages.shipping_method')}} Suggession for Admin.</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{route('seller.business-settings.shipping-method.add')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="title">{{trans('messages.title')}}</label>
                                        <input type="text" name="title" class="form-control" placeholder="">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="duration">{{trans('messages.duration')}}</label>
                                        <input type="text" name="duration" class="form-control"
                                               placeholder="Ex : 4-6 days">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="cost">{{trans('messages.cost')}}</label>
                                        <input type="number" name="cost" class="form-control" placeholder="Ex : 10 $">
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer" style="padding-left: 0">
                                <button type="submit" class="btn btn-primary">{{trans('messages.Submit')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 20px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{trans('messages.shipping_method')}} {{trans('messages.table')}}</h5>
                    </div>
                    <div class="card-body">
                        <table id="datatable"
                               class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                               style="width: 100%">
                            <thead class="thead-light">
                            <tr>
                                <th>{{trans('messages.sl#')}}</th>
                                <th>{{trans('messages.title')}}</th>
                                <th>{{trans('messages.duration')}}</th>
                                <th>{{trans('messages.cost')}}</th>
                                <th>{{trans('messages.status')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($shipping_methods as $k=>$method)
                                <tr>
                                    <th scope="row">{{$k+1}}</th>
                                    <td>{{$method['title']}}</td>
                                    <td>
                                        {{$method['duration']}}
                                    </td>
                                    <td>
                                        {{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($method['cost']))}}
                                    </td>

                                    <td>
                                        @if($method->status==2)
                                            <label class="badge badge-soft-warning">Pending</label>
                                        @elseif($method->status==1)
                                            <label class="badge badge-soft-success">Active</label>
                                        @else
                                            <label class="badge badge-soft-danger">In-Active</label>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

@endpush
