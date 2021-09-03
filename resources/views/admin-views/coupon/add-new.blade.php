@extends('layouts.back-end.app')
@section('title','Coupon Add')
@push('css_or_js')
    <link href="{{asset('public/assets/back-end')}}/css/select2.min.css" rel="stylesheet"/>
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
<div class="content container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('messages.Dashboard')}}</a></li>
            <li class="breadcrumb-item" aria-current="page">{{trans('messages.Coupon')}}</li>
        </ol>
    </nav>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{trans('messages.coupon_form')}}
                </div>
                <div class="card-body">
                    <form action="{{route('admin.coupon.add-new')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">{{trans('messages.Type')}}</label>
                                    <select class="js-example-responsive" name="coupon_type"
                                            style="width: 100%" required>
                                        {{--<option value="delivery_charge_free">Delivery Charge Free</option>--}}
                                        <option value="discount_on_purchase">Discount on Purchase</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="name">{{trans('messages.Title')}}</label>
                                    <input type="text" name="title" class="form-control" id="title"
                                           placeholder="Title" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">{{trans('messages.Code')}}</label>
                                    <input type="text" name="code" value="{{\Illuminate\Support\Str::random(10)}}"
                                           class="form-control" id="code"
                                           placeholder="" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="name">{{trans('messages.start_date')}}</label>
                                    <input type="date" name="start_date" class="form-control" id="start date"
                                           placeholder="start date" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">{{trans('messages.expire_date')}}</label>
                                    <input type="date" name="expire_date" class="form-control" id="expire date"
                                           placeholder="expire date" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="name">{{trans('messages.minimum_purchase')}}</label>
                                    <input type="number" min="1" max="1000000" name="min_purchase" class="form-control" id="minimum purchase"
                                           placeholder="minimum purchase" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">{{trans('messages.Discount')}}</label>
                                    <input type="number" min="1" max="1000000" name="discount" class="form-control" id="discount"
                                           placeholder="discount" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="name">{{trans('messages.discount_type')}}</label>
                                    <select class="js-example-responsive" name="discount_type"
                                            onchange="checkDiscountType(this.value)"
                                            style="width: 100%">
                                        <option value="amount">{{trans('messages.Amount')}}</option>
                                        <option value="percentage">{{trans('messages.percentage')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">{{trans('messages.maximum_discount')}}</label>
                                    <input type="number" min="1" max="1000000" name="max_discount" class="form-control" id="maximum discount"
                                           placeholder="maximum discount" required>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{trans('messages.Submit')}}</button>
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
                    <h5>{{trans('messages.coupons_table')}}</h5>
                </div>
                <div class="card-body" style="padding: 0">
                    <div class="table-responsive">
                        <table id="datatable"
                               class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                               style="width: 100%">
                            <thead class="thead-light">
                            <tr>
                                <th>{{trans('messages.SL#')}}</th>
                                <th>{{trans('messages.coupon_type')}}</th>
                                <th>{{trans('messages.Title')}}</th>
                                <th>{{trans('messages.Code')}}</th>
                                <th>{{trans('messages.minimum_purchase')}}</th>
                                <th>{{trans('messages.maximum_discount')}}</th>
                                <th>{{trans('messages.Discount')}}</th>
                                <th>{{trans('messages.discount_type')}}</th>
                                <th>{{trans('messages.start_date')}}</th>
                                <th>{{trans('messages.expire_date')}}</th>
                                <th>{{trans('messages.Status')}}</th>
                                <th>{{trans('messages.Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cou as $k=>$c)
                                <tr>
                                    <th scope="row">{{$k+1}}</th>
                                    <td style="text-transform: capitalize">{{str_replace('_',' ',$c['coupon_type'])}}</td>
                                    <td class="text-capitalize">
                                        {{substr($c['title'],0,20)}}
                                    </td>
                                    <td>{{$c['code']}}</td>
                                    <td>{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($c['min_purchase']))}}</td>
                                    <td>{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($c['max_discount']))}}</td>
                                    <td>{{$c['discount_type']=='amount'?\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($c['discount'])):$c['discount']}}</td>
                                    <td>{{$c['discount_type']}}</td>
                                    <td>{{date('d-M-y',strtotime($c['start_date']))}}</td>
                                    <td>{{date('d-M-y',strtotime($c['expire_date']))}}</td>
                                    {{-- <td>{{\App\CPU\Helpers::status($c['status'])}}

                                    </td> --}}
                                    <td><label class="switch"><input type="checkbox" class="status"
                                        id="{{$c->id}}" <?php if ($c->published == 1) echo "checked" ?>>
                                            <span class="slider round"></span></label>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.coupon.update',[$c['id']])}}"
                                           class="btn btn-primary btn-sm">
                                           {{trans('messages.Update')}}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{$cou->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
         $(document).ready(function() {
            $('#dataTable').DataTable();
        });
        function checkDiscountType(val) {
            if (val == 'amount') {
                $('#max-discount').hide()
            } else if (val == 'percentage') {
                $('#max-discount').show()
            }
        }
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
                url: "{{route('admin.coupon.status')}}",
                method: 'POST',
                data: {
                    id: id,
                    status: status
                },
                success: function (data) {
                    if (data == 1) {
                        toastr.success('Coupon published successfully');
                    } else {
                        toastr.success('Coupon unpublished successfully');
                    }
                }
            });
        });

    </script>
    <script src="{{asset('public/assets/back-end')}}/js/select2.min.js"></script>
    <script>
        $(".js-example-theme-single").select2({
            theme: "classic"
        });

        $(".js-example-responsive").select2({
            width: 'resolve'
        });
    </script>

    <!-- Page level plugins -->
    <script src="{{asset('public/assets/back-end')}}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('public/assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('public/assets/back-end')}}/js/demo/datatables-demo.js"></script>
@endpush
