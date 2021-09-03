@extends('layouts.back-end.app')

@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{asset('public/assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
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
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
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
    </style>
@endpush

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('messages.Dashboard')}}</a></li>
            <li class="breadcrumb-item" aria-current="page">{{trans('messages.SMS')}} {{trans('messages.Gateway')}} </li>
        </ol>
    </nav>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h4 class="mb-0 text-black-50">{{trans('messages.SMS')}} {{trans('messages.Gateway')}}</h4>
    </div>

    <div class="row" style="padding-bottom: 20px">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body" style="padding: 20px">
                    <h5 class="text-center">{{trans('messages.NEXMO')}} {{trans('messages.SMS')}} </h5>
                    @php($config=\App\CPU\Helpers::get_business_settings('sms_nexmo'))
                    <form action="{{route('admin.business-settings.sms-gateway.update',['sms_nexmo'])}}"
                          method="post">
                        @csrf
                        @if(isset($config))
                            <div class="form-group mb-2">
                                <label class="control-label">{{trans('messages.nexmo_gateway')}}</label>
                            </div>
                            <div class="form-group mb-2 mt-2">
                                <input type="radio" name="status" value="1" {{$config['status']==1?'checked':''}}>
                                <label style="padding-left: 10px">{{trans('messages.Active')}}</label>
                                <br>
                            </div>
                            <div class="form-group mb-2">
                                <input type="radio" name="status" value="0" {{$config['status']==0?'checked':''}}>
                                <label style="padding-left: 10px">{{trans('messages.Inactive')}}</label>
                                <br>
                            </div>
                            <div class="form-group mb-2">
                                <label style="padding-left: 10px">{{trans('messages.api_key')}}</label><br>
                                <input type="text" class="form-control" name="nexmo_key" value="{{$config['nexmo_key']}}">
                            </div>
                            <div class="form-group mb-2">
                                <label style="padding-left: 10px">{{trans('messages.api_secret')}}</label><br>
                                <input type="text" class="form-control" name="nexmo_secret"
                                       value="{{$config['nexmo_secret']}}">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">{{trans('messages.Save')}}</button>
                        @else
                            <button type="submit" class="btn btn-primary mb-2">{{trans('messages.Configure')}}</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')

@endpush
