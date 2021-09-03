<!-- Footer -->
<style>
    .page-footer {
        background: #333e4f;
        color: white;
    }

    .social-btn {
        border: 1px solid white;
        border-radius: 50%;
        height: 2rem;
        width: 2rem;
    }

    .btn-market .btn-market-title {
        font-size: 14px !important;
    }

    .social-btn i {
        line-height: 1.90rem;
    }

    .compny_name {
        font-size: 39px;
        margin-left: 5px;
    }

    .for-margin {
        margin-top: 10px;
    }

    .font-weight-bold {
        font-weight: 600 !important;
    }

    .footer-heder {
        color: #FFFFFF;
    }


    .payment-card {
        background: white;
        border-radius: 6px;
        max-width: 134px;
        padding-bottom: 5px;
        padding-top: 5px;
        margin-bottom: 3px;
        margin-right: 10px;
        margin-left: 5px;
    }

    .fa-shopping-cart {
        font-size: 56px;

    }

    .widget-list-link {
        color: #d9dce2;
    }

    .page-footer hr {
        border: 0.001px solid #2d3542;
    }
    .social-media :hover{
     color:  {{$web_config['secondary_color']}} !important;
    }
    @media (min-width: 768px) {
        .fa-shopping-cart {
            font-size: 48px;

        }


        .compny_name {
            font-size: 30px;
            margin-left: 3px;
        }
    }
    @media(max-width:1024px){
        .payment-tab{
            display: none;
        }
    }
 @media(max-width: 768px){
    .payment-tab{
            display: none;
        }
        .apple_app{
            padding-right: 0px;
        }
       .apple_app{
           padding-right: 0% !important;
       }
       .goole_app{
           padding-left: 0% !important;
       }
       .razorpay{
        margin-left: 30%;
    margin-top: 7px;
       }
 }
    @media (max-width: 500px) {
        .razorpay{
        margin-left: 30%;
    margin-top: 7px;
       }
        .mobile-padding {
            margin-bottom: 4%;
        }

        .widget-list {
            margin-bottom: 3%;
        }

        .for-mobile-delivery {
            margin-left: 15px;
        }

    }
    @media(max-width: 360px){
        .glaxy-for-mobile{
            margin-left: 1rem;
    margin-bottom: 0.55rem;
        }
    }
    @media(max-width: 375px){
        .razorpay{
        margin-left: 31%;
    margin-top: 7px;
       }
        .glaxy-for-mobile{
            margin-left: 1rem;
    margin-bottom: 0.55rem;
        }
    }
    @media(max-width: 414px)
    {
        .glaxy-for-mobile{
            margin-left: 26px;
    margin-bottom: 10px;
        }
    }
    @media(max-width: 425px)
    {
        .glaxy-for-mobile{
            margin-left: 26px;
    margin-bottom: 10px;
        }
    }

    @media screen and (max-width: 500px) {
        .title_message {
            visibility: hidden;
            clear: both;
            float: left;
            margin: 10px auto 5px 20px;
            width: 28%;
            display: none;
        }
        .for-m-p{
            margin-bottom: 5px;
    margin-left: 8%;
        }
    }
</style>

