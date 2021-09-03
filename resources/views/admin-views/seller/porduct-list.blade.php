@extends('layouts.back-end.app')
@section('title','Product List')
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{asset('public/assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
            background-color: #377dff;
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

    </style>
@endpush

@section('content')
<div class="content container-fluid">  <!-- Page Heading -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('messages.Dashboard')}}</a></li>
            <li class="breadcrumb-item" aria-current="page">{{trans('messages.Products')}}</li>
        </ol>
    </nav>

    <div class="d-md-flex_ align-items-center justify-content-between mb-0">
        <div class="row">
            <div class="col-md-8">
                <h3 class="h3 mt-2 text-black-50">{{trans('messages.product_list')}}</h3>
            </div>

          
        </div>
    </div>

    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{trans('messages.product_table')}}</h5>
                </div>
                <div class="card-body" style="padding: 0">
                    <div class="table-responsive">
                        <table id="datatable"
                               class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                               style="width: 100%">
                            <thead class="thead-light">
                            <tr>
                                <th>{{trans('messages.SL#')}}</th>
                                <th>{{trans('messages.Product Name')}}</th>
                                <th>{{trans('messages.purchase_price')}}</th>
                                <th>{{trans('messages.selling_price')}}</th>
                                <th>{{trans('messages.featured')}}</th>
                                <th>{{trans('messages.status')}}</th>
                                <th style="width: 5px">{{trans('messages.Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($product as $k=>$p)
                                <tr>
                                    <th scope="row">{{$k+1}}</th>
                                    <td>
                                        <a href="{{route('admin.product.view',[$p['id']])}}">
                                            {{substr($p['name'],0,20)}}{{strlen($p['name'])>20?'...':''}}
                                        </a>
                                    </td>
                                    <td>
                                        {{ \App\CPU\BackEndHelper::usd_to_currency($p['purchase_price']).\App\CPU\BackEndHelper::currency_symbol()}}
                                    </td>
                                    <td>
                                        {{ \App\CPU\BackEndHelper::usd_to_currency($p['unit_price']).\App\CPU\BackEndHelper::currency_symbol()}}
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox"
                                                   onclick="featured_status('{{$p['id']}}')" {{$p->featured == 1?'checked':''}}>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" class="status"
                                                   id="{{$p['id']}}" {{$p->status == 1?'checked':''}}>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <!-- Dropdown -->
                                        <div class="dropdown">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="tio-settings"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item"
                                                   href="{{route('admin.product.edit',[$p['id']])}}">{{trans('messages.Edit')}}</a>
                                                <a class="dropdown-item" href="javascript:"
                                                onclick="form_alert('product-{{$p['id']}}','Want to delete this item ?')">{{trans('messages.Delete')}}</a>
                                                <form action="{{route('admin.product.delete',[$p['id']])}}"
                                                      method="post" id="product-{{$p['id']}}">
                                                    @csrf @method('delete')
                                                </form>
                                            </div>
                                        </div>
                                        <!-- End Dropdown -->
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{$product->links()}}
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
                url: "{{route('admin.product.status-update')}}",
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

        function featured_status(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.product.featured-status')}}",
                method: 'POST',
                data: {
                    id: id
                },
                success: function () {
                    toastr.success('Featured status updated successfully');
                }
            });
        }
    </script>
@endpush
