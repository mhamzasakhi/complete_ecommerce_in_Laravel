@extends('layouts.back-end.app')

@section('title','Brand Edit')

@push('css_or_js')
    <link href="{{asset('public/assets/back-end')}}/css/select2.min.css" rel="stylesheet"/>
    <link href="{{asset('public/assets/back-end/css/croppie.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
<div class="content container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Brand Update</li>
        </ol>
    </nav>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="h3 mb-0 text-black-50">{{ trans('messages.brand_update')}}</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.brand.update',[$b['id']])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{ trans('messages.name')}}</label>
                                    <input type="text" name="name" value="{{$b['name']}}" class="form-control" id="name"
                                            placeholder="Ex : LUX">
                                </div>
                                <div class="form-group">
                                    <label for="brand">{{ trans('messages.brand_logo')}}</label><span class="badge badge-soft-danger">( ratio 1:1 )</span>
                                    <br>
                                    <div class="custom-file">
                                        <input type="file" name="image" id="customFileUpload" class="custom-file-input"
                                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label" for="customFileUpload">{{trans('messages.choose')}} {{trans('messages.file')}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <center>
                                <img style="border-radius: 10px; max-height:200px;" id="viewer"
                                    src="{{asset('storage/app/public/brand')}}/{{$b['image']}}" alt="banner image"/>
                            </center>
                            </div>
                        </div>


                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{ trans('messages.update')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--modal-->
    @include('shared-partials.image-process._image-crop-modal',['modal_id'=>'brand-image-modal','width'=>1000,'margin_left'=>'-53%'])
    <!--modal-->
</div>
@endsection

@push('script')
    <script src="{{asset('public/assets/back-end')}}/js/select2.min.js"></script>
    <script>
        $(".js-example-theme-single").select2({
            theme: "classic"
        });

        $(".js-example-responsive").select2({
            width: 'resolve'
        });
    </script>

    @include('shared-partials.image-process._script',[
    'id'=>'brand-image-modal',
    'height'=>400,
    'width'=>800,
    'multi_image'=>false,
    'route'=>route('image-upload')
    ])

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
    </script>
@endpush
