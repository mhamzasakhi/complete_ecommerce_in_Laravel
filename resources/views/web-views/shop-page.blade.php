@extends('layouts.front-end.app')

@section('title','Shop Page')

@push('css_or_js')
    @if($shop['id'] != 0)
        <meta property="og:image" content="{{asset('storage/app/public/shop')}}/{{$shop->image}}"/>
        <meta property="og:title" content="{{ $shop->name}} "/>
        <meta property="og:url" content="{{route('shopView',[$shop['id']])}}">
    @else
        <meta property="og:image" content="{{asset('storage/app/public/company')}}/{{$web_config['fav_icon']->value}}"/>
        <meta property="og:title" content="{{ $shop['name']}} "/>
        <meta property="og:url" content="{{route('shopView',[$shop['id']])}}">
    @endif
    <meta property="og:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    @if($shop['id'] != 0)
        <meta property="twitter:card" content="{{asset('storage/app/public/shop')}}/{{$shop->image}}"/>
        <meta property="twitter:title" content="{{route('shopView',[$shop['id']])}}"/>
        <meta property="twitter:url" content="{{route('shopView',[$shop['id']])}}">
    @else
        <meta property="twitter:card"
              content="{{asset('storage/app/public/company')}}/{{$web_config['fav_icon']->value}}"/>
        <meta property="twitter:title" content="{{route('shopView',[$shop['id']])}}"/>
        <meta property="twitter:url" content="{{route('shopView',[$shop['id']])}}">
    @endif

    <meta property="twitter:description" content="{!! substr($web_config['about']->value,0,100) !!}">


    <link href="{{asset('public/assets/front-end')}}/css/home.css" rel="stylesheet">
    <style>
        .headerTitle {
            font-size: 34px;
            font-weight: bolder;
            margin-top: 3rem;
        }

        .page-item.active .page-link {
            background-color: {{$web_config['primary_color']}}                     !important;
        }

        .page-item.active > .page-link {
            box-shadow: 0 0 black !important;
        }

        /***********************************/
        .sidepanel {
            width: 0;
            position: fixed;
            z-index: 6;
            height: 500px;
            top: 0;
            left: 0;
            background-color: #ffffff;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 40px;
        }

        .sidepanel a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidepanel a:hover {
            color: #f1f1f1;
        }

        .sidepanel .closebtn {
            position: absolute;
            top: 0;
            right: 0px;
            font-size: 36px;
        }

        .openbtn {
            font-size: 18px;
            cursor: pointer;
            background-color: #ffffff;
            color: #373f50;
            width: 40%;
            border: none;
        }

        .openbtn:hover {
            background-color: #444;
        }

        .for-display {
            display: block !important;
        }

        @media (max-width: 360px) {
            .openbtn {
                width: 59%;
            }

            .for-shoting-mobile {
                margin-right: 0% !important;
            }

            .for-mobile {

                margin-left: 10% !important;
            }

        }

        @media screen and (min-width: 375px) {

            .for-shoting-mobile {
                margin-right: 7% !important;
            }

            .custom-select {
                width: 86px;
            }


        }

        @media (max-width: 500px) {
            .for-mobile {

                margin-left: 27%;
            }

            .openbtn:hover {
                background-color: #fff;
            }

            .for-display {
                display: flex !important;
            }

            .for-shoting-mobile {
                margin-right: 11%;
            }

            .for-tab-display {
                display: none !important;
            }

            .openbtn-tab {
                margin-top: 0 !important;
            }

        }

        @media screen and (min-width: 500px) {
            .openbtn {
                display: none !important;
            }


        }

        @media screen and (min-width: 800px) {


            .for-tab-display {
                display: none !important;
            }

        }

        @media (max-width: 768px) {
            .headerTitle {
                font-size: 23px;

            }

            .openbtn-tab {
                margin-top: 3rem;
                display: inline-block !important;
            }

            .for-tab-display {
                display: inline;
            }

        }


    </style>
@endpush

