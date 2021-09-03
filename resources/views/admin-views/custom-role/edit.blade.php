@extends('layouts.back-end.app')
@section('title','Edit Role')
@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Role Update</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.custom-role.update',[$role['id']])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{trans('messages.role_name')}}</label>
                                <input type="text" name="name" value="{{$role['name']}}" class="form-control" id="name"
                                       aria-describedby="emailHelp"
                                       placeholder="Ex : Store">
                            </div>

                            <label for="module">{{trans('messages.module_permission')}} : </label>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="order" class="form-check-input"
                                               id="order" {{in_array('order',(array)json_decode($role['module_access']))?'checked':''}}>
                                        <label class="form-check-label" for="order">{{trans('messages.Order')}}</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="product" class="form-check-input"
                                               id="product" {{in_array('product',(array)json_decode($role['module_access']))?'checked':''}}>
                                        <label class="form-check-label"
                                               for="product">{{trans('messages.product')}}</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="marketing"
                                               class="form-check-input"
                                               id="marketing" {{in_array('marketing',(array)json_decode($role['module_access']))?'checked':''}}>
                                        <label class="form-check-label"
                                               for="marketing">{{trans('messages.marketing')}}</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="business_section"
                                               class="form-check-input"
                                               id="business_section" {{in_array('business_section',(array)json_decode($role['module_access']))?'checked':''}}>
                                        <label class="form-check-label"
                                               for="business_section">{{trans('messages.business_section')}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="user_section"
                                               class="form-check-input"
                                               id="user_section" {{in_array('user_section',(array)json_decode($role['module_access']))?'checked':''}}>
                                        <label class="form-check-label"
                                               for="user_section">{{trans('messages.user_section')}}</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="support_section"
                                               class="form-check-input"
                                               id="support_section" {{in_array('support_section',(array)json_decode($role['module_access']))?'checked':''}}>
                                        <label class="form-check-label"
                                               for="support_section">{{trans('messages.support_section')}}</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="business_settings"
                                               class="form-check-input"
                                               id="business_settings" {{in_array('business_settings',(array)json_decode($role['module_access']))?'checked':''}}>
                                        <label class="form-check-label"
                                               for="business_settings">{{trans('messages.business_settings')}}</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="web_&_app_settings"
                                               class="form-check-input"
                                               id="web_&_app_settings" {{in_array('web_&_app_settings',(array)json_decode($role['module_access']))?'checked':''}}>
                                        <label class="form-check-label"
                                               for="web_&_app_settings">{{trans('messages.web_&_app_settings')}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="report" class="form-check-input"
                                               id="report" {{in_array('report',(array)json_decode($role['module_access']))?'checked':''}}>
                                        <label class="form-check-label"
                                               for="report">{{trans('messages.Report')}}</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="employee_section"
                                               class="form-check-input"
                                               id="employee_section" {{in_array('employee_section',(array)json_decode($role['module_access']))?'checked':''}}>
                                        <label class="form-check-label"
                                               for="employee_section">{{trans('messages.employee_section')}}</label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">{{trans('messages.update')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

@endpush
