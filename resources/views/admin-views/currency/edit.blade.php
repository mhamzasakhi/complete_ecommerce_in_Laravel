@extends('layouts.back-end.app')

@section('title','Update Currency')

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('messages.Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{trans('messages.Currency')}}</li>
            </ol>
        </nav>
        <!-- Page Heading -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">
                            <i class="tio-money"></i>
                            Update Currency
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.currency.update',[$data['id']])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Currency Name :</label>
                                        <input type="text" name="name"
                                               placeholder="Currency Name"
                                               class="form-control" id="name"
                                               value="{{$data->name}}">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Currency Symbol :</label>
                                        <input type="text" name="symbol"
                                               placeholder="Currency Symbol"
                                               class="form-control" id="symbol"
                                               value="{{$data->symbol}}">
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Currency Code :</label>
                                        <input type="text" name="code"
                                               placeholder="Currency Code"
                                               class="form-control" id="code"
                                               value="{{$data->code}}">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Exchange Rate :</label>
                                        <input type="number" min="0" max="1000000"
                                               name="exchange_rate" step="0.00000001"
                                               placeholder="Exchange Rate"
                                               class="form-control" id="exchange_rate"
                                               value="{{$data->exchange_rate}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" id="add" class="btn btn-primary"
                                        style="color: white">Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

@endpush