@section('content')
    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-4">
        <div class="row">
            <!-- banner  -->
            <div class="col-lg-12 mt-2">
                <div style="background: white">
                    @if($shop['id'] != 0)
                        <img style="width:100%; height: auto; max-height: 13.75rem; border-radius: 3px;"
                             src="{{asset('storage/app/public/shop/banner')}}/{{$shop->banner}}"
                             onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                             alt="">
                    @else
                        @php($banner=\App\CPU\Helpers::get_business_settings('shop_banner'))
                        <img style="width:100%; height: auto; max-height: 13.75rem; border-radius: 3px;"
                             src="{{asset("storage/app/public/shop")}}/{{$banner??""}}"
                             onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                             alt="">
                    @endif
                </div>
            </div>
            {{-- sidebar opener --}}
            <div class="col-md-3 mt-2 ">
                <a class="openbtn-tab" style="" onclick="openNav()">
                    <div style="font-size: 20px; font-weight: 600; " class="for-tab-display">
                        ☰ {{trans('messages.categories')}}</div>
                </a>
            </div>
            {{-- seller info+contact --}}
            <div class="col-lg-12">
                <div class="mt-4 mb-2">
                    <div class="row">
                        {{-- logo --}}
                        <div class="col-lg-8 col-md-6 col-12" style="display: inline-flex">
                            <div style="display:inline-block; vertical-align:top">
                                @if($shop['id'] != 0)
                                    <img style="height: 65px; border-radius: 2px;"
                                         src="{{asset('storage/app/public/shop')}}/{{$shop->image}}"
                                         onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                         alt="">
                                @else
                                    <img style="height: 65px; border-radius: 2px;"
                                         src="{{asset('storage/app/public/company')}}/{{$web_config['fav_icon']->value}}"
                                         onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                         alt="">
                                @endif
                            </div>
                            <div style="display:inline-block;">
                                <h6 class="ml-4 font-weight-bold mt-3">
                                    @if($shop['id'] != 0)
                                        {{ $shop->name}}
                                    @else
                                        {{ $web_config['name']->value }}
                                    @endif
                                </h6>
                                <span class="ml-4">
                                    <span class="mr-1">{{ $total_rating}}</span>
                                    @for($i=0; $i<$total_rating; $i++)
                                        <i class="sr-star czi-star-filled active"></i>
                                    @endfor
                                    @if($total_rating == 0)
                                        <i class="sr-star czi-star"></i>
                                    @endif
                                    <span class="ml-3">{{ $total_review}} Reviews / {{ $total_order}} Orders</span>
                                </span>
                            </div>
                        </div>

                        {{-- contact --}}
                        <div class="col-md-2 col-12">
                            @if($seller_id!=0)
                                @if (auth('customer')->check())
                                    <div class="d-flex">
                                        <a href="{{route('customer.auth.login')}}" class="btn btn-primary btn-block">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                            {{trans('messages.Contact')}} {{trans('messages.Seller')}}
                                        </a>
                                    </div>
                                @else
                                    <div class="d-flex">
                                        <button class="btn btn-primary btn-block" data-toggle="modal"
                                                data-target="#exampleModal">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                            {{trans('messages.Contact')}} {{trans('messages.Seller')}}
                                        </button>
                                    </div>
                                @endif
                            @endif
                        </div>

                        {{-- search --}}
                        <div class="col-lg-2 col-md-4 col-12 pt-2">
                            <form class="form-inline md-form form-sm mt-0" method="get"
                                  action="{{route('shopView',['id'=>$seller_id])}}">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="text" class="form-control" name="product_name"
                                           placeholder="Search Product" aria-label="Recipient's username"
                                           aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button type="submit" class="input-group-text" id="basic-addon2">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="card-header">
                                Write Something
                            </div>
                            <div class="modal-body">
                                <form action="{{route('messages_store')}}" method="post" id="chat-form">
                                    @csrf
                                    @if($shop['id'] != 0)
                                        <input value="{{$shop->id}}" name="shop_id" hidden>
                                        <input value="{{$shop->seller_id}}}" name="seller_id" hidden>
                                    @endif

                                    <textarea name="message" class="form-control"></textarea>
                                    <br>
                                    @if($shop['id'] != 0)
                                        <button class="btn btn-primary" style="color: white;">Send</button>
                                    @else
                                        <button class="btn btn-primary" style="color: white;" disabled>Send</button>
                                    @endif
                                </form>
                            </div>
                            <div class="card-footer">
                                <a href="{{route('chat-with-seller')}}" class="btn btn-primary">
                                    {{trans('messages.go_to')}} {{trans('messages.chatbox')}}
                                </a>
                                <button type="button" class="btn btn-secondary pull-right" data-dismiss="modal">Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        {{-- sidebar opener --}}
        <button class="openbtn" onclick="openNav()">
            <div style="margin-bottom: -30%; text-align: left;">☰ {{trans('messages.categories')}}</div>
        </button>

        <div class="row mt-2 mr-0">
            {{-- sidebar (Category) - before toggle --}}
            <div class="col-lg-3 mt-3 pr-0 mr-0">
                <aside class=" hidden-xs SearchParameters" id="SearchParameters">
                    <!-- Categories Sidebar-->
                    <div class="cz-sidebar rounded-lg box-shadow-lg" id="shop-sidebar">
                        <div class="cz-sidebar-body">
                            <!-- Categories-->
                            <div class="widget widget-categories mb-4 pb-4 border-bottom">
                                <div>
                                    <div style="display: inline">
                                        <h3 class="widget-title"
                                            style="font-weight: 700;display: inline">{{trans('messages.categories')}}</h3>
                                    </div>
                                </div>
                                <div class="divider-role"
                                     style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: 5px;"></div>
                                <div class="accordion mt-n1" id="shop-categories">
                                    @foreach($categories as $category)
                                        <div class="card">
                                            <div class="card-header p-1">
                                                <label class="for-hover-lable" style="cursor: pointer"
                                                       onclick="location.href='{{route('shopView',['id'=> $seller_id,'category_id'=>$category['id']])}}'" {{--onclick="productSearch({{$seller_id}}, {{$category['id']}})"--}}>
                                                    {{$category['name']}}
                                                </label>
                                                <strong class="pull-right for-brand-hover" style="cursor: pointer"
                                                        onclick="$('#collapse-m-{{$category['id']}}').toggle(400)">
                                                    {{$category->childes->count()>0?'+':''}}
                                                </strong>
                                            </div>
                                            <div class="card-body ml-2" id="collapse-m-{{$category['id']}}"
                                                 style="display: none">
                                                @foreach($category->childes as $child)
                                                    <div class=" for-hover-lable card-header p-1">
                                                        <label style="cursor: pointer"
                                                               onclick="location.href='{{route('shopView',['id'=> $seller_id,'category_id'=>$child['id']])}}'">
                                                            {{$child['name']}}
                                                        </label>
                                                        <strong class="pull-right" style="cursor: pointer"
                                                                onclick="$('#collapse-m-{{$child['id']}}').toggle(400)">
                                                            {{$child->childes->count()>0?'+':''}}
                                                        </strong>
                                                    </div>
                                                    <div class="card-body ml-2" id="collapse-m-{{$child['id']}}"
                                                         style="display: none">
                                                        @foreach($child->childes as $ch)
                                                            <div class="card-header p-1">
                                                                <label class="for-hover-lable" style="cursor: pointer"
                                                                       onclick="location.href='{{route('shopView',['id'=> $seller_id,'category_id'=>$ch['id']])}}'">
                                                                    {{$ch['name']}}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
            {{-- sidebar (Category) - after toggle --}}
            <div id="mySidepanel" class="sidepanel">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                <div class="cz-sidebar-body">
                    <div class="widget widget-categories mb-4 pb-4 border-bottom">
                        <div>
                            <div style="display: inline">
                                <h3 class="widget-title"
                                    style="font-weight: 700;display: inline">{{trans('messages.categories')}}</h3>
                            </div>
                        </div>
                        <div class="divider-role"
                             style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: 5px;"></div>
                        <div class="accordion mt-n1" id="shop-categories">
                            @foreach($categories as $category)
                                <div class="card">
                                    <div class="card-header p-1">
                                        <label class="for-hover-lable" style="cursor: pointer"
                                               onclick="location.href='{{route('shopView',['id'=> $seller_id,'category_id'=>$category['id']])}}'" {{--onclick="productSearch({{$seller_id}}, {{$category['id']}})"--}}>
                                            {{$category['name']}}
                                        </label>
                                        <strong class="pull-right for-brand-hover" style="cursor: pointer"
                                                onclick="$('#collapse-{{$category['id']}}').toggle(400)">
                                            {{$category->childes->count()>0?'+':''}}
                                        </strong>
                                    </div>
                                    <div class="card-body ml-2" id="collapse-{{$category['id']}}"
                                         style="display: none">
                                        @foreach($category->childes as $child)
                                            <div class=" for-hover-lable card-header p-1">
                                                <label style="cursor: pointer"
                                                       onclick="location.href='{{route('shopView',['id'=> $seller_id,'category_id'=>$child['id']])}}'">
                                                    {{$child['name']}}
                                                </label>
                                                <strong class="pull-right" style="cursor: pointer"
                                                        onclick="$('#collapse-{{$child['id']}}').toggle(400)">
                                                    {{$child->childes->count()>0?'+':''}}
                                                </strong>
                                            </div>
                                            <div class="card-body ml-2" id="collapse-{{$child['id']}}"
                                                 style="display: none">
                                                @foreach($child->childes as $ch)
                                                    <div class="card-header p-1">
                                                        <label class="for-hover-lable" style="cursor: pointer"
                                                               onclick="location.href='{{route('shopView',['id'=> $seller_id,'category_id'=>$ch['id']])}}'">
                                                            {{$ch['name']}}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            {{-- main body (Products) --}}
            <div class="col-lg-9 product-div">
                <div class="mt-3">
                    {{--<form class="" id="search-form" action="{{ route('products') }}" method="GET">
                        <input hidden name="data_from">
                        <div class="form-inline flex-nowrap mr-3 mr-sm-4 pb-3">
                            <label style="font-weight: 600;font-size: 18px;padding-right: 9px; color:#030303; "
                                   class=" opacity-75 text-nowrap mr-2 d-none d-sm-block" for="sorting">
                                Sort by
                            </label>
                            <select style="background: whitesmoke; appearance: auto;"
                                    class="form-control custom-select" onchange="filter(this.value)">
                                <option value="latest">Latest</option>
                                <option value="low-high">Low - Hight Price</option>
                                <option value="high-low">High - Low Price</option>
                                <option value="a-z">A - Z Order</option>
                                <option value="z-a">Z - A Order</option>
                            </select>
                        </div>
                    </form>--}}
                </div>
                <!-- Products grid-->
                <div class="row mt-3" id="ajax-products">
                    @include('web-views.products._ajax-products',['products'=>$products])
                </div>
            {{--<hr class="my-3">--}}
            <!-- Pagination-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="justify-content-center center-block align-content-center">
                            {!! $products->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function productSearch(seller_id, category_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: '{{url('/')}}/shopView/' + seller_id + '?category_id=' + category_id,

                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (response) {
                    $('#ajax-products').html(response.view);
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        }
    </script>

    {{-- <script>
        function filter(value) {
            $.get({
                url: '{{url('/')}}/products',
                data: {
                    id: '{{$data['id']}}',
                    name: '{{$data['name']}}',
                    data_from: '{{$data['data_from']}}',
                    min_price: '{{$data['min_price']}}',
                    max_price: '{{$data['max_price']}}',
                    sort_by: value
                },
                dataType: 'json',
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (response) {
                    $('#ajax-products').html(response.view);
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        }

        function searchByPrice() {
            let min = $('#min_price').val();
            let max = $('#max_price').val();
            $.get({
                url: '{{url('/')}}/products',
                data: {
                    id: '{{$data['id']}}',
                    name: '{{$data['name']}}',
                    data_from: '{{$data['data_from']}}',
                    sort_by: '{{$data['sort_by']}}',
                    min_price: min,
                    max_price: max,
                },
                dataType: 'json',
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (response) {
                    $('#ajax-products').html(response.view);
                    $('#paginator-ajax').html(response.paginator);
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        }

        $("#search-brand").on("keyup", function () {
            var value = this.value.toLowerCase().trim();
            $("#lista1 div>li").show().filter(function () {
                return $(this).text().toLowerCase().trim().indexOf(value) == -1;
            }).hide();
        });
    </script> --}}

    <script>
        function openNav() {

            document.getElementById("mySidepanel").style.width = "50%";
        }

        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
        }
    </script>

    <script>
        $('#chat-form').on('submit', function (e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: '{{route('messages_store')}}',
                data: $('#chat-form').serialize(),
                success: function (respons) {

                    toastr.success('send successfully', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    $('#chat-form').trigger('reset');
                }
            });

        });
    </script>
@endpush
