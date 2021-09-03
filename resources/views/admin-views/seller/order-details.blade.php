@extends('layouts.back-end.app')

@section('title','Order Details')

@push('css_or_js')
    <style>
        @media (max-width: 500px) {
            .product-name {
                display: none;
            }
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header d-print-none" style="padding-bottom: 10px;margin-bottom: 10px">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-no-gutter">
                            <li class="breadcrumb-item"><a class="breadcrumb-link"
                                                           href="{{route('admin.orders.list',['status'=>'all'])}}">{{trans('messages.Orders')}}</a>
                            </li>
                            <li class="breadcrumb-item active"
                                aria-current="page">{{trans('messages.Order')}} {{trans('messages.details')}} </li>
                        </ol>
                    </nav>

                    <div class="d-sm-flex align-items-sm-center">
                        <h1 class="page-header-title">{{trans('messages.Order')}} #{{$order['id']}}</h1>

                        @if($order['payment_status']=='paid')
                            <span class="badge badge-soft-success ml-sm-3">
                                <span class="legend-indicator bg-success"></span>{{trans('messages.Paid')}}
                            </span>
                        @else
                            <span class="badge badge-soft-danger ml-sm-3">
                                <span class="legend-indicator bg-danger"></span>{{trans('messages.Unpaid')}}
                            </span>
                        @endif

                        @if($order['order_status']=='pending')
                            <span class="badge badge-soft-info ml-2 ml-sm-3 text-capitalize">
                              <span class="legend-indicator bg-info text"></span>{{str_replace('_',' ',$order['order_status'])}}
                            </span>
                        @elseif($order['order_status']=='failed')
                            <span class="badge badge-danger ml-2 ml-sm-3 text-capitalize">
                              <span class="legend-indicator bg-info"></span>{{str_replace('_',' ',$order['order_status'])}}
                            </span>
                        @elseif($order['order_status']=='processing')
                            <span class="badge badge-soft-warning ml-2 ml-sm-3 text-capitalize">
                              <span class="legend-indicator bg-warning"></span>{{str_replace('_',' ',$order['order_status'])}}
                            </span>

                        @elseif($order['order_status']=='delivered')
                            <span class="badge badge-soft-success ml-2 ml-sm-3 text-capitalize">
                              <span class="legend-indicator bg-success"></span>{{str_replace('_',' ',$order['order_status'])}}
                            </span>
                        @else
                            <span class="badge badge-soft-danger ml-2 ml-sm-3 text-capitalize">
                              <span class="legend-indicator bg-danger"></span>{{str_replace('_',' ',$order['order_status'])}}
                            </span>
                        @endif
                        <span class="ml-2 ml-sm-3">
                        <i class="tio-date-range"></i> {{date('d M Y H:i:s',strtotime($order['created_at']))}}
                </span>
                    </div>
                    <div class="col-md-12 mt-2 text-right">
                        <a class="text-body mr-3" target="_blank"
                           href={{route('admin.orders.generate-invoice',[$order['id']])}}>
                            <i class="tio-print mr-1"></i> {{trans('messages.Print')}} {{trans('messages.invoice')}}
                        </a>
                    </div>

                    <!-- Unfold -->
{{-- 
                    <div class="hs-unfold float-right">
                        <div class="dropdown">
                            <select name="order_status" class="status form-control" data-id="{{$order['id']}}">

                                <option
                                    value="pending" {{$order->order_status == 'pending'?'selected':''}} > {{trans('messages.Pending')}}</option>
                                <option
                                    value="processed" {{$order->order_status == 'processed'?'selected':''}} >{{trans('messages.Processing')}} </option>
                                <option
                                    value="delivered" {{$order->order_status == 'delivered'?'selected':''}} >{{trans('messages.Delivered')}} </option>
                                <option
                                    value="returned" {{$order->order_status == 'returned'?'selected':''}} > {{trans('messages.Returned')}}</option>
                                <option
                                    value="failed" {{$order->order_status == 'failed'?'selected':''}} >{{trans('messages.Failed')}} </option>
                            </select>
                        </div>
                    </div> --}}
                    {{-- <div class="hs-unfold float-right pr-2">
                        <div class="dropdown">
                            <select name="payment_status" class="payment_status form-control"
                                    data-id="{{$order['id']}}">

                                <option
                                    onclick="route_alert('{{route('admin.orders.payment-status',['id'=>$order['id'],'payment_status'=>'paid'])}}','Change status to paid ?')"
                                    href="javascript:" value="paid" {{$order->payment_status == 'paid'?'selected':''}} >
                                    {{trans('messages.Paid')}}
                                </option>
                                <option value="unpaid" {{$order->payment_status == 'unpaid'?'selected':''}} >
                                    {{trans('messages.Unpaid')}}
                                </option>

                            </select>
                        </div>
                    </div> --}}
                    <!-- End Unfold -->
                </div>
            </div>
        </div>

        <!-- End Page Header -->

        <div class="row mt-3" id="printableArea">
            <div class="col-lg-8 mb-3 mb-lg-0">
                <!-- Card -->
                <div class="card mb-3 mb-lg-5">
                    <!-- Header -->
                    <div class="card-header" style="display: block!important;">
                        <div class="row">
                            <div class="col-12 pb-2 border-bottom">
                                <h4 class="card-header-title">
                                    {{trans('messages.Order')}} {{trans('messages.details')}}
                                    <span
                                        class="badge badge-soft-dark rounded-circle ml-1">{{$order->details->count()}}</span>
                                </h4>
                            </div>
                            <div class="col-6 pt-2">

                            </div>
                            <div class="col-6 pt-2">
                                <div class="text-right">
                                    <h6 class="" style="color: #8a8a8a;">
                                        {{trans('messages.Payment')}} {{trans('messages.Method')}}
                                        : {{str_replace('_',' ',$order['payment_method'])}}
                                    </h6>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Header -->

                    <!-- Body -->
                    <div class="card-body">
                        <div class="media">
                            <div class="avatar avatar-xl mr-3">
                                <p>{{trans('messages.image')}}</p>
                            </div>

                            <div class="media-body">
                                <div class="row">
                                    <div class="col-md-3 product-name">
                                        <p> {{trans('messages.Name')}}</p>
                                    </div>

                                    <div class="col col-md-1 align-self-center p-0 ">
                                        <p> {{trans('messages.price')}}</p>
                                    </div>

                                    <div class="col col-md-1 align-self-center">
                                        <p>Q</p>
                                    </div>
                                    <div class="col col-md-1 align-self-center  p-0 product-name">
                                        <p> {{trans('messages.TAX')}}</p>
                                    </div>
                                    <div class="col col-md-2 align-self-center  p-0 product-name">
                                        <p> {{trans('messages.Discount')}}</p>
                                    </div>
                                    <div class="col col-md-2 align-self-center  p-0">
                                        <p> {{trans('messages.Status')}}</p>
                                    </div>

                                    <div class="col col-md-2 align-self-center text-right  ">
                                        <p> {{trans('messages.Subtotal')}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @php($subtotal=0)
                    @php($total=0)
                    @php($shipping=0)
                    @php($discount=0)
                    @php($tax=0)

                    @foreach($order->details as $detail)
                        @if($detail->product)

                            <!-- Media -->
                                <div class="media">
                                    <div class="avatar avatar-xl mr-3">
                                        <img class="img-fluid"
                                             onerror="this.src='{{asset('public/assets/back-end/img/160x160/img2.jpg')}}'"
                                             src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$detail->product['thumbnail']}}"
                                             alt="Image Description">
                                    </div>

                                    <div class="media-body">
                                        <div class="row">
                                            <div class="col-md-3 mb-3 mb-md-0 product-name">
                                                <p> 
                                                    @if($detail->seller_id!=0)
                                                    Seller
                                                    : {{$detail->seller->f_name.' '.$detail->seller->l_name.' ( ID : '.$detail['seller_id'].' )'}}
                                                @else
                                                    Seller : Admin
                                                @endif
                                                <br>
                                             
                                                    {{substr($detail->product['name'],0,10)}}{{strlen($detail->product['name'])>10?'...':''}}</p>
                                                <strong><u>{{trans('messages.Variation')}} : </u></strong>

                                                <div class="font-size-sm text-body">

                                                    <span class="font-weight-bold">{{$detail['variant']}}</span>
                                                </div>
                                            </div>

                                            <div class="col col-md-1 align-self-center p-0 ">
                                                <h6>{{\App\CPU\BackEndHelper::usd_to_currency($detail['price'])}}</h6>
                                            </div>

                                            <div class="col col-md-1 align-self-center">

                                                <h5>{{$detail->qty}}</h5>
                                            </div>
                                            <div class="col col-md-1 align-self-center  p-0 product-name">

                                                <h5>{{\App\CPU\BackEndHelper::usd_to_currency($detail['tax'])}}</h5>
                                            </div>
                                            <div class="col col-md-2 align-self-center  p-0 pl-2 product-name">

                                                <h5>
                                                    - {{\App\CPU\BackEndHelper::usd_to_currency($detail['discount'])}}</h5>
                                            </div>
                                            <div class="col col-md-2 align-self-center  p-0">
                                                <select name="delivery_status" class="product_status form-control small"
                                                        style="padding: 0px;" data-id="{{$detail['id']}}">
                                                    <option
                                                        value="pending" {{$detail->delivery_status == 'pending'?'selected':''}} >{{trans('messages.Pending')}} </option>
                                                    <option
                                                        value="processing" {{$detail->delivery_status == 'processing'?'selected':''}} > {{trans('messages.Processing')}}</option>
                                                    <option
                                                        value="delivered" {{$detail->delivery_status == 'delivered'?'selected':''}} >{{trans('messages.Delivered')}} </option>
                                                    <option
                                                        value="returned" {{$detail->delivery_status == 'returned'?'selected':''}} > {{trans('messages.Returned')}}</option>
                                                    <option
                                                        value="failed" {{$detail->delivery_status == 'failed'?'selected':''}} > {{trans('messages.Failed')}}</option>
                                                </select>
                                            </div>

                                            <div class="col col-md-2 align-self-center text-right  ">
                                                @php($subtotal=$detail['price']*$detail->qty+$detail['tax']-$detail['discount'])

                                                <h5 style="font-size: 12px">{{\App\CPU\BackEndHelper::usd_to_currency($subtotal).' '.\App\CPU\BackEndHelper::currency_symbol()}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @php($discount+=$detail['discount'])
                            @php($tax+=$detail['tax'])
                            @php($shipping+=$detail->shipping ? $detail->shipping->cost :0)

                            @php($total+=$subtotal)
                            <!-- End Media -->
                                <hr>
                            @endif
                        @endforeach

                        <div class="row justify-content-md-end mb-3">
                            <div class="col-md-9 col-lg-8">
                                <dl class="row text-sm-right">
                                    <dt class="col-sm-6">{{trans('messages.Shipping')}}</dt>
                                    <dd class="col-sm-6 border-bottom">
                                        <strong>{{\App\CPU\BackEndHelper::usd_to_currency($shipping).' '.\App\CPU\BackEndHelper::currency_symbol()}}</strong>
                                    </dd>

                                    <dt class="col-sm-6">{{trans('messages.Total')}}</dt>
                                    <dd class="col-sm-6">
                                        <strong>{{\App\CPU\BackEndHelper::usd_to_currency($total+$shipping).' '.\App\CPU\BackEndHelper::currency_symbol()}}</strong>
                                    </dd>
                                </dl>
                                <!-- End Row -->
                            </div>
                        </div>
                        <!-- End Row -->
                    </div>
                    <!-- End Body -->
                </div>
                <!-- End Card -->
            </div>

            <div class="col-lg-4">
                <!-- Card -->
                <div class="card">
                    <!-- Header -->
                    <div class="card-header">
                        <h4 class="card-header-title">{{trans('messages.Customer')}}</h4>
                    </div>
                    <!-- End Header -->

                    <!-- Body -->
                    @if($order->customer)
                        <div class="card-body">
                            <div class="media align-items-center" href="javascript:">
                                <div class="avatar avatar-circle mr-3">
                                    <img
                                        class="avatar-img" style="width: 75px;height: 42px"
                                        onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                        src="{{asset('storage/app/public/profile/'.$order->customer->image)}}"
                                        alt="Image">
                                </div>
                                <div class="media-body">
                                <span
                                    class="text-body text-hover-primary">{{$order->customer['f_name'].' '.$order->customer['l_name']}}</span>
                                </div>
                                <div class="media-body text-right">
                                    {{--<i class="tio-chevron-right text-body"></i>--}}
                                </div>
                            </div>

                            <hr>

                            <div class="media align-items-center" href="javascript:">
                                <div class="icon icon-soft-info icon-circle mr-3">
                                    <i class="tio-shopping-basket-outlined"></i>
                                </div>
                                <div class="media-body">
                                    <span class="text-body text-hover-primary"> {{\App\Model\Order::where('customer_id',$order['customer_id'])->count()}} orders</span>
                                </div>
                                <div class="media-body text-right">
                                    {{--<i class="tio-chevron-right text-body"></i>--}}
                                </div>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between align-items-center">
                                <h5>{{trans('messages.Contact')}} {{trans('messages.info')}} </h5>
                            </div>

                            <ul class="list-unstyled list-unstyled-py-2">
                                <li>
                                    <i class="tio-online mr-2"></i>
                                    {{$order->customer['email']}}
                                </li>
                                <li>
                                    <i class="tio-android-phone-vs mr-2"></i>
                                    {{$order->customer['phone']}}
                                </li>
                            </ul>

                            <hr>


                            <div class="d-flex justify-content-between align-items-center">
                                <h5>{{trans('messages.shipping_address')}}</h5>

                            </div>

                            <span class="d-block">
                                    {{trans('messages.Name')}} :
                                <strong>{{$order->shipping ? $order->shipping['contact_person_name'] : "empty"}}</strong><br>
                                {{trans('messages.City')}}:
                                <strong>{{$order->shipping ? $order->shipping['city'] : "Empty"}}</strong><br>
                                {{trans('messages.zip_code')}} :
                                <strong>{{$order->shipping ? $order->shipping['zip']  : "Empty"}}</strong><br>
                                {{trans('messages.Phone')}}:
                                <strong>{{$order->shipping ? $order->shipping['phone']  : "Empty"}}</strong>

                                </span>

                        </div>
                @endif
                <!-- End Body -->
                </div>
                <!-- End Card -->
            </div>
        </div>
        <!-- End Row -->
    </div>
@endsection

@push('script')
<script>
    // $(document).on('change', '.status', function () {
    //     var id = $(this).attr("data-id");
    //     var value = $(this).val();


    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    //         }
    //     });
    //     $.ajax({
    //         url: "{{route('admin.orders.status')}}",
    //         method: 'POST',
    //         data: {

    //             "id": id,
    //             "order_status": value
    //         },
    //         success: function (data) {

    //             toastr.success('Status updated successfully');
    //             location.reload();
    //         }
    //     });
    // });
    $(document).on('change', '.product_status', function () {
        var id = $(this).attr("data-id");
        var value = $(this).val();


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('seller.orders.productStatus')}}",
            method: 'POST',
            data: {

                "id": id,
                "delivery_status": value
            },
            success: function (data) {
                if (data.success == 0) {
                    toastr.warning(data.message);
                } else {
                    toastr.success('Product Status updated successfully');
                    location.reload();
                }
            }
        });
    });
</script>
@endpush
