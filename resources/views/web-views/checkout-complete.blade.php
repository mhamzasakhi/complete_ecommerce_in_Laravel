@extends('layouts.front-end.app')

@section('title','Order Complete')

@push('css_or_js')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

        body {
            font-family: 'Montserrat', sans-serif
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
            color: {{$web_config['primary_color']}};
            font-weight: 700;

        }

        .spandHeadO {
            color: #030303;
            font-weight: 500;
            font-size: 20px;

        }

        .font-name {
            font-weight: 600;
            font-size: 13px;
        }

        .amount {
            font-size: 17px;
            color: {{$web_config['primary_color']}};
        }

        @media (max-width: 600px) {
            .orderId {
                margin-right: 91px;
            }

            .p-5 {
                padding: 2% !important;
            }

            .spanTr {

                font-weight: 400 !important;
                font-size: 12px;
            }

            .spandHeadO {

                font-weight: 300;
                font-size: 12px;

            }

            .table th, .table td {
                padding: 5px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10 col-lg-10">
                <div class="card">
                    @if(auth('customer')->check())
                        <div class=" p-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 style="font-size: 20px; font-weight: 900">{{trans('messages.your_order_confirm')}}
                                        !</h5>
                                </div>
                                <div class="col-md-6 ">
                                    <p class="float-right">{{trans('messages.Order')}} {{trans('messages.No')}} :
                                        <strong>{{$order_id}}</strong></p>
                                </div>
                            </div>

                            <span class="font-weight-bold d-block mt-4" style="font-size: 17px;">{{trans('messages.Hello')}}, {{auth('customer')->user()->f_name}}</span>
                            <span>You order has been confirmed and will be shipped according to the method you selected!</span>
                            @php($order=\App\Model\Order::with(['details'])->where('id',$order_id)->first())

                            <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                    <tr style="background: #E2F0FF">
                                        <td col="3">
                                            <div class="py-2">
                                                <span
                                                    class="d-block spandHeadO">{{trans('messages.shipping_address')}}</span>
                                                <span class="spanTr"></span>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="product border-bottom table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                    @php($sub_total=0)
                                    @php($total_tax=0)
                                    @php($total_shipping_cost=0)
                                    @php($total_discount_on_product=0)
                                    @foreach($order->details as $detail)
                                        <tr>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <td width="30%">
                                                        <img
                                                            src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$detail->product->thumbnail}}"
                                                            onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                            width="100">
                                                    </td>
                                                    <td width="60%">
                                                        <span
                                                            class="font-name">{{$detail->product['name']}}
                                                        </span>
                                                        <br>
                                                        <small>
                                                            QTY : {{$detail['qty']}}
                                                        </small>
                                                        <div class="product-qty">
                                                            @foreach(json_decode($detail['variation'],true) as $key1 =>$variation)
                                                                <div class="text-muted">
                                                                    <span
                                                                        class="d-block">{{$key1}} : {{$variation}} </span>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </div>
                                                <div class="col-md-6">
                                                    <td width="20%">
                                                        <div class="text-right"><span
                                                                class="font-weight-bold amount">{{\App\CPU\Helpers::currency_converter($detail['price'])}}</span>
                                                        </div>
                                                    </td>
                                                </div>
                                            </div>
                                        </tr>
                                        @php($sub_total+=$detail['price']*$detail['qty'])
                                        @php($total_tax+=$detail['tax'])
                                        @php($total_shipping_cost+=$detail->shipping->cost)
                                        @php($total_discount_on_product+=$detail['discount'])
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="row d-flex justify-content-end">
                                <div class="col-md-5">
                                    <table class="table table-borderless">
                                        <tbody class="totals">
                                        <tr>
                                            <td>
                                                <div class="text-left">
                                                    <span class="product-qty ">{{trans('messages.Items')}}</span>
                                                </div>
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

                            <p> {{trans('messages.shipping_confirmation_email')}}!</p>

                            <p class="font-weight-bold mb-2">{{trans('messages.thanks_for_shopping_with')}}!</p>
                            <br>

                            <div class="row">
                                {{-- <div class="col-6">
                                    <a href="{{route('home')}}" class="btn btn-primary">
                                       <span class="for-mobile-text">{{trans('messages.go_to_shopping')}}</span>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="{{route('track-order.last')}}" class="btn btn-secondary pull-right" type="button">
                                      <span class="for-mobile-text-track">{{trans('messages.Track')}} {{trans('messages.Order')}}</span>
                                    </a>
                                </div> --}}
                                <div class="col-6">
                                    <a href="{{route('home')}}" class="btn btn-primary">
                                        {{trans('messages.go_to_shopping')}}
                                    </a>
                                </div>

                                <div class="col-6">
                                    <a href="{{route('track-order.last')}}" class="btn btn-secondary pull-right">
                                        {{trans('messages.Track')}} {{trans('messages.Order')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <center>
                            <h5>Order Complete</h5>
                        </center>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

@endpush
