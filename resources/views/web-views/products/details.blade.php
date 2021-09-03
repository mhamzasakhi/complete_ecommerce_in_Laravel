@extends('layouts.front-end.app')

@section('title',$product['name'])

@push('css_or_js')
    <meta name="description" content="{{$product->slug}}">
    <meta name="keywords" content="@foreach(explode(' ',$product['name']) as $keyword) {{$keyword.' , '}} @endforeach">
    @if($product->added_by=='seller')
        <meta name="author" content="{{ $product->seller->shop?$product->seller->shop->name:$product->seller->f_name}}">
    @elseif($product->added_by=='admin')
        <meta name="author" content="{{$web_config['name']->value}}">
    @endif
    <!-- Viewport-->

    @if($product['meta_image']!=null)
        <meta property="og:image" content="{{asset("storage/app/public/product/meta")}}/{{$product->meta_image}}"/>
        <meta property="twitter:card"
              content="{{asset("storage/app/public/product/meta")}}/{{$product->meta_image}}"/>
    @else
        <meta property="og:image" content="{{asset("storage/app/public/product/thumbnail")}}/{{$product->thumbnail}}"/>
        <meta property="twitter:card"
              content="{{asset("storage/app/public/product/thumbnail/")}}/{{$product->thumbnail}}"/>
    @endif

    @if($product['meta_title']!=null)
        <meta property="og:title" content="{{$product->meta_title}}"/>
        <meta property="twitter:title" content="{{$product->meta_title}}"/>
    @else
        <meta property="og:title" content="{{$product->name}}"/>
        <meta property="twitter:title" content="{{$product->name}}"/>
    @endif
    <meta property="og:url" content="{{route('product',[$product->slug])}}">

    @if($product['meta_description']!=null)
        <meta property="twitter:description" content="{!! $product['meta_description'] !!}">
        <meta property="og:description" content="{!! $product['meta_description'] !!}">
    @else
        <meta property="og:description"
              content="@foreach(explode(' ',$product['name']) as $keyword) {{$keyword.' , '}} @endforeach">
        <meta property="twitter:description"
              content="@foreach(explode(' ',$product['name']) as $keyword) {{$keyword.' , '}} @endforeach">
    @endif
    <meta property="twitter:url" content="{{route('product',[$product->slug])}}">

    <link rel="stylesheet" href="{{asset('public/assets/front-end/css/product-details.css')}}"/>
    <style>
        .msg-option {
            display: none;
        }

        .chatInputBox {
            width: 100%;
        }

        .go-to-chatbox {
            width: 100%;
            text-align: center;
            padding: 5px 0px;
            display: none;
        }

        .feature_header {
            display: flex;
            justify-content: center;
        }

        .btn-number:hover {
            color: {{$web_config['secondary_color']}};

        }

        .for-total-price {
            margin-left: -30%;
        }

        .for-hover-bg:hover {
            border: 2px solid{{$web_config['primary_color']}};
        }

        .for-hover-bg {
            font-size: 18px;
            height: 45px;
            color: {{$web_config['primary_color']}};
            border: 2px solid{{$web_config['secondary_color']}};
        }

        .feature_header span {
            padding-right: 15px;
            padding-left: 15px;
            font-weight: 700;
            font-size: 25px;
            background-color: #ffffff;
            text-transform: uppercase;
        }

        @media (max-width: 768px) {
            .feature_header span {
                margin-bottom: -40px;
            }

            .for-total-price {
                padding-left: 30%;
            }

            .product-quantity {
                padding-left: 4%;
            }

            .for-margin-bnt-mobile {
                margin-right: 7px;
            }

            .font-for-tab {
                font-size: 11px !important;


            }

            .pro {
                font-size: 13px;
            }
        }

        @media (max-width: 375px) {
            .for-margin-bnt-mobile {
                margin-right: 3px;
            }

            .for-discount {
                margin-left: 10% !important;
            }

            .for-dicount-div {
                margin-top: -5%;
                margin-right: -7%;
            }

            .product-quantity {
                margin-left: 4%;
            }

        }

        @media (max-width: 500px) {
            .for-dicount-div {
                margin-top: -4%;
                margin-right: -5%;
            }

            .for-total-price {
                margin-left: -20%;
            }

            .view-btn-div {

                margin-top: -9%;
                float: right;
            }

            .for-discount {
                margin-left: 7%;
            }

            .viw-btn-a {
                font-size: 10px;
                font-weight: 600;
            }

            .feature_header span {
                margin-bottom: -7px;
            }

            .for-mobile-capacity {
                margin-left: 7%;
            }
        }
    </style>
    <style>
        th, td {
            border-bottom: 1px solid #ddd;
            padding: 5px;
        }

        thead {
            background: {{$web_config['primary_color']}}                 !important;
            color: white;
        }
    </style>
