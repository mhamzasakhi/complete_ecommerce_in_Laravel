
@extends('layouts.back-end.app-seller')
@section('title','Shop Edit')
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{asset('public/assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
     <!-- Custom styles for this page -->
     <link href="{{asset('public/assets/back-end/css/croppie.css')}}" rel="stylesheet">
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <style>
        @media(max-width:375px){
         #shop-image-modal .modal-content{
           width: 367px !important;
         margin-left: 0 !important;
     }

     }

@media(max-width:500px){
 #shop-image-modal .modal-content{
           width: 400px !important;
         margin-left: 0 !important;
     }
}
 </style>
@endpush
@section('content')
    <!-- Content Row -->
    <div class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="h3 mb-0 ">Edit Shop Info</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('seller.shop.update',[$shop->id])}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Shop Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{$shop->name}}" class="form-control" id="name"
                                            required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Contact <span class="text-danger">*</span></label>
                                    <input type="text" name="contact" value="{{$shop->contact}}" class="form-control" id="name"
                                            required>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address <span class="text-danger">*</span></label>
                                    <textarea type="text" rows="4" name="address" value="" class="form-control" id="address"
                                            required>{{$shop->address}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{trans('messages.Upload')}} {{trans('messages.image')}}</label>
                                    <div class="custom-file">
                                        <input type="file" name="image" id="customFileUpload" class="custom-file-input"
                                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label" for="customFileUpload">{{trans('messages.choose')}} {{trans('messages.file')}}</label>
                                    </div>
                                </div>
                                <center>
                                    <img style="width: auto;border: 1px solid; border-radius: 10px; max-height:200px;" id="viewer"
                                    onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                    src="{{asset('storage/app/public/shop/'.$shop->image)}}" alt="Product thumbnail"/>
                                </center>
                            </div>
                            <div class="col-md-6 mb-4 mt-2">
                                <div class="form-group">
                                    <label for="name">{{trans('messages.Upload')}} {{trans('messages.Banner')}} <small style="color: red">Ratio : ( 6:1 )</small></label>
                                    <div class="custom-file">
                                        <input type="file" name="banner" id="BannerUpload" class="custom-file-input"
                                               accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label" for="BannerUpload">{{trans('messages.choose')}} {{trans('messages.file')}}</label>
                                    </div>
                                </div>
                                <center>
                                    <img style="width: auto; height:auto; border: 1px solid; border-radius: 10px; max-height:200px" id="viewerBanner"
                                         onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                         src="{{asset('storage/app/public/shop/banner/'.$shop->banner)}}" alt="Product thumbnail"/>
                                </center>
                            </div>
                        </div>



                        <button type="submit" class="btn btn-primary" id="btn_update">Update</button>
                        <a class="btn btn-danger" href="{{route('seller.shop.view')}}">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--modal-->
    @include('shared-partials.image-process._image-crop-modal',['modal_id'=>'shop-image-modal'])
    <!--modal-->
    </div>
@endsection

@push('script')
    <!-- Page level plugins -->
    <script src="{{asset('public/assets/back-end/js/croppie.js')}}"></script>
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

        function readBannerURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewerBanner').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileUpload").change(function () {
            readURL(this);
        });

        $("#BannerUpload").change(function () {
            readBannerURL(this);
        });
   </script>



    @include('shared-partials.image-process._script',[
     'id'=>'shop-image-modal',
     'height'=>300,
     'width'=>300,
     'multi_image'=>false,
     'route'=>route('image-upload')
     ])


@endpush
