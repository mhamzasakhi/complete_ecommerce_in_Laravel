@extends('layouts.back-end.app')
@section('title','Banner')
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Custom styles for this page -->
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
            background-color: #377dff;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #377dff;
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

        @media (max-width: 500px) {
            .propup {
                margin-top: 2%;
            }

        }

        #main-banner-image-modal .modal-content {
            width: 1116px !important;
            margin-left: -264px !important;
        }

        #secondary-banner-image-modal .modal-content {
            width: 1116px !important;
            margin-left: -264px !important;
        }

        #popup-banner-image-modal .modal-content {
            width: 1116px !important;
            margin-left: -264px !important;
        }

        @media (max-width: 768px) {
            #main-banner-image-modal .modal-content {
                width: 698px !important;
                margin-left: -75px !important;
            }

            #secondary-banner-image-modal .modal-content {
                width: 698px !important;
                margin-left: -75px !important;
            }

            #popup-banner-image-modal .modal-content {
                width: 698px !important;
                margin-left: -75px !important;
            }


        }

        @media (max-width: 375px) {
            #main-banner-image-modal .modal-content {
                width: 367px !important;
                margin-left: 0 !important;
            }

            #secondary-banner-image-modal .modal-content {
                width: 367px !important;
                margin-left: 0 !important;
            }

            #popup-banner-image-modal .modal-content {
                width: 367px !important;
                margin-left: 0 !important;
            }

        }

        @media (max-width: 500px) {
            #main-banner-image-modal .modal-content {
                width: 400px !important;
                margin-left: 0 !important;
            }

            #secondary-banner-image-modal .modal-content {
                width: 400px !important;
                margin-left: 0 !important;
            }

            #popup-banner-image-modal .modal-content {
                width: 400px !important;
                margin-left: 0 !important;
            }
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('messages.Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{trans('messages.Banner')}}</li>
            </ol>
        </nav>
        <!-- Page Heading -->
        <div class="row">
            <div class="col-md-12" id="banner-btn">
                <button id="main-banner-add" class="btn btn-primary"><i
                        class="tio-add-circle"></i> {{ trans('messages.add_main_banner')}}</button>
                <button id="secondary-banner-add"
                        class="btn btn-primary ml-2"><i
                        class="tio-add-circle"></i> {{ trans('messages.add_secondary_banner')}}</button>
                <button id="popup-banner-add"
                        class="btn btn-primary ml-2 propup"><i
                        class="tio-add-circle"></i> {{ trans('messages.add_popup_banner')}}</button>
            </div>
        </div>
        <!-- Content Row -->
        <div class="row pt-4" id="main-banner" style="display: none">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ trans('messages.main_banner_form')}}
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.banner.store')}}" method="post" enctype="multipart/form-data"
                              class="banner_form">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" id="id" name="id">
                                        <label for="name">{{ trans('messages.banner_url')}}</label>
                                        <input type="text" name="url" class="form-control" id="url" required>
                                        <input type="hidden" id="type" name="banner_type" value="Main Banner">
                                        <label for="name">{{ trans('messages.Image')}}</label><span
                                            class="badge badge-soft-danger">( ratio 4:1 )</span>
                                        <br>
                                        <div class="custom-file">
                                            <input type="file" name="image" id="mbimageFileUploader"
                                                   class="custom-file-input"
                                                   accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                            <label class="custom-file-label"
                                                   for="mbimageFileUploader">{{trans('messages.choose')}} {{trans('messages.file')}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <center>
                                            <img
                                                style="width: auto;border: 1px solid; border-radius: 10px; max-height:200px;"
                                                id="mbImageviewer"
                                                src="{{asset('public\assets\back-end\img\400x400\img1.jpg')}}"
                                                alt="banner image"/>
                                        </center>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <a class="btn btn-secondary text-white cancel">{{ trans('messages.Cancel')}}</a>
                                <button id="add" type="submit"
                                        class="btn btn-primary">{{ trans('messages.save')}}</button>
                                <a id="update" class="btn btn-primary"
                                   style="display: none; color: #fff;">{{ trans('messages.update')}}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-4" id="secondary-banner" style="display: none">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ trans('messages.secondary_banner_form')}}
                    </div>
                    <div class="card-body">
                        <form class="banner_form" action="{{route('admin.banner.store')}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" id="id" name="id">
                                        <label for="name">{{ trans('messages.banner_url')}}</label>
                                        <input type="text" name="url" class="form-control" id="footerurl" required>
                                        <input type="hidden" id="footertype" name="banner_type" value="Footer Banner">
                                        <label for="name">{{ trans('messages.Image')}}</label><span
                                            class="badge badge-soft-danger">( ratio 3:1 )</span>
                                        <br>
                                        <div class="custom-file">
                                            <input type="file" name="image" id="fbimageFileUploader"
                                                   class="custom-file-input"
                                                   accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                            <label class="custom-file-label"
                                                   for="fbimageFileUploader">{{trans('messages.choose')}} {{trans('messages.file')}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <center>
                                            <img
                                                style="width: auto;border: 1px solid; border-radius: 10px; max-height:200px;"
                                                id="fbImageviewer"
                                                src="{{asset('public\assets\back-end\img\400x400\img2.jpg')}}"
                                                alt="banner image"/>
                                        </center>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <a class="btn btn-secondary text-white cancel">{{ trans('messages.Cancel')}}</a>
                                <button type="submit" id="addfooter"
                                        class="btn btn-primary">{{ trans('messages.save')}}</button>
                                <a id="footerupdate" class="btn btn-primary"
                                   style="display: none; color: #fff;">{{ trans('messages.update')}}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-4" id="popup-banner" style="display: none">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ trans('messages.popup_banner_form')}}
                    </div>
                    <div class="card-body">
                        <form class="banner_form" action="{{route('admin.banner.store')}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" id="id" name="id">
                                        <label for="name">{{ trans('messages.banner_url')}}</label>
                                        <input type="text" name="url" class="form-control" id="popupurl" required>
                                        <input type="hidden" id="popuptype" name="banner_type" value="Popup Banner">
                                        <label for="name">{{trans('messages.Image')}}</label><span
                                            class="badge badge-soft-danger">( ratio 3:1 )</span>
                                        <br>
                                        <div class="custom-file">
                                            <input type="file" name="image" id="pbimageFileUploader"
                                                   class="custom-file-input"
                                                   accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                            <label class="custom-file-label"
                                                   for="pbimageFileUploader">{{trans('messages.choose')}} {{trans('messages.file')}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <center>
                                            <img
                                                style="width: auto;border: 1px solid; border-radius: 10px; max-height:200px;"
                                                id="pbImageviewer"
                                                src="{{asset('public\assets\back-end\img\400x400\img2.jpg')}}"
                                                alt="banner image"/>
                                        </center>
                                    </div>
                                </div>
                            </div>

                            <div class="card-secondary">
                                <a class="btn btn-secondary text-white cancel">{{ trans('messages.Cancel')}}</a>
                                <button id="addpopup"
                                        type="submit" class="btn btn-primary">{{ trans('messages.save')}}</button>
                                <a id="popupupdate" class="btn btn-primary"
                                   style="display: none; color: #fff;">{{ trans('messages.update')}}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="row" style="margin-top: 20px" id="banner-table">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ trans('messages.banner_table')}}</h5>
                    </div>
                    <div class="card-body" style="padding: 0">
                        <div class="table-responsive">
                            <table id="columnSearchDatatable"
                                   class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                <tr>
                                    <th>{{trans('messages.sl')}}</th>
                                    <th>{{trans('messages.image')}}</th>
                                    <th>{{trans('messages.banner_type')}}</th>
                                    <th>{{trans('messages.published')}}</th>
                                    <th style="width: 50px">{{trans('messages.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($banners as $key=>$banner)
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <td>
                                            <img width="80"
                                                 onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                 src="{{asset('storage/app/public/banner')}}/{{$banner['photo']}}">
                                        </td>
                                        <td>{{$banner->banner_type}}</td>
                                        <td><label class="switch"><input type="checkbox" class="status"
                                                                         id="{{$banner->id}}" <?php if ($banner->published == 1) echo "checked" ?>><span
                                                    class="slider round"></span></label></td>

                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <i class="tio-settings"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item  edit" style="cursor: pointer;"
                                                       id="{{$banner['id']}}"> {{ trans('messages.Edit')}}</a>
                                                    <a class="dropdown-item delete" style="cursor: pointer;"
                                                       id="{{$banner['id']}}"> {{ trans('messages.Delete')}}</a>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{$banners->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{asset('public/assets/back-end')}}/js/select2.min.js"></script>
    <script>
        function mbimagereadURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#mbImageviewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#mbimageFileUploader").change(function () {
            mbimagereadURL(this);
        });

        function fbimagereadURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#fbImageviewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#fbimageFileUploader").change(function () {
            fbimagereadURL(this);
        });


        function pbimagereadURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#pbImageviewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#pbimageFileUploader").change(function () {
            pbimagereadURL(this);
        });

    </script>
    <script>
        $('#main-banner-add').on('click', function () {
            $('#main-banner').show();
            $('#secondary-banner').hide();
            $('#popup-banner').hide();
            $('#banner-table').hide();
        });
        $('#secondary-banner-add').on('click', function () {
            $('#main-banner').hide();
            $('#secondary-banner').show();
            $('#popup-banner').hide();
            $('#banner-table').hide();
        });

        $('#popup-banner-add').on('click', function () {
            $('#main-banner').hide();
            $('#secondary-banner').hide();
            $('#popup-banner').show();
            $('#banner-table').hide();
        });

        $('.cancel').on('click', function () {
            $('.banner_form').attr('action', "{{route('admin.banner.store')}}");
            $('#main-banner').hide();
            $('#secondary-banner').hide();
            $('#popup-banner').hide();
            $('#banner-table').show();
        });

        $(document).on('change', '.status', function () {
            var id = $(this).attr("id");
            if ($(this).prop("checked") == true) {
                var status = 1;
            } else if ($(this).prop("checked") == false) {
                var status = 0;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.banner.status')}}",
                method: 'POST',
                data: {
                    id: id,
                    status: status
                },
                success: function (data) {
                    if (data == 1) {
                        toastr.success('Banner published successfully');
                    } else {
                        toastr.success('Banner unpublished successfully');
                    }
                }
            });
        });

        $(document).on('click', '.delete', function () {
            var id = $(this).attr("id");
            Swal.fire({
                title: 'Are you sure delete this banner?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{route('admin.banner.delete')}}",
                        method: 'POST',
                        data: {id: id},
                        success: function () {
                            toastr.success('Banner deleted successfully');
                            location.reload();
                        }
                    });
                }
            })
        });

        $(document).on('click', '.edit', function () {
            var id = $(this).attr("id");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.banner.edit')}}",
                method: 'POST',
                data: {id: id},
                success: function (data) {
                    $('.banner_form').attr('action', "{{route('admin.banner.update')}}");
                    // console.log(data);
                    if (data.banner_type == 'Main Banner') {

                        $('#main-banner').show();
                        $('#banner-table').hide();
                        $('#add').html("{{ trans('messages.update')}}");
                        // $('#add').hide();
                        // $('#update').show();
                        // $('#id').val(data.id);
                        $('#url').val(data.url);
                        $('#url').siblings('#id').val(data.id);
                        $('#mbImageviewer').attr('src', "{{asset('storage/app/public/banner')}}" + "/" + data.photo);
                        $('#cate-table').hide();

                    } else if (data.banner_type == 'Footer Banner') {

                        $('#secondary-banner').show();
                        $('#banner-table').hide();
                        // $('#addfooter').hide();
                        $('#addfooter').html("{{ trans('messages.update')}}");
                        // $('#footerupdate').show();
                        // $('#id').val(data.id);
                        $('#footerurl').val(data.url);
                        $('#footerurl').siblings('#id').val(data.id);
                        $('#fbImageviewer').attr('src', "{{asset('storage/app/public/banner')}}" + "/" + data.photo);
                        $('#cate-table').hide();


                    } else {
                        $('#popup-banner').show();
                        $('#banner-table').hide();
                        $('#addpopup').html("{{ trans('messages.update')}}");
                        // $('#addpopup').hide();
                        // $('#popupupdate').show();
                        // $('#id').val(data.id);
                        $('#popupurl').val(data.url);
                        $('#popupurl').siblings('#id').val(data.id);
                        $('#pbImageviewer').attr('src', "{{asset('storage/app/public/banner')}}" + "/" + data.photo);
                        $('#cate-table').hide();
                    }


                }
            });
        });
        $('#update').on('click', function () {
            $('#update').attr("disabled", true);
            var id = $('#id').val();
            var name = $('#url').val();
            var type = $('#type').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{route('admin.banner.update')}}",
                method: 'POST',
                data: {
                    id: id,
                    url: name,
                    banner_type: type,

                },
                success: function (data) {
                    console.log(data);
                    $('#url').val('');
                    $.ajax({
                        type: 'get',
                        url: '{{route('image-remove',[0,'main_banner_image_modal'])}}',
                        dataType: 'json',
                        success: function (data) {
                            if (data.success === 1) {
                                $("#img-suc").hide();
                                $("#img-err").hide();
                                $("#crop").hide();
                                $("#show-images").html(data.photo);
                                $("#image-count").text(data.count);
                            } else if (data.success === 0) {
                                $("#img-suc").hide();
                                $("#img-err").show();
                            }
                        },
                    });
                    toastr.success('Main Banner updated Successfully.');


                    location.reload();
                }
            });
            $('#save').hide();

        });
        $('#footerupdate').on('click', function () {
            $('#footerupdate').attr("disabled", true);
            var id = $('#id').val();
            var name = $('#footerurl').val();
            var type = $('#footertype').val();
            console.log(type)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{route('admin.banner.update')}}",
                method: 'POST',
                data: {
                    id: id,
                    url: name,
                    banner_type: type,

                },
                success: function (data) {

                    $('#url').val('');
                    $.ajax({
                        type: 'get',
                        url: '{{route('image-remove',[0,'secondary_banner_image_modal'])}}',
                        dataType: 'json',
                        success: function (data) {
                            if (data.success === 1) {
                                $("#img-suc").hide();
                                $("#img-err").hide();
                                $("#crop").hide();
                                $("#show-images").html(data.photo);
                                $("#image-count").text(data.count);
                            } else if (data.success === 0) {
                                $("#img-suc").hide();
                                $("#img-err").show();
                            }
                        },
                    });
                    toastr.success('Secondary Banner updated Successfully.');


                    location.reload();
                }
            });
            $('#save').hide();

        });
        $('#popupupdate').on('click', function () {
            $('#popupupdate').attr("disabled", true);
            var id = $('#id').val();
            var name = $('#popupurl').val();
            var type = $('#popuptype').val();


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{route('admin.banner.update')}}",
                method: 'POST',
                data: {
                    id: id,
                    url: name,
                    banner_type: type,

                },
                success: function (data) {

                    $('#url').val('');
                    $.ajax({
                        type: 'get',
                        url: '{{route('image-remove',[0,'popup_banner_image_modal'])}}',
                        dataType: 'json',
                        success: function (data) {
                            if (data.success === 1) {
                                $("#img-suc").hide();
                                $("#img-err").hide();
                                $("#crop").hide();
                                $("#show-images").html(data.photo);
                                $("#image-count").text(data.count);
                            } else if (data.success === 0) {
                                $("#img-suc").hide();
                                $("#img-err").show();
                            }
                        },
                    });
                    toastr.success('Popup Banner updated Successfully.');


                    location.reload();
                }
            });
            $('#save').hide();

        });

    </script>
    <!-- Page level plugins -->
    <script src="{{asset('public/assets/back-end')}}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('public/assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>
@endpush
