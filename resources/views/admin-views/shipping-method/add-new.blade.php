@extends('layouts.back-end.app')

@push('css_or_js')
    <!-- Custom styles for this page -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Custom styles for this page -->
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 48px;
            height: 23px;
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
            height: 15px;
            width: 15px;
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

        #banner-image-modal .modal-content {
            width: 1116px !important;
            margin-left: -264px !important;
        }

        @media (max-width: 768px) {
            #banner-image-modal .modal-content {
                width: 698px !important;
                margin-left: -75px !important;
            }


        }

        @media (max-width: 375px) {
            #banner-image-modal .modal-content {
                width: 367px !important;
                margin-left: 0 !important;
            }

        }

        @media (max-width: 500px) {
            #banner-image-modal .modal-content {
                width: 400px !important;
                margin-left: 0 !important;
            }


        }


    </style>
@endpush

@section('content')
    <div class="content container-fluid"> <!-- Page Heading -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Shipping Method</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{trans('messages.shipping_method')}} {{trans('messages.form')}}
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.business-settings.shipping-method.add')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <label for="title">{{trans('messages.title')}}</label>
                                        <input type="text" name="title" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <label for="duration">{{trans('messages.duration')}}</label>
                                        <input type="text" name="duration" class="form-control"
                                               placeholder="Ex : 4-6 days">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <label for="cost">{{trans('messages.cost')}}</label>
                                        <input type="number" min="1" max="1000000" name="cost" class="form-control"
                                               placeholder="Ex : 10 ">
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit"
                                        class="btn btn-primary ">{{trans('messages.Submit')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 20px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{trans('messages.shipping_method')}} {{trans('messages.table')}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th scope="col">{{trans('messages.sl#')}}</th>
                                    <th scope="col">{{trans('messages.title')}}</th>
                                    <th scope="col">{{trans('messages.duration')}}</th>
                                    <th scope="col">{{trans('messages.cost')}}</th>
                                    <th scope="col">{{trans('messages.status')}}</th>
                                    <th scope="col" style="width: 50px">{{trans('messages.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($shipping_methods as $k=>$method)
                                    <tr>
                                        <th scope="row">{{$k+1}}</th>
                                        <td>{{$method['title']}}</td>
                                        <td>
                                            {{$method['duration']}}
                                        </td>
                                        <td>
                                            {{\App\CPU\BackEndHelper::usd_to_currency($method['cost'])}}
                                        </td>

                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" class="status"
                                                       id="{{$method['id']}}" {{$method->status == 1?'checked':''}}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>

                                        <td>
                                            <div class="dropdown float-right">
                                                <button class="btn btn-seconary btn-sm dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <i class="tio-settings"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item"
                                                       href="{{route('admin.business-settings.shipping-method.edit',[$method['id']])}}">{{trans('messages.Edit')}}</a>
                                                    <a class="dropdown-item delete" style="cursor: pointer;"
                                                       id="{{ $method['id'] }}">{{trans('messages.Delete')}}</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- Page level plugins -->
    <script src="{{asset('public/assets/back-end')}}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('public/assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->


    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function () {
            $('#dataTable').DataTable();
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
                url: "{{route('admin.business-settings.shipping-method.status-update')}}",
                method: 'POST',
                data: {
                    id: id,
                    status: status
                },
                success: function () {
                    toastr.success('Status updated successfully');
                }
            });
        });
        $(document).on('click', '.delete', function () {
            var id = $(this).attr("id");
            Swal.fire({
                title: 'Are you sure delete this ?',
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
                        url: "{{route('admin.business-settings.shipping-method.delete')}}",
                        method: 'POST',
                        data: {id: id},
                        success: function () {
                            toastr.success('Shipping Method deleted successfully');
                            location.reload();
                        }
                    });
                }
            })
        });
    </script>
@endpush
