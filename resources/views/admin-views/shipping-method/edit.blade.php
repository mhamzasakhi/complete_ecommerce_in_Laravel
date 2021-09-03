@extends('layouts.back-end.app')

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Shipping Method Update</li>
        </ol>
    </nav>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-black-50">{{trans('messages.shipping_method')}} {{trans('messages.update')}}</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{trans('messages.shipping_method')}} {{trans('messages.form')}}
                </div>
                <div class="card-body">
                    <form action="{{route('admin.business-settings.shipping-method.update',[$method['id']])}}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                    <label for="title">{{trans('messages.title')}}</label>
                                    <input type="text" name="title" value="{{$method['title']}}" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                    <label for="duration">{{trans('messages.duration')}}</label>
                                    <input type="text" name="duration" value="{{$method['duration']}}" class="form-control" placeholder="Ex : 4-6 days">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                    <label for="cost">{{trans('messages.cost')}}</label>
                                    <input type="number" min="1" max="1000000" name="cost" value="{{\App\CPU\BackEndHelper::usd_to_currency($method['cost'])}}" class="form-control" placeholder="Ex : 10 $">
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary ">{{trans('messages.Update')}}</button>
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
