@extends('layouts.back-end.app')
@section('title','Flash Deal Update')
@push('css_or_js')
    <link href="{{asset('public/assets/back-end/css/tags-input.min.css')}}" rel="stylesheet">
    <link href="{{ asset('public/assets/select2/css/select2.min.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
<div class="content container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Flash Deal</li>
            <li class="breadcrumb-item">Update Deal</li>
        </ol>
    </nav>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ trans('messages.deal_form')}}
                </div>
                <div class="card-body">
                    <form action="{{route('admin.deal.update',[$deal['id']])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" name="deal_type" value="flash_deal"  class="d-none">
                                    <label for="name">{{ trans('messages.title')}}</label>
                                    <input type="text" name="title" value="{{$deal->title}}" required
                                           class="form-control" id="title"
                                           placeholder="Ex : LUX">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">{{ trans('messages.start_date')}}</label>
                                    <input type="date" value="{{date('Y-m-d',strtotime($deal['start_date']))}}" name="start_date" required
                                           class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="name">{{ trans('messages.end_date')}}</label>
                                    <input type="date" value="{{date('Y-m-d', strtotime($deal['end_date']))}}" name="end_date" required
                                           class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                {{--to do--}}
                                {{--<div class="col-md-12" style="padding-top: 20px">
                                    <input type="checkbox" name="featured"
                                        {{$deal['featured']==1?'checked':''}}>
                                    <label for="featured">{{ trans('messages.featured')}}</label>
                                </div>--}}
                                <div class="col-md-12 pt-3">
                                    <label for="name">{{trans('messages.Upload')}} {{trans('messages.Image')}}</label><span class="badge badge-soft-danger">( ratio 5:1 )</span>
                                    <div class="custom-file">
                                        <input type="file" name="image" id="customFileUpload" class="custom-file-input"
                                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label" for="customFileUpload">{{trans('messages.choose')}} {{trans('messages.file')}}</label>
                                    </div>
                                </div>
                                <div class="col-md-12" style="padding-top: 20px">
                                    <center>
                                        <img style="width: auto;border: 1px solid; border-radius: 10px; max-height:200px;" id="viewer"
                                        onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'" src="{{asset('storage/app/public/deal')}}/{{$deal['banner']}}" alt="banner image"/>
                                    </center>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer pl-0">
                            <button type="submit"
                                    class="btn btn-primary ">{{ trans('messages.update')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--modal-->
    @include('shared-partials.image-process._image-crop-modal',['modal_id'=>'banner-image-modal','width'=>1100,'margin_left'=>'-65%'])
</div>
@endsection

@push('script')
    <script src="{{asset('public/assets/back-end')}}/js/select2.min.js"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileUpload").change(function () {
            readURL(this);
        });

        $(".js-example-theme-single").select2({
            theme: "classic"
        });

        $(".js-example-responsive").select2({
            width: 'resolve'
        });
    </script>

    <!-- Page level custom scripts -->

    <script>
        $(document).ready(function () {
            // color select select2
            $('.color-var-select').select2({
                templateResult: colorCodeSelect,
                templateSelection: colorCodeSelect,
                escapeMarkup: function (m) {
                    return m;
                }
            });

            function colorCodeSelect(state) {
                var colorCode = $(state.element).val();
                if (!colorCode) return state.text;
                return "<span class='color-preview' style='background-color:" + colorCode + ";'></span>" + state.text;
            }
        });
    </script>

    @include('shared-partials.image-process._script',[
     'id'=>'banner-image-modal',
     'height'=>170,
     'width'=>1050,
     'multi_image'=>false,
     'route'=>route('image-upload')
     ])
@endpush
