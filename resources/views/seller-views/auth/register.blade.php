@extends('layouts.front-end.app')

@section('title','Seller Apply')

@push('css_or_js')
<link href="{{asset('public/assets/back-end')}}/css/select2.min.css" rel="stylesheet"/>
<link href="{{asset('public/assets/back-end/css/croppie.css')}}" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Custom styles for this page -->

    <style>
        .black{
            color: black;
        }
        .main-card{
            padding: 3rem;
        }
        @media(max-width:800px){
            .main-card{
            padding: 0 !important;
        }
        }
        @media(max-width:375px){
               #image-modal .modal-content{
                 width: 367px !important;
               margin-left: 0 !important;
           }
           #logo-modal .modal-content{
                 width: 367px !important;
               margin-left: 0 !important;
           }
           #popup-banner-image-modal .modal-content{
                 width: 367px !important;
               margin-left: 0 !important;
           }
           .main-card{
            padding: 0 !important;
        }

           }

      @media(max-width:500px){
       #image-modal .modal-content{
                 width: 400px !important;
               margin-left: 0 !important;
           }
           #logo-modal .modal-content{
                 width: 400px !important;
               margin-left: 0 !important;
           }
           #popup-banner-image-modal .modal-content{
                 width: 400px !important;
               margin-left: 0 !important;
           }
           .main-card{
            padding: 0 !important;
        }


          }
      }
    </style>

@endpush


    @section('content')

<div class="container main-card">

    <div class="card o-hidden border-0 shadow-lg my-4">
        <div class="card-body ">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center mb-2 ">
                            <h3 class="" > {{trans('messages.Shop')}} {{trans('messages.Application')}}</h3>
                            <hr>
                        </div>
                        <form class="user" action="{{route('shop.apply')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <h5 class="black">{{trans('messages.Seller')}} {{trans('messages.Info')}} </h5>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="exampleFirstName" name="f_name" value="{{old('f_name')}}" placeholder="First Name" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" id="exampleLastName" name="l_name" value="{{old('l_name')}}" placeholder="Last Name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email" value="{{old('email')}}" placeholder="Email Address" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" id="exampleInputPhone" name="phone" value="{{old('phone')}}" placeholder="Phone Number" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" minlength="6" id="exampleInputPassword" name="password" placeholder="Password" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" minlength="6" id="exampleRepeatPassword" placeholder="Repeat Password" required>
                                    <div class="pass invalid-feedback">{{trans('messages.Repeat')}}  {{trans('messages.password')}} {{trans('messages.not match')}} .</div>
                                </div>
                            </div>
                            <div class="">
                                <div class="pb-1">
                                    <center>
                                        <img style="width: auto;border: 1px solid; border-radius: 10px; max-height:200px;" id="viewer"
                                            src="{{asset('public\assets\back-end\img\400x400\img2.jpg')}}" alt="banner image"/>
                                    </center>
                                </div>

                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" name="image" id="customFileUpload" class="custom-file-input"
                                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label" for="customFileUpload">{{trans('messages.Upload')}} {{trans('messages.image')}}</label>
                                    </div>
                                </div>
                            </div>


                            <h5 class="black">{{trans('messages.Shop')}} {{trans('messages.Info')}}</h5>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0 ">
                                    <input type="text" class="form-control form-control-user" id="shop_name" name="shop_name" placeholder="Shop Name" value="{{old('shop_name')}}"required>
                                </div>
                                <div class="col-sm-6">
                                    <textarea name="shop_address" class="form-control" id="shop_address"rows="1" placeholder="shop address">{{old('shop_address')}}</textarea>
                                </div>
                            </div>
                            <div class="">
                                <div class="pb-1">
                                    <center>
                                        <img style="width: auto;border: 1px solid; border-radius: 10px; max-height:200px;" id="viewerLogo"
                                            src="{{asset('public\assets\back-end\img\400x400\img2.jpg')}}" alt="banner image"/>
                                    </center>
                                </div>

                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" name="logo" id="LogoUpload" class="custom-file-input"
                                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label" for="LogoUpload">{{trans('messages.Upload')}} {{trans('messages.logo')}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="pb-1">
                                    <center>
                                        <img style="width: auto;border: 1px solid; border-radius: 10px; max-height:200px;" id="viewerBanner"
                                             src="{{asset('public\assets\back-end\img\400x400\img2.jpg')}}" alt="banner image"/>
                                    </center>
                                </div>

                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" name="banner" id="BannerUpload" class="custom-file-input"
                                               accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" style="overflow: hidden; padding: 2%">
                                        <label class="custom-file-label" for="BannerUpload">{{trans('messages.Upload')}} {{trans('messages.Banner')}}</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block" id="apply">{{trans('messages.Apply')}} {{trans('messages.Shop')}} </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small"  href="{{route('seller.auth.login')}}">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('shared-partials.image-process._image-crop-modal',['modal_id'=>'image-modal'])
@include('shared-partials.image-process._image-crop-modal',['modal_id'=>'logo-modal'])
@endsection
@push('script')


<!-- Bootstrap core JavaScript-->
<script src="{{asset('public/assets/back-end')}}/vendor/jquery/jquery.min.js"></script>
<script src="{{asset('public/assets/back-end')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('public/assets/back-end')}}/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('public/assets/back-end')}}/js/sb-admin-2.min.js"></script>

{{--Toastr--}}
<script src={{asset("public/assets/back-end/js/toastr.js")}}></script>
{!! Toastr::message() !!}

@if ($errors->any())
    <script>
        @foreach($errors->all() as $error)
        toastr.error('{{$error}}', Error, {
            CloseButton: true,
            ProgressBar: true
        });
        @endforeach
    </script>
@endif
<script>
    $('#exampleInputPassword ,#exampleRepeatPassword').on('keyup',function () {
        var pass = $("#exampleInputPassword").val();
        var passRepeat = $("#exampleRepeatPassword").val();
        if (pass==passRepeat){
            $('.pass').hide();
        }
        else{
            $('.pass').show();
        }
    });
    $('#apply').on('click',function () {

        var image = $("#image-set").val();
        if (image=="")
        {
            $('.image').show();
            return false;
        }
        var pass = $("#exampleInputPassword").val();
        var passRepeat = $("#exampleRepeatPassword").val();
        if (pass!=passRepeat){
            $('.pass').show();
            return false;
        }


    });
    function Validate(file) {
        var x;
        var le = file.length;
        var poin = file.lastIndexOf(".");
        var accu1 = file.substring(poin, le);
        var accu = accu1.toLowerCase();
        if ((accu != '.png') && (accu != '.jpg') && (accu != '.jpeg')) {
            x = 1;
            return x;
        } else {
            x = 0;
            return x;
        }
    }

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

    function readlogoURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#viewerLogo').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function readBannerURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#viewerBanner').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#LogoUpload").change(function () {
        readlogoURL(this);
    });
    $("#BannerUpload").change(function () {
        readBannerURL(this);
    });
</script>

@include('shared-partials.image-process._script',[
    'id'=>'image-modal',
    'height'=>200,
    'width'=>200,
    'multi_image'=>false,
    'route'=>route('image-upload')
    ])

@include('shared-partials.image-process._script',[
    'id'=>'logo-modal',
    'height'=>200,
    'width'=>200,
    'multi_image'=>false,
    'route'=>route('image-upload')
    ])



@endpush