<footer class="page-footer font-small mdb-color pt-3">
    <!-- Footer Links -->
    <div class="container text-center" style="padding-bottom: 13px;">

        <!-- Footer links -->
        <div class="row text-center text-md-left mt-3 pb-3">

            <!-- Grid column -->
            <div class="col-md-3 col-lg-3 col-xl-3 mr-auto mt-3">
                <div class="text-nowrap mb-4">
                    <a class="d-inline-block align-middle mt-n1 mr-3" href="{{route('home')}}">
                        <img width="250" style="height: 60px!important;"
                             src="{{asset("storage/app/public/company/")}}/{{ $web_config['footer_logo']->value }}"
                             onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                             alt="{{ $web_config['name']->value }}"/>
                    </a>
                </div>
                @php
                    $social_media = \App\Model\SocialMedia::where('active_status', 1)->get();
                @endphp
                <center>
                @if(isset($social_media))
                    @foreach ($social_media as $item)
                    <span class="social-media">
                        <a class="social-btn sb-light sb-{{$item->name}} ml-2 mb-2" target="_blank" href="{{$item->link}}">
                            <i class="{{$item->icon}}" aria-hidden="true"></i>
                        </a>
                    </span>
                    @endforeach
                @endif
            </center>

                <div class="widget mb-4 for-margin">
                    <h6 class="text-uppercase mb-4 font-weight-bold footer-heder">
                        <center>
                            {{trans('messages.download_our_app')}}
                        </center>
                    </h6>
                    <div class="row">
                        <div class="col-6 apple_app">
                            @php($config = \App\CPU\Helpers::get_business_settings('download_app_apple_stroe'))
                            {{-- {{ $config['link'] }} --}}
                            @if($config['status'])
                                <div class="mr-2 mb-2 pull-right">
                                    <a class="" href="{{ $config['link'] }}" role="button"><img
                                            style="height: 32px;"
                                            src="{{asset("storage/app/public/png/apple_app.png")}}"
                                            alt="">
                                    </a>
                                </div>
                            @endif
                        </div>
                        <div class="col-6 goole_app">
                            @php($config = \App\CPU\Helpers::get_business_settings('download_app_google_stroe'))
                            @if($config['status'])
                                <div class="mr-2 mb-2 pull-left">
                                    <a class="" href="{{ $config['link'] }}" role="button"><img
                                            style="height: 32px;"
                                            src="{{asset("storage/app/public/png/google_app.png")}}"
                                            alt=""></a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Grid column -->

            <hr class="w-100 clearfix d-md-none">

            <!-- Grid column -->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold footer-heder">{{trans('messages.special')}}</h6>
                <ul class="widget-list">
                    @php($flash_deals=\App\Model\FlashDeal::where(['status'=>1,'deal_type'=>'flash_deal'])->whereDate('start_date','<=',date('Y-m-d'))->whereDate('end_date','>=',date('Y-m-d'))->first())
                    @if(isset($flash_deals))
                        <li class="widget-list-item">
                            <a class="widget-list-link"
                               href="{{route('flash-deals',[$flash_deals['id']])}}">
                                {{trans('messages.flash_deal')}}
                            </a>
                        </li>
                    @endif
                    <li class="widget-list-item"><a class="widget-list-link"
                                                    href="{{route('products',['data_from'=>'featured','page'=>1])}}">{{trans('messages.featured_products')}}</a>
                    </li>
                    <li class="widget-list-item"><a class="widget-list-link"
                                                    href="{{route('products',['data_from'=>'latest','page'=>1])}}">{{trans('messages.latest_products')}}</a>
                    </li>
                    <li class="widget-list-item"><a class="widget-list-link"
                                                    href="{{route('products',['data_from'=>'best-selling','page'=>1])}}">{{trans('messages.best_selling_product')}}</a>
                    </li>
                    <li class="widget-list-item"><a class="widget-list-link"
                                                    href="{{route('products',['data_from'=>'top-rated','page'=>1])}}">{{trans('messages.top_rated_product')}}</a>
                    </li>

                    <li class="widget-list-item"><a class="widget-list-link"
                                                    href="{{route('brands')}}">{{trans('messages.all_brand')}}</a></li>
                    <li class="widget-list-item"><a class="widget-list-link"
                                                    href="{{route('categories')}}">{{trans('messages.all_category')}}</a>
                    </li>

                </ul>
            </div>
            <!-- Grid column -->

            <hr class="w-100 clearfix d-md-none">

            <!-- Grid column -->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold footer-heder">{{trans('messages.account&shipping_info')}}</h6>
                @if(auth('customer')->check())
                    <ul class="widget-list">
                        <li class="widget-list-item"><a class="widget-list-link"
                                                        href="{{route('user-account')}}">{{trans('messages.profile_info')}}</a>
                        </li>
                        <li class="widget-list-item"><a class="widget-list-link"
                                                        href="{{route('wishlists')}}">{{trans('messages.wish_list')}}</a>
                        </li>
                        {{--<li class="widget-list-item">
                            <a class="widget-list-link"
                               href="{{route('customer.auth.login')}}">{{trans('messages.chat_with_seller_s')}}
                            </a>
                        </li>--}}
                        <li class="widget-list-item"><a class="widget-list-link"
                                                        href="{{route('track-order.index')}}">{{trans('messages.track_order')}}</a>
                        </li>
                        <li class="widget-list-item"><a class="widget-list-link"
                                                        href="{{ route('account-address') }}">{{trans('messages.address')}}</a>
                        </li>
                        <li class="widget-list-item"><a class="widget-list-link"
                                                        href="{{ route('account-tickets') }}">{{trans('messages.support_ticket')}}</a>
                        </li>
                        {{--<li class="widget-list-item">
                            <a class="widget-list-link"
                               href="{{route('customer.auth.login')}}">{{trans('messages.tansction_history')}}
                            </a>
                        </li>--}}
                    </ul>
                @else
                    <ul class="widget-list">
                        <li class="widget-list-item"><a class="widget-list-link"
                                                        href="{{route('customer.auth.login')}}">{{trans('messages.profile_info')}}</a>
                        </li>
                        <li class="widget-list-item"><a class="widget-list-link"
                                                        href="{{route('customer.auth.login')}}">{{trans('messages.wish_list')}}</a>
                        </li>
                        {{--<li class="widget-list-item">
                            <a class="widget-list-link"
                               href="{{route('customer.auth.login')}}">{{trans('messages.chat_with_seller_s')}}
                            </a>
                        </li>--}}
                        <li class="widget-list-item"><a class="widget-list-link"
                                                        href="{{route('track-order.index')}}">{{trans('messages.track_order')}}</a>
                        </li>
                        <li class="widget-list-item"><a class="widget-list-link"
                                                        href="{{route('customer.auth.login')}}">{{trans('messages.address')}}</a>
                        </li>
                        <li class="widget-list-item"><a class="widget-list-link"
                                                        href="{{route('customer.auth.login')}}">{{trans('messages.support_ticket')}}</a>
                        </li>
                        {{--to do--}}
                        {{--<li class="widget-list-item">
                            <a class="widget-list-link"
                               href="{{route('customer.auth.login')}}">{{trans('messages.tansction_history')}}
                            </a>
                        </li>--}}
                    </ul>
                @endif
            </div>

            <!-- Grid column -->
            <hr class="w-100 clearfix d-md-none">

            <!-- Grid column -->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold footer-heder">{{trans('messages.about_us')}}</h6>


                <ul class="widget-list">
                    {{-- <p class="widget-list-item">{!! substr($web_config['about']->value,0,100) !!}</p> --}}
                    <li class="widget-list-item"><a class="widget-list-link"
                                                    href="{{route('about-us')}}">{{trans('messages.about_company')}}</a>
                    </li>
                    <li class="widget-list-item"><a class="widget-list-link"
                                                    href="{{route('helpTopic')}}">{{trans('messages.faq')}}</a></li>
                    <li class="widget-list-item "><a class="widget-list-link"
                                                         href="{{route('terms')}}">{{trans('messages.terms_&_conditions')}}</a>

                    </li>

                    <li class="widget-list-item ">
                        <a class="widget-list-link" href="{{route('privacy-policy')}}">
                            {{trans('messages.privacy_policy')}}
                        </a>
                    </li>
                    <li class="widget-list-item "><a class="widget-list-link"
                                                         href="{{route('contacts')}}">{{trans('messages.contact_us')}}</a>

                    </li>
                </ul>
            </div>
            <!-- Grid column -->
        </div>
        <!-- Footer links -->
    </div>

    <hr>
    <!-- Grid row -->
    <div class="container text-center">
        <div class="row d-flex align-items-center footer-end">
            <div class="col-md-12 mt-3">
                <p class="text-center" style="font-size: 12px;">{{ $web_config['copyright_text']->value }}</p>
            </div>
        </div>
        <!-- Grid row -->

    </div>
    <!-- Footer Links -->
</footer>
<!-- Footer -->
