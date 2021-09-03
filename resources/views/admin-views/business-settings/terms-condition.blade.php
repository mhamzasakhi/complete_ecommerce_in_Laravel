@extends('layouts.back-end.app')

@section('title','Terms & Condition')

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('messages.Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{trans('messages.terms_and_condition')}}</li>
            </ol>
        </nav>

        <div class="row" style="margin-top: 20px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between pl-4 pr-4">
                            <div>
                                <h2>{{trans('messages.terms_and_condition')}}</h2>
                            </div>
                        </div>
                    </div>

                    <form action="{{route('admin.business-settings.update-terms')}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="editor">{{trans('messages.terms_and_condition')}}</label><textarea
                                        class="form-control" id="editor"
                                        name="value">{{$terms_condition->value}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input class="form-control btn-primary" type="submit" name="btn">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

