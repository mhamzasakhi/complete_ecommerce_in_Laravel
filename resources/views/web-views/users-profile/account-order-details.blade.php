@extends('layouts.front-end.app')

@section('title','Order Details')

@push('css_or_js')

@endpush

@section('content')
    <style>

        .page-item.active .page-link {
            background-color: {{$web_config['primary_color']}}     !important;
        }

        .page-item.active > .page-link {
            box-shadow: 0 0 black !important;
        }

        .widget-categories .accordion-heading > a:hover {
            color: #FFD5A4 !important;
        }

        .widget-categories .accordion-heading > a {
            color: #FFD5A4;
        }

        body {
            font-family: 'Titillium Web', sans-serif
        }

        .card {
            border: none
        }


        .totals tr td {
            font-size: 13px
        }

        .footer span {
            font-size: 12px
        }

        .product-qty span {
            font-size: 14px;
            color: #6A6A6A;
        }

        .spanTr {
            color: #FFFFFF;
            font-weight: 900;
            font-size: 13px;

        }

        .spandHeadO {
            color: #FFFFFF !important;
            font-weight: 400;
            font-size: 13px;

        }

        .font-name {
            font-weight: 600;
            font-size: 12px;
            color: #030303;
        }

        .amount {
            font-size: 15px;
            color: #030303;
            font-weight: 600;
            margin-left: 60px;

        }

        a {
            color: {{$web_config['primary_color']}};
            cursor: pointer;
            text-decoration: none;
            background-color: transparent;
        }

        a:hover {
            cursor: pointer;
        }

        @media (max-width: 600px) {
            .sidebar_heading {
                background: #1B7FED;
            }

            .sidebar_heading h1 {
                text-align: center;
                color: aliceblue;
                padding-bottom: 17px;
                font-size: 19px;
            }
        }

        @media (max-width: 768px) {
            .for-tab-img {
                width: 100% !important;
            }

            .for-glaxy-name {
                display: none;
            }
        }

        @media (max-width: 360px) {
            .for-mobile-glaxy {
                display: flex !important;
            }

            .for-glaxy-mobile {
                margin-right: 6px;
            }

            .for-glaxy-name {
                display: none;
            }
        }

        @media (max-width: 600px) {
            .for-mobile-glaxy {
                display: flex !important;
            }

            .for-glaxy-mobile {
                margin-right: 6px;
            }

            .for-glaxy-name {
                display: none;
            }

            .order_table_tr {
                display: grid;
            }

            .order_table_td {
                border-bottom: 1px solid #fff !important;
            }

            .order_table_info_div {
                width: 100%;
                display: flex;
            }

            .order_table_info_div_1 {
                width: 50%;
            }

            .order_table_info_div_2 {
                width: 49%;
                text-align: right !important;
            }

            .spandHeadO {
                font-size: 16px;
                margin-left: 16px;
            }

            .spanTr {
                font-size: 16px;
                margin-right: 16px;
                margin-top: 10px;
            }

            .amount {
                font-size: 13px;
                margin-left: 0px;

            }

        }
    </style>

    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-4 mt-3">
        <div class="row">
            <!-- Sidebar-->
            @include('web-views.partials._profile-aside')

            {{-- Content --}}
            <section class="col-lg-9 col-md-9">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <a class="page-link" href="{{ route('account-oder') }}">
                            <i class="czi-arrow-left mr-2"></i>Back
                        </a>
                    </div>
                </div>


                <div class="card box-shadow-sm">
                    <div class="payment border-top mt-3 mb-3  table-responsive">
                        @if (isset($order['seller_id']) != 0)
                            @php($shopName=\App\Model\Shop::where('seller_id', $order['seller_id'])->first())
                        @endif
                        <table class="table table-borderless">
                            <thead>
                            <tr class="order_table_tr" style="background: {{$web_config['primary_color']}}">
                                <td class="order_table_td">
                                    <div class="order_table_info_div">
                                        <div class="order_table_info_div_1 py-2">
                                            <span class="d-block spandHeadO">{{trans('messages.order_no')}}: </span>
                                        </div>
                                        <div class="order_table_info_div_2">
                                            <span class="spanTr"> {{$order->id}} </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="order_table_td">
                                    <div class="order_table_info_div">
                                        <div class="order_table_info_div_1 py-2">
                                            <span class="d-block spandHeadO">{{trans('messages.order_date')}}: </span>
                                        </div>
                                        <div class="order_table_info_div_2">
                                            <span
                                                class="spanTr"> {{date('d M, Y',strtotime($order->created_at))}} </span>
                                        </div>

                                    </div>
                                </td>
                                <td class="order_table_td">
                                    <div class="order_table_info_div">
                                        <div class="order_table_info_div_1 py-2">
                                            <span
                                                class="d-block spandHeadO">{{trans('messages.shipping_address')}}: </span>
                                        </div>
                                        <div class="order_table_info_div_2">
                                            <span class="spanTr"> {{$order->address}} </span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </thead>
                        </table>

                        <table class="table table-borderless">
                            <tbody>
                            @php($sub_total=0)
                            @php($total_tax=0)
                            @php($total_shipping_cost=0)
                            @php($total_discount_on_product=0)

                            @foreach ($order_details as $key=>$detail)
                                @php($product=json_decode($detail->product_details,true))
                                <tr>
                                    <div class="row">
                                        <div class="col-md-6"
                                             onclick="location.href='{{route('product',$product['slug'])}}'">
                                            <td width="30%" class="for-tab-img">
                                                <img class="d-block"
                                                     onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                     src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$product['thumbnail']}}"
                                                     alt="VR Collection" width="60">
                                            </td>
                                            <td width="60%" class="for-glaxy-name" style="vertical-align:middle">
                                                <a href="{{route('product',[$product['slug']])}}">
                                                    {{isset($product['name']) ? $product['name'] : ''}}
                                                </a><br>
                                                <span>{{__('messages.Variant')}} : </span>
                                                {{$detail->variant}}
                                            </td>
                                        </div>
                                        <td width="20%" style="vertical-align:middle">
                                            <span class="font-weight-bold amount text-capitalize">
                                                {{$detail->delivery_status}}
                                            </span> {{--if order table changed then change the status--}}
                                        </td>
                                        <div class="col-md-6">
                                            <td width="20%">
                                                <div class="text-right">
                                                    <span
                                                        class="font-weight-bold amount">{{\App\CPU\Helpers::currency_converter($detail->price)}} </span>
                                                    <br>
                                                    <span>qty: {{$detail->qty}}</span>

                                                </div>
                                            </td>
                                        </div>
                                    </div>
                                    <td>
                                        @if($order->order_status=='delivered')
                                            <a href="javascript:" class="btn btn-primary btn-sm" data-toggle="modal"
                                               data-target="#review-{{$detail->id}}">Review</a>
                                        @else
                                            <label class="badge badge-secondary">
                                                <a href="javascript:" class="btn btn-primary btn-sm disabled">Review</a>
                                            </label>
                                        @endif
                                    </td>
                                </tr>
                                @php($sub_total+=$detail->price*$detail->qty)
                                @php($total_tax+=$detail->tax)
                                @php($total_shipping_cost+=$detail->cost)
                                @php($total_discount_on_product+=$detail->discount)
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{--                Calculation--}}
                <div class="row d-flex justify-content-end">
                    <div class="col-md-8 col-lg-5">
                        <table class="table table-borderless">
                            <tbody class="totals">
                            <tr>
                                <td>
                                    <div class="text-left"><span
                                            class="product-qty ">{{trans('messages.Item')}}</span></div>
                                </td>
                                <td>
                                    <div class="text-right"><span>{{$order->details->count()}}</span>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="text-left"><span
                                            class="product-qty ">{{trans('messages.Subtotal')}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-right">
                                        <span>{{\App\CPU\Helpers::currency_converter($sub_total)}}</span>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="text-left"><span
                                            class="product-qty ">{{trans('messages.text_fee')}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-right">
                                        <span>{{\App\CPU\Helpers::currency_converter($total_tax)}}</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="text-left"><span
                                            class="product-qty ">{{trans('messages.Shipping')}} {{trans('messages.Fee')}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-right">
                                        <span>{{\App\CPU\Helpers::currency_converter($total_shipping_cost)}}</span>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="text-left"><span
                                            class="product-qty ">{{trans('messages.Discount')}} {{trans('messages.on_product')}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-right">
                                        <span>- {{\App\CPU\Helpers::currency_converter($total_discount_on_product)}}</span>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="text-left"><span
                                            class="product-qty ">{{trans('messages.Coupon')}} {{trans('messages.Discount')}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-right">
                                        <span>- {{\App\CPU\Helpers::currency_converter($order->discount_amount)}}</span>
                                    </div>
                                </td>
                            </tr>

                            <tr class="border-top border-bottom">
                                <td>
                                    <div class="text-left"><span
                                            class="font-weight-bold">{{trans('messages.Total')}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-right"><span
                                            class="font-weight-bold amount ">{{\App\CPU\Helpers::currency_converter($order->order_amount)}}</span>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="justify-content mt-4 for-mobile-glaxy ">
                    <a href="{{route('generate-invoice',[$order->id])}}" class="btn btn-primary for-glaxy-mobile"
                       style="width:49%;">
                        {{trans('messages.generate_invoice')}}
                    </a>
                    <a id="track_order" class="btn btn-secondary" type="button"
                       style="width:50%; color: white">
                        {{trans('messages.Track')}} {{trans('messages.Order')}}
                    </a>

                </div>
            </section>
        </div>
    </div>

    <!-- Modal -->
    @foreach ($order_details as $key=>$detail)
        @if($detail->delivery_status=='delivered')
            @php($product=json_decode($detail->product_details,true))
            <div class="modal fade" id="review-{{$detail->id}}" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">
                                {{$product['name']}}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('review.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Rating</label>
                                    <select class="form-control" name="rating">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Comment</label>
                                    <input name="product_id" value="{{$detail->product_id}}" hidden>
                                    <textarea class="form-control" name="comment"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Attachment</label>
                                    <div class="row coba"></div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit Review</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

@endsection


@push('script')
    <script>
        $(document).ready(function () {
            $('#track_order').on('click', function () {
                let order_id, phone_number;
                order_id = {{$order->id}};
                phone_number = {{$order->customer_phone}};

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{route('track-order.result')}}",
                    method: 'POST',
                    data: {
                        order_id: order_id,
                        phone_number: phone_number,
                    },
                    success: function () {
                        var url = "{{route('track-order.result-view')}}" + '?order_id=' + '{{$order->id}}' +
                            '&phone_number=' + '{{$order->customer_phone}}';
                        window.location.href = url;
                    }
                });
            })
        })
    </script>

    <script src="{{asset('public/assets/front-end/js/spartan-multi-image-picker.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $(".coba").spartanMultiImagePicker({
                fieldName: 'fileUpload[]',
                maxCount: 5,
                rowHeight: '150px',
                groupClassName: 'col-md-4',
                maxFileSize: '',
                placeholderImage: {
                    image: '{{asset('public/assets/front-end/img/image-place-holder.png')}}',
                    width: '100%'
                },
                dropFileLabel: "Drop Here",
                onAddRow: function (index, file) {

                },
                onRenderedPreview: function (index) {

                },
                onRemoveRow: function (index) {

                },
                onExtensionErr: function (index, file) {
                    toastr.error('Please only input png or jpg type file', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onSizeErr: function (index, file) {
                    toastr.error('File size too big', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });
        });
    </script>
@endpush

