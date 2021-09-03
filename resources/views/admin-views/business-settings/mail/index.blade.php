@extends('layouts.back-end.app')
@section('title','Mail Config')
@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('messages.Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{trans('messages.mail_config')}}</li>
            </ol>
        </nav>

        <div class="row" style="padding-bottom: 20px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="padding: 20px">

                        @php($config=\App\Model\BusinessSetting::where(['type'=>'mail_config'])->first())
                        @php($data=json_decode($config['value'],true))
                        <form action="{{route('admin.business-settings.mail.update')}}"
                              method="post">
                            @csrf
                            @if(isset($config))
                                <div class="form-group mb-2">
                                    <label class="control-label">{{trans('messages.smtp_mail_config')}}</label>
                                </div>
                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{trans('messages.mailer_name')}}</label><br>
                                    <input type="text" placeholder="ex : Alex" class="form-control" name="name"
                                           value="{{env('APP_MODE')=='demo'?'':$data['name']}}">
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{trans('messages.Host')}}</label><br>
                                    <input type="text" class="form-control" name="host"
                                           value="{{env('APP_MODE')=='demo'?'':$data['host']}}">
                                </div>
                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{trans('messages.Driver')}}</label><br>
                                    <input type="text" class="form-control" name="driver"
                                           value="{{env('APP_MODE')=='demo'?'':$data['driver']}}">
                                </div>
                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{trans('messages.port')}}</label><br>
                                    <input type="text" class="form-control" name="port"
                                           value="{{env('APP_MODE')=='demo'?'':$data['port']}}">
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{trans('messages.Username')}}</label><br>
                                    <input type="text" placeholder="ex : ex@yahoo.com" class="form-control"
                                           name="username" value="{{env('APP_MODE')=='demo'?'':$data['username']}}">
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{trans('messages.email_id')}}</label><br>
                                    <input type="text" placeholder="ex : ex@yahoo.com" class="form-control" name="email"
                                           value="{{env('APP_MODE')=='demo'?'':$data['email_id']}}">
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{trans('messages.Encryption')}}</label><br>
                                    <input type="text" placeholder="ex : tls" class="form-control" name="encryption"
                                           value="{{env('APP_MODE')=='demo'?'':$data['encryption']}}">
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{trans('messages.password')}}</label><br>
                                    <input type="text" class="form-control" name="password"
                                           value="{{env('APP_MODE')=='demo'?'':$data['password']}}">
                                </div>
                                <button type="{{env('APP_MODE')!='demo'?'submit':'button'}}"
                                        onclick="{{env('APP_MODE')!='demo'?'':'call_demo()'}}"
                                        class="btn btn-primary mb-2">{{trans('messages.save')}}</button>
                            @else
                                <button type="submit"
                                        class="btn btn-primary mb-2">{{trans('messages.Configure')}}</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

@endpush