@endpush

@section('content')
    <?php
    $overallRating = \App\CPU\ProductManager::get_overall_rating($product->reviews);
    $rating = \App\CPU\ProductManager::get_rating($product->reviews);
    ?>
    <!-- Page Content-->
    <div class="container mt-4">
        <!-- General info tab-->
        <div class="row ">
            <!-- Product gallery-->
            <div class="col-lg-6 col-md-6">
                <div class="cz-product-gallery">
                    <div class="cz-preview">
                        @if($product->images!=null)
                            @foreach (json_decode($product->images) as $key => $photo)
                                <div
                                    class="cz-preview-item d-flex align-items-center justify-content-center  {{$key==0?'active':''}}"
                                    id="image{{$key}}">
                                    <img class="cz-image-zoom img-responsive"
                                         src="{{asset("storage/app/public/product/$photo")}}"
                                         data-zoom="{{asset("storage/app/public/product/$photo")}}"
                                         alt="Product image" width="">
                                    <div class="cz-image-zoom-pane"></div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="cz">
                        <div class="container">
                            <div class="row">
                                <div class="table-responsive" data-simplebar style="max-height: 515px; padding: 1px;">
                                    <div class="d-flex">
                                        @if($product->images!=null)
                                            @foreach (json_decode($product->images) as $key => $photo)
                                                <div class="cz-thumblist">
                                                    <a class="cz-thumblist-item  {{$key==0?'active':''}} d-flex align-items-center justify-content-center "
                                                       href="#image{{$key}}">
                                                        <img src="{{asset("storage/app/public/product/$photo")}}"
                                                             alt="Product thumb">
                                                    </a>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product details-->
            <div class="col-lg-6 col-md-6 mt-md-0 mt-sm-3">
                <div class="details">
                    <h1 class="h3 mb-2">{{$product->name}}</h1>
                    <div class="d-flex align-items-center mb-2 pro">
                        <span
                            class="d-inline-block font-size-sm text-body align-middle mt-1 mr-md-2 mr-sm-0 pr-2">{{$overallRating[0]}}</span>
                        <div class="star-rating">
                            @for($inc=0;$inc<5;$inc++)
                                @if($inc<$overallRating[0])
                                    <i class="sr-star czi-star-filled active"></i>
                                @else
                                    <i class="sr-star czi-star"></i>
                                @endif
                            @endfor
                        </div>
                        <span
                            class="font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 ml-1 mr-md-2 mr-1 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1">{{$overallRating[1]}} {{trans('messages.Reviews')}}</span>
                        <span style="width: 0px;height: 10px;border: 0.5px solid #707070; margin-top: 6px"></span>
                        <span
                            class="d-inline-block font-size-sm text-body align-middle mt-1 ml-1 mr-md-2 mr-1 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1 font-for-tab">{{$countOrder}} {{trans('messages.orders')}}   </span>
                        <span style="width: 0px;height: 10px;border: 0.5px solid #707070; margin-top: 6px">    </span>
                        <span
                            class=" font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 ml-1 mr-md-2 mr-0 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1">  {{$countWishlist}} {{trans('messages.wish')}} </span>

                    </div>
                    <div class="mb-3">
                        <span class="h3 font-weight-normal text-accent mr-1">
                            {{\App\CPU\Helpers::get_price_range($product) }}
                        </span>
                        @if($product->discount > 0)
                            <strike style="color: {{$web_config['secondary_color']}};">
                                {{\App\CPU\Helpers::currency_converter($product->unit_price)}}
                            </strike>
                        @endif
                    </div>

                    @if($product->discount > 0)
                        <div class="mb-3">
                            <strong>Discount : </strong>
                            <strong id="set-discount-amount"></strong>
                        </div>
                    @endif

                    <div class="mb-3">
                        <strong>TAX : </strong>
                        <strong id="set-tax-amount"></strong>
                    </div>
                    <form id="add-to-cart-form" class="mb-2">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <div class="position-relative mr-n4 mb-3">
                            @if (count(json_decode($product->colors)) > 0)
                                <div class="row no-gutters">
                                    <div class="col-2">
                                        <div class="product-description-label mt-2">{{__('Color')}}:
                                        </div>
                                    </div>
                                    <div class="col-10">
                                        <ul class="list-inline checkbox-color mb-1">
                                            @foreach (json_decode($product->colors) as $key => $color)
                                                <li>
                                                    <input type="radio"
                                                           id="{{ $product->id }}-color-{{ $key }}"
                                                           name="color" value="{{ $color }}"
                                                           @if($key == 0) checked @endif>
                                                    <label style="background: {{ $color }};"
                                                           for="{{ $product->id }}-color-{{ $key }}"
                                                           data-toggle="tooltip"></label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            @php
                                $qty = 0;
                                if(!empty($product->variation)){
                                foreach (json_decode($product->variation) as $key => $variation) {
                                        $qty += $variation->qty;
                                    }
                                }
                            @endphp
                        </div>
                        @foreach (json_decode($product->choice_options) as $key => $choice)
                            <div class="row no-gutters">
                                <div class="col-3">
                                    <div class="product-description-label mt-2">{{ $choice->title }}:
                                    </div>
                                </div>
                                <div class="col-9">
                                    <ul class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-2">
                                        @foreach ($choice->options as $key => $option)
                                            <li class="for-mobile-capacity">
                                                <input type="radio"
                                                       id="{{ $choice->name }}-{{ $option }}"
                                                       name="{{ $choice->name }}" value="{{ $option }}"
                                                       @if($key == 0) checked @endif>
                                                <label for="{{ $choice->name }}-{{ $option }}">{{ $option }}</label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach

                    <!-- Quantity + Add to cart -->
                        <div class="row no-gutters">
                            <div class="col-2">
                                <div class="product-description-label mt-2">{{__('Quantity')}}:</div>
                            </div>
                            <div class="col-10">
                                <div class="product-quantity d-flex align-items-center">
                                    <div class="input-group input-group--style-2 pr-3"
                                         style="width: 160px;">
                                        <span class="input-group-btn">
                                            <button class="btn btn-number" type="button"
                                                    data-type="minus" data-field="quantity"
                                                    disabled="disabled" style="padding: 10px">
                                                -
                                            </button>
                                        </span>
                                        <input type="text" name="quantity"
                                               class="form-control input-number text-center cart-qty-field"
                                               placeholder="1" value="1" min="1" max="100">
                                        <span class="input-group-btn">
                                            <button class="btn btn-number" type="button" data-type="plus"
                                                    data-field="quantity" style="padding: 10px">
                                               +
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row no-gutters d-none mt-2" id="chosen_price_div">
                            <div class="col-5">
                                <div class="product-description-label">{{__('Total Price')}}:</div>
                            </div>
                            <div class="col-7">
                                <div class="product-price for-total-price">
                                    <strong id="chosen_price"></strong>
                                </div>
                            </div>

                            <div class="col-12">
                                @if($product['current_stock']<=0)
                                    <h5 class="mt-3" style="color: red">Out of Stock</h5>
                                @endif
                            </div>
                        </div>

                        {{--to do--}}
                        <div class="row" style="display: none">
                            <div class="col-md-12">
                                <div id="accordion">
                                    <div class="card mt-2 mb-2">
                                        <div class="card-header" id="headingTwo">
                                            <h5 class="mb-0">
                                                <a href="javascript:" style="font-size: 15px" class="collapsed"
                                                   data-toggle="collapse" data-target="#collapseTwo"
                                                   aria-expanded="false"
                                                   aria-controls="collapseTwo">
                                                    {{trans('messages.Select')}} {{trans('messages.shipping_method')}}
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
                                             data-parent="#accordion">
                                            <div class="card-body">
                                                <ul class="list-group">
                                                    @foreach(\App\CPU\ProductManager::get_shipping_methods($product) as $key=>$shipping)
                                                        <li class="list-group-item" style="cursor: pointer;"
                                                            onclick="$('#sh-{{$shipping['id']}}').prop( 'checked', true )">
                                                            <input type="radio" name="shipping_method_id"
                                                                   id="sh-{{$shipping['id']}}"
                                                                   value="{{$shipping['id']}}" {{$key==0?'checked':''}}>
                                                            <span class="checkmark" style="margin-right: 10px"></span>
                                                            {{$shipping['title']}} ( Duration
                                                            : {{$shipping['duration']}},
                                                            Cost
                                                            : {{\App\CPU\Helpers::currency_converter($shipping['cost'])}}
                                                            )
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-2">

                            <button class="btn btn-secondary for-margin-bnt-mobile" onclick="buy_now()"
                                    type="button"
                                    style="width:37%; height: 45px">
                                {{trans('messages.buy_now')}}
                            </button>
                            <button class="btn btn-primary for-margin-bnt-mobile"
                                    onclick="addToCart()"
                                    type="button"
                                    style="width:37%; height: 45px">
                                {{trans('messages.Add')}} {{trans('messages.To')}} {{trans('messages.Cart')}}
                            </button>


                            <button type="button" onclick="addWishlist('{{$product['id']}}')" class="btn for-hover-bg"
                                    style="">
                                <i class="fa fa-heart-o mr-2" aria-hidden="true"></i>
                                <span class="countWishlist-{{$product['id']}}">{{$countWishlist}}</span>
                            </button>
                        </div>
                    </form>
                    <hr style="padding-bottom: 10px">
                    <div style="text-align:left;" class="sharethis-inline-share-buttons"></div>
                </div>
            </div>
        </div>
    </div>

    {{--seller section--}}
    @if($product->added_by=='seller')
        <div class="container mt-4">
            <div class="row seller_details d-flex align-items-center" id="sellerOption">
                <div class="col-md-6">
                    <div class="seller_shop">
                        <div class="shop_image d-flex justify-content-center align-items-center">
                            <a href="#" class="d-flex justify-content-center">
                                <img style="height: 65px; width: 65px; border-radius: 50%"
                                     src="{{asset('storage/app/public/shop')}}/{{$product->seller->shop->image}}"
                                     onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                     alt="">
                            </a>
                        </div>
                        <div class="shop_name d-flex justify-content-center align-items-center">
                            <div>
                                <a href="#" class="d-flex align-items-center">
                                    <div
                                        class="title">{{$product->seller->shop->name}}</div>
                                </a>
                                <div class="review d-flex align-items-center">
                                    <div class="">
                                                        <span
                                                            class="d-inline-block font-size-sm text-body align-middle mt-1 mr-2">{{trans('messages.Seller')}} {{trans('messages.Info')}} </span>
                                        <span
                                            class="d-inline-block font-size-sm text-body align-middle mt-1 ml-2"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-md-0 pt-sm-3">
                    <div class="seller_contact">

                        <div class="d-flex align-items-center pr-4">
                            <a href="{{ route('shopView',[$product->seller->id]) }}">
                                <button class="btn btn-secondary">
                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                    {{trans('messages.Visit')}}
                                </button>
                            </a>
                        </div>

                        @if (auth('customer')->id() == '')
                            <div class="d-flex align-items-center">
                                <a href="{{route('customer.auth.login')}}">
                                    <button class="btn btn-primary">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                        {{trans('messages.Contact')}} {{trans('messages.Seller')}}
                                    </button>
                                </a>
                            </div>
                        @else
                            <div class="d-flex align-items-center" id="contact-seller">
                                <button class="btn btn-primary">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    {{trans('messages.Contact')}} {{trans('messages.Seller')}}
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row msg-option" id="msg-option">
                <form action="">
                    <input type="text" class="seller_id" hidden seller-id="{{$product->seller->id }}">
                    <textarea shop-id="{{$product->seller->shop->id}}" class="chatInputBox"
                              id="chatInputBox" rows="5"> </textarea>

                    <button class="btn btn-secondary" style="color: white;" id="cancelBtn">Cancel
                    </button>
                    <button class="btn btn-primary" style="color: white;" id="sendBtn">Send</button>
                </form>
            </div>
            <div class="go-to-chatbox" id="go_to_chatbox">
                <a href="{{route('chat-with-seller')}}" class="btn btn-primary" id="go_to_chatbox_btn">
                    {{trans('messages.go_to')}} {{trans('messages.chatbox')}} </a>
            </div>
        </div>
    @else
        <div class="container">
            <div class="row seller_details d-flex align-items-center" id="sellerOption">
                <div class="col-md-6">
                    <div class="seller_shop">
                        <div class="shop_image d-flex justify-content-center align-items-center">
                            <a href="{{ route('shopView',[0]) }}" class="d-flex justify-content-center">
                                <img style="height: 65px;width: 65px; border-radius: 50%"
                                     src="{{asset("storage/app/public/company")}}/{{$web_config['fav_icon']->value}}"
                                     onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                     alt="">
                            </a>
                        </div>
                        <div class="shop_name d-flex justify-content-center align-items-center">
                            <div>
                                <a href="#" class="d-flex align-items-center">
                                    <div
                                        class="title">{{$web_config['name']->value}}</div>
                                </a>
                                <div class="review d-flex align-items-center">
                                    <div class="">
                                        <span class="d-inline-block font-size-sm text-body align-middle mt-1 mr-2">{{__('messages.web_admin')}}</span>
                                        <span
                                            class="d-inline-block font-size-sm text-body align-middle mt-1 ml-2"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-md-0 pt-sm-3">
                    <div class="seller_contact">

                        <div class="d-flex align-items-center pr-4">
                            <a href="{{ route('shopView',[0]) }}">
                                <button class="btn btn-secondary">
                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                    {{trans('messages.Visit')}}
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{--overview--}}
    <div class="container mt-4">
      <div class="row" style="background: white">
          <div class="col-12">
              <div class="product_overview mt-1">
                  <!-- Tabs-->
                  <ul class="nav nav-tabs d-flex justify-content-center" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link active" href="#overview" data-toggle="tab" role="tab"
                             style="color: black !important;">
                              {{trans('messages.OVERVIEW')}}
                          </a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="#reviews" data-toggle="tab" role="tab" style="color: black !important;">
                              {{trans('messages.REVIEWS')}}
                          </a>
                      </li>
                  </ul>
                  <div class="px-4 pt-lg-3 pb-3 mb-3">
                      <div class="tab-content px-lg-3">
                          <!-- Tech specs tab-->
                          <div class="tab-pane fade show active" id="overview" role="tabpanel">
                              <div class="row pt-2 specification">
                                  @if($product->video_url!=null)
                                      <div class="col-12 mb-4">
                                          <iframe width="420" height="315"
                                                  src="{{$product->video_url}}">
                                          </iframe>
                                      </div>
                                  @endif

                                  <div class="col-lg-12 col-md-12">
                                      {!! $product['details'] !!}
                                  </div>
                              </div>
                          </div>
                          <!-- Reviews tab-->
                          <div class="tab-pane fade" id="reviews" role="tabpanel">
                              <div class="row pt-2 pb-3">
                                  <div class="col-lg-4 col-md-5 ">
                                      <h2 class="overall_review mb-2">{{$overallRating[1]}}
                                          &nbsp{{trans('messages.Reviews')}} </h2>
                                      <div class="star-rating mr-2">
                                          @if (round($overallRating[0])==5)
                                              @for ($i = 0; $i < 5; $i++)
                                                  <i class="czi-star-filled font-size-sm text-accent mr-1"></i>
                                              @endfor
                                          @endif
                                          @if (round($overallRating[0])==4)
                                              @for ($i = 0; $i < 4; $i++)
                                                  <i class="czi-star-filled font-size-sm text-accent mr-1"></i>
                                              @endfor
                                              <i class="czi-star font-size-sm text-muted mr-1"></i>
                                          @endif
                                          @if (round($overallRating[0])==3)
                                              @for ($i = 0; $i < 3; $i++)
                                                  <i class="czi-star-filled font-size-sm text-accent mr-1"></i>
                                              @endfor
                                              @for ($j = 0; $j < 2; $j++)
                                                  <i class="czi-star font-size-sm text-accent mr-1"></i>
                                              @endfor
                                          @endif
                                          @if (round($overallRating[0])==2)
                                              @for ($i = 0; $i < 2; $i++)
                                                  <i class="czi-star-filled font-size-sm text-accent mr-1"></i>
                                              @endfor
                                              @for ($j = 0; $j < 3; $j++)
                                                  <i class="czi-star font-size-sm text-accent mr-1"></i>
                                              @endfor
                                          @endif
                                          @if (round($overallRating[0])==1)
                                              @for ($i = 0; $i < 4; $i++)
                                                  <i class="czi-star font-size-sm text-accent mr-1"></i>
                                              @endfor
                                              <i class="czi-star-filled font-size-sm text-accent mr-1"></i>
                                          @endif
                                          @if (round($overallRating[0])==0)
                                              @for ($i = 0; $i < 5; $i++)
                                                  <i class="czi-star font-size-sm text-muted mr-1"></i>
                                              @endfor
                                          @endif

                                      </div>
                                      <span class="d-inline-block align-middle">
                                    {{$overallRating[0]}} {{trans('messages.Overall')}} {{trans('messages.rating')}}
                                </span>
                                  </div>
                                  <div class="col-lg-8 col-md-7 pt-sm-3 pt-md-0">
                                      <div class="d-flex align-items-center mb-2">
                                          <div class="text-nowrap mr-3"><span
                                                  class="d-inline-block align-middle text-muted">{{trans('messages.5')}}</span><i
                                                  class="czi-star-filled font-size-xs ml-1"></i></div>
                                          <div class="w-100">
                                              <div class="progress" style="height: 4px;">
                                                  <div class="progress-bar bg-success" role="progressbar"
                                                       style="width: <?php echo $widthRating = ($rating[0] != 0) ? ($rating[0] / $overallRating[1]) * 100 : (0); ?>%;"
                                                       aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                              </div>
                                          </div>
                                          <span class="text-muted ml-3">
                                        {{$rating[0]}}
                                    </span>
                                      </div>

                                      <div class="d-flex align-items-center mb-2">
                                          <div class="text-nowrap mr-3"><span
                                                  class="d-inline-block align-middle text-muted">{{trans('messages.4')}}</span><i
                                                  class="czi-star-filled font-size-xs ml-1"></i></div>
                                          <div class="w-100">
                                              <div class="progress" style="height: 4px;">
                                                  <div class="progress-bar" role="progressbar"
                                                       style="width: <?php echo $widthRating = ($rating[1] != 0) ? ($rating[1] / $overallRating[1]) * 100 : (0); ?>%; background-color: #a7e453;"
                                                       aria-valuenow="27" aria-valuemin="0" aria-valuemax="100"></div>
                                              </div>
                                          </div>
                                          <span class="text-muted ml-3">
                                       {{$rating[1]}}
                                    </span>
                                      </div>

                                      <div class="d-flex align-items-center mb-2">
                                          <div class="text-nowrap mr-3"><span
                                                  class="d-inline-block align-middle text-muted">{{trans('messages.3')}}</span><i
                                                  class="czi-star-filled font-size-xs ml-1"></i></div>
                                          <div class="w-100">
                                              <div class="progress" style="height: 4px;">
                                                  <div class="progress-bar" role="progressbar"
                                                       style="width: <?php echo $widthRating = ($rating[2] != 0) ? ($rating[2] / $overallRating[1]) * 100 : (0); ?>%; background-color: #ffda75;"
                                                       aria-valuenow="17" aria-valuemin="0" aria-valuemax="100"></div>
                                              </div>
                                          </div>
                                          <span class="text-muted ml-3">
                                        {{$rating[2]}}
                                    </span>
                                      </div>

                                      <div class="d-flex align-items-center mb-2">
                                          <div class="text-nowrap mr-3"><span
                                                  class="d-inline-block align-middle text-muted">{{trans('messages.2')}}</span><i
                                                  class="czi-star-filled font-size-xs ml-1"></i></div>
                                          <div class="w-100">
                                              <div class="progress" style="height: 4px;">
                                                  <div class="progress-bar" role="progressbar"
                                                       style="width: <?php echo $widthRating = ($rating[3] != 0) ? ($rating[3] / $overallRating[1]) * 100 : (0); ?>%; background-color: #fea569;"
                                                       aria-valuenow="9" aria-valuemin="0" aria-valuemax="100"></div>
                                              </div>
                                          </div>
                                          <span class="text-muted ml-3">
                                    {{$rating[3]}}
                                    </span>
                                      </div>

                                      <div class="d-flex align-items-center">
                                          <div class="text-nowrap mr-3"><span
                                                  class="d-inline-block align-middle text-muted">{{trans('messages.1')}}</span><i
                                                  class="czi-star-filled font-size-xs ml-1"></i></div>
                                          <div class="w-100">
                                              <div class="progress" style="height: 4px;">
                                                  <div class="progress-bar bg-danger" role="progressbar"
                                                       style="width: <?php echo $widthRating = ($rating[4] != 0) ? ($rating[4] / $overallRating[1]) * 100 : (0); ?>%;"
                                                       aria-valuenow="4" aria-valuemin="0" aria-valuemax="100"></div>
                                              </div>
                                          </div>
                                          <span class="text-muted ml-3">
                                       {{$rating[4]}}
                                    </span>
                                      </div>
                                  </div>
                              </div>
                              <hr class="mt-4 pb-4 mb-3">
                              <div class="row pb-4">
                                  <div class="col-12">
                                      @if(count($product->reviews)>0)
                                          @foreach($product->reviews as $productReview)
                                              <div class="single_product_review p-2" style="margin-bottom: 20px">
                                                  <div class="product-review d-flex justify-content-between">
                                                      <div class="d-flex mb-3 pr-5">
                                                          <div class="media media-ie-fix align-items-center mr-4 pr-2">
                                                              <img style="max-height: 64px;" class="rounded-circle" width="64"
                                                                   onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                                   src="{{asset("storage/app/public/profile/".$productReview->user->image)}}"
                                                                   alt="{{$productReview->user->f_name}}"/>
                                                              <div class="media-body pl-3">
                                                                  <h6 class="font-size-sm mb-0">{{$productReview->user->f_name}}</h6>
                                                                  <div class="d-flex justify-content-between">
                                                                      <div
                                                                          class="product_review_rating">{{$productReview->rating}}</div>
                                                                      <div class="star-rating">

                                                                          @if ($productReview->rating==5)
                                                                              @for ($i = 0; $i < 5; $i++)
                                                                                  <i class="sr-star czi-star-filled active"></i>
                                                                              @endfor
                                                                          @endif
                                                                          @if ($productReview->rating==4)
                                                                              @for ($i = 0; $i < 4; $i++)
                                                                                  <i class="sr-star czi-star-filled active"></i>
                                                                              @endfor
                                                                              <i class="sr-star czi-star"></i>
                                                                          @endif
                                                                          @if ($productReview->rating==3)
                                                                              @for ($i = 0; $i < 3; $i++)
                                                                                  <i class="sr-star czi-star-filled active"></i>
                                                                              @endfor
                                                                              @for ($j = 0; $j < 2; $j++)
                                                                                  <i class="sr-star czi-star"></i>
                                                                              @endfor
                                                                          @endif
                                                                          @if ($productReview->rating==2)
                                                                              @for ($i = 0; $i < 2; $i++)
                                                                                  <i class="sr-star czi-star-filled active"></i>
                                                                              @endfor
                                                                              @for ($j = 0; $j < 3; $j++)
                                                                                  <i class="sr-star czi-star"></i>
                                                                              @endfor
                                                                          @endif
                                                                          @if ($productReview->rating==1)
                                                                              @for ($i = 0; $i < 4; $i++)
                                                                                  <i class="sr-star czi-star-filled active"></i>
                                                                              @endfor
                                                                              <i class="sr-star czi-star"></i>
                                                                          @endif
                                                                          @if ($productReview->rating==0)
                                                                              @for ($i = 0; $i < 5; $i++)
                                                                                  <i class="sr-star czi-star"></i>
                                                                              @endfor
                                                                          @endif
                                                                      </div>
                                                                  </div>

                                                                  <div class="font-size-ms text-muted">
                                                                      {{$productReview->created_at->format('M d Y')}}
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div>
                                                          <p class="font-size-md mt-3 mb-2">{{$productReview->comment}}</p>
                                                          @if (!empty(json_decode($productReview->attachment)))
                                                              @foreach (json_decode($productReview->attachment) as $key => $photo)
                                                                  <img
                                                                      style="cursor: pointer;border-radius: 5px;border:1px;border-color: #7a6969; height: 67px ; margin-right: 5px;"
                                                                      onclick="showInstaImage('{{asset("storage/app/public/$photo")}}')"
                                                                      class="cz-image-zoom"
                                                                      onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                                      src="{{asset("storage/app/public/$photo")}}"
                                                                      alt="Product review" width="67">
                                                              @endforeach
                                                          @endif
                                                      </div>
                                                  </div>
                                              </div>
                                              <!-- Review-->
                                          @endforeach
                                      @else
                                          <div class="card">
                                              <div class="card-body">
                                                  <h6 class="text-danger text-center">{{trans('messages.product_review_not_available')}}</h6>
                                              </div>
                                          </div>
                                      @endif
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>

    <!-- Product carousel (You may also like)-->
    <div class="container  mb-3">
        <div class="feature_header">
            <span>{{ trans('messages.similar_products')}}</span>
        </div>

        <div class="view_all view-btn-div">
            <div>
                @php($category=json_decode($product['category_ids']))
                <a class="btn btn-outline-accent btn-sm viw-btn-a"
                   href="{{route('products',['id'=> $category[0]->id,'data_from'=>'category','page'=>1])}}">{{ trans('messages.view_all')}}
                    <i class="czi-arrow-right ml-1 mr-n1"></i>
                </a>
            </div>
        </div>
        <!-- Grid-->
        <hr class="view_border">
        <!-- Product-->
        <div class="row mt-4">
            @if (count($relatedProducts)>0)
                @foreach($relatedProducts as $key => $relatedProduct)
                    <div class="col-xl-2 col-sm-3 col-6" style="margin-bottom: 20px">
                        @include('web-views.partials._single-product',['product'=>$relatedProduct])
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-danger text-center">{{trans('messages.similar')}} {{trans('messages.product_not_available')}}</h6>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade" id="show-modal-view" tabindex="-1" role="dialog" aria-labelledby="show-modal-image"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button class="btn btn-default"
                            style="border-radius: 50%;margin-top: -25px;position: absolute;right: -7px;"
                            data-dismiss="modal">
                        <i class="fa fa-close"></i>
                    </button>
                    <img id="attachment-view" src="">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

    <script type="text/javascript">
        cartQuantityInitialize();
        getVariantPrice();
        $('#add-to-cart-form input').on('change', function () {
            getVariantPrice();
        });

        function showInstaImage(link) {
            $("#attachment-view").attr("src", link);
            $('#show-modal-view').modal('toggle')
        }
    </script>

    {{-- Messaging with shop seller --}}
    <script>
        $('#contact-seller').on('click', function (e) {
            // $('#seller_details').css('height', '200px');
            $('#seller_details').animate({'height': '276px'});
            $('#msg-option').css('display', 'block');
        });
        $('#sendBtn').on('click', function (e) {
            e.preventDefault();
            let msgValue = $('#msg-option').find('textarea').val();
            let data = {
                message: msgValue,
                shop_id: $('#msg-option').find('textarea').attr('shop-id'),
                seller_id: $('.msg-option').find('.seller_id').attr('seller-id'),
            }
            if (msgValue != '') {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "post",
                    url: '{{route('messages_store')}}',
                    data: data,
                    success: function (respons) {
                        console.log('send successfully');
                    }
                });
                $('#chatInputBox').val('');
                $('#msg-option').css('display', 'none');
                $('#contact-seller').find('.contact').attr('disabled', '');
                $('#seller_details').animate({'height': '125px'});
                $('#go_to_chatbox').css('display', 'block');
            } else {
                console.log('say something');
            }
        });
        $('#cancelBtn').on('click', function (e) {
            e.preventDefault();
            $('#seller_details').animate({'height': '114px'});
            $('#msg-option').css('display', 'none');
        });
    </script>

    <script type="text/javascript"
            src="https://platform-api.sharethis.com/js/sharethis.js#property=5f55f75bde227f0012147049&product=sticky-share-buttons"
            async="async"></script>
@endpush
