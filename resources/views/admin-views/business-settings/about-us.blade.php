@extends('layouts.back-end.app')
@section('title','About Us')
@section('content')
<div class="content container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('messages.Dashboard')}}</a></li>
            <li class="breadcrumb-item" aria-current="page">{{trans('messages.about_us')}}</li>
        </ol>
    </nav>

    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between pl-4 pr-4">
                        <div>
                            <h5><b>{{trans('messages.about_us')}}</b></h5>
                        </div>
                    </div>
                </div>

                <form action="{{route('admin.business-settings.about-update')}}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <textarea name="about_us" id="editor" cols="30" rows="20" class="form-control">{{$about_us->value}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input class="btn btn-primary btn-block" type="submit" name="btn" value="submit">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@push('script')

@endpush
