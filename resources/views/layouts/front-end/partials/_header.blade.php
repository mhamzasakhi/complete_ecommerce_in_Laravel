<style>
    .dropdown-menu {
        min-width: 304px !important;
        margin-left: -8px;
        border-top-left-radius: 0px;
        border-top-right-radius: 0px;
    }

    .card-body.search-result-box {
        overflow: scroll;
        height: 400px;
        overflow-x: hidden;
    }

    .active .seller {
        font-weight: 700;
    }

    .for-count-value {
        position: absolute;

        right: 0.6875rem;;
        width: 1.25rem;
        height: 1.25rem;
        border-radius: 50%;
        color: {{$web_config['primary_color']}};

        font-size: .75rem;
        font-weight: 500;
        text-align: center;
        line-height: 1.25rem;
    }

    @media (min-width: 992px) {
        .navbar-sticky.navbar-stuck .navbar-stuck-menu.show {
            display: block;
            height: 55px !important;
        }
    }

    @media (min-width: 768px) {
        .navbar-stuck-menu {
            background-color: {{$web_config['primary_color']}};
            line-height: 15px;
            padding-bottom: 6px;
        }

    }

    @media (max-width: 767px) {
        .search_button {
            background-color: transparent !important;
        }

        .search_button .input-group-text i {
            color: {{$web_config['primary_color']}}                       !important;
        }

        .navbar-expand-md .dropdown-menu > .dropdown > .dropdown-toggle {
            position: relative;
            padding-right: 1.95rem;
        }

        .navbar-brand img {

        }

        .mega-nav1 {
            background: white;
            color: {{$web_config['primary_color']}}                       !important;
            border-radius: 3px;
        }

        .mega-nav1 .nav-link {
            color: {{$web_config['primary_color']}}                       !important;
        }
    }

    @media (max-width: 768px) {
        .tab-logo {
            width: 10rem;
        }
    }

    @media (max-width: 360px) {
        .mobile-head {
            padding: 3px;
        }
    }

    @media (max-width: 471px) {
        .navbar-brand img {

        }

        .mega-nav1 {
            background: white;
            color: {{$web_config['primary_color']}}                       !important;
            border-radius: 3px;
        }

        .mega-nav1 .nav-link {
            color: {{$web_config['primary_color']}}                       !important;
        }
    }


</style>

<header class="box-shadow-sm">
    <!-- Topbar-->
    <div class="topbar">
        <div class="container ">
            <div>
                @php
                    $locale = session()->get('locale') ;
                    if ($locale==""){
                        $locale = "en";
                    }
                    \App\CPU\Helpers::currency_load();
                    $currency_code = session('currency_code');
                    $currency_symbol= session('currency_symbol');
                    if ($currency_symbol=="")
                    {
                        $system_default_currency_info = \session('system_default_currency_info');
                        $currency_symbol = $system_default_currency_info->symbol;
                        $currency_code = $system_default_currency_info->code;
                    }
                    $language=\App\CPU\Helpers::language_load();
                    $company_phone =$web_config['phone']->value;
                    $company_name =$web_config['name']->value;
                    $company_web_logo =$web_config['web_logo']->value;
                    $company_mobile_logo =$web_config['mob_logo']->value;
                @endphp
                <div class="topbar-text dropdown disable-autohide mr-3 text-capitalize">
                    <a class="topbar-link dropdown-toggle" href="#" data-toggle="dropdown">
                        @foreach(json_decode($language['value'],true) as $data)
                            @if($data['code']==$locale)
                                <img class="mr-2" width="20"
                                     src="{{asset('public/assets/front-end')}}/img/flags/{{$data['code']}}.png"
                                     alt="Eng">
                                {{$data['name']}}
                            @endif
                        @endforeach
                    </a>
                    <ul class="dropdown-menu">
                        @foreach(json_decode($language['value'],true) as $key =>$data)
                            @if($data['status']==1)
                                <li>
                                    <a class="dropdown-item pb-1" href="{{route('lang',[$data['code']])}}">
                                        <img class="mr-2" width="20"
                                             src="{{asset('public/assets/front-end')}}/img/flags/{{$data['code']}}.png"
                                             alt="{{$data['name']}}"/>
                                        <span style="text-transform: uppercase">{{$data['code']}}</span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>


                <div class="topbar-text dropdown disable-autohide">
                    <a class="topbar-link dropdown-toggle" href="#" data-toggle="dropdown">
                        <span>{{$currency_code}} {{$currency_symbol}}</span>
                    </a>
                    <ul class="dropdown-menu" style="min-width: 160px!important;">
                        @foreach (\App\Model\Currency::where('status', 1)->get() as $key => $currency)
                            <li style="cursor: pointer" class="dropdown-item"
                                onclick="currency_change('{{$currency['code']}}')">
                                {{ $currency->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="topbar-text dropdown d-md-none ml-auto">
                <a class="topbar-link" href="tel: {{$company_phone}}">
                    <i class="fa fa-phone"></i> {{$company_phone}}
                </a>
            </div>
            <div class="d-none d-md-block ml-3 text-nowrap">
                <a class="topbar-link d-none d-md-inline-block" href="tel:{{$company_phone}}">
                    <i class="fa fa-phone"></i> {{$company_phone}}
                </a>
            </div>
        </div>
    </div>
    <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
    <div class="navbar-sticky bg-light mobile-head">
        <div class="navbar navbar-expand-md navbar-light">
            <div class="container ">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand d-none d-sm-block mr-3 flex-shrink-0 tab-logo" href="{{route('home')}}"
                   style="min-width: 7rem;">
                    <img width="250" height="60" style="height: 60px!important;"
                         src="{{asset("storage/app/public/company/$company_web_logo")}}"
                         onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                         alt="{{$company_name}}"/>
                </a>
                <a class="navbar-brand d-sm-none mr-2" href="{{route('home')}}">
                    <img width="100" height="60" style="height: 60px!important;"
                         src="{{asset("storage/app/public/company/$company_mobile_logo")}}"
                         onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                         alt="{{$company_name}}"/>
                </a>
                <!-- Search-->
                <div class="input-group-overlay d-none d-md-block mx-4">
                    <form action="{{route('products')}}" type="submit" class="search_form">
                        <input class="form-control appended-form-control search-bar-input" type="text"
                               autocomplete="off"
                               placeholder="{{trans('messages.search')}}"
                               name="name">
                        <input name="data_from" value="search" hidden>
                        <input name="page" value="1" hidden>
                        <button class="input-group-append-overlay search_button" type="submit"
                                style="border-radius: 0px 7px 7px 0px;">
                            <span class="input-group-text" style="font-size: 20px;">
                                <i class="czi-search text-white"></i>
                            </span>
                        </button>
                        <diV class="card search-card"
                             style="position: absolute;background: white;z-index: 999;width: 100%;display: none">
                            <div class="card-body search-result-box"
                                 style="overflow:scroll; height:400px;overflow-x: hidden"></div>
                        </diV>
                    </form>
                </div>
                <!-- Toolbar-->
                <div class="navbar-toolbar d-flex flex-shrink-0 align-items-center">
                    <a class="navbar-tool navbar-stuck-toggler" href="#">
                        <span class="navbar-tool-tooltip">Expand menu</span>
                        <div class="navbar-tool-icon-box">
                            <i class="navbar-tool-icon czi-menu"></i>
                        </div>
                    </a>
                    <div class="navbar-tool dropdown ml-3">
                        <a class="navbar-tool-icon-box bg-secondary dropdown-toggle" href="{{route('wishlists')}}">
                            <span class="navbar-tool-label">
                                <span
                                    class="countWishlist">{{session()->has('wish_list')?count(session('wish_list')):0}}</span>
                           </span>
                            <i class="navbar-tool-icon czi-heart"></i>
                        </a>
                    </div>
                    @if(auth('customer')->check())
                        <div class="dropdown">
                            <a class="navbar-tool ml-2 mr-2 " type="button" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <div class="navbar-tool-icon-box bg-secondary">
                                    <div class="navbar-tool-icon-box bg-secondary">
                                        <img style="width: 40px;height: 40px"
                                             src="{{asset('storage/app/public/profile/'.auth('customer')->user()->image)}}"
                                             onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                             class="img-profile rounded-circle">
                                    </div>
                                </div>
                                <div class="navbar-tool-text">
                                    <small>Hello, {{auth('customer')->user()->f_name}}</small>
                                    Dashboard
                                </div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item"
                                   href="{{route('account-oder')}}"> {{ trans('messages.my_order')}} </a>
                                <a class="dropdown-item"
                                   href="{{route('user-account')}}"> {{ trans('messages.my_profile')}}</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"
                                   href="{{route('customer.auth.logout')}}">{{ trans('messages.logout')}}</a>
                            </div>
                        </div>
                    @else
                        <div class="dropdown">
                            <a class="navbar-tool ml-3" type="button" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <div class="navbar-tool-icon-box bg-secondary">
                                    <div class="navbar-tool-icon-box bg-secondary">
                                        <i class="navbar-tool-icon czi-user"></i>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('customer.auth.login')}}">
                                    <i class="fa fa-sign-in mr-2"></i> {{trans('messages.sing_in')}}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('customer.auth.register')}}">
                                    <i class="fa fa-user-circle mr-2"></i>{{trans('messages.sing_up')}}
                                </a>
                            </div>
                        </div>
                    @endif
                    <div id="cart_items">
                        @include('layouts.front-end.partials.cart')
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar navbar-expand-md navbar-stuck-menu">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarCollapse">

                    <!-- Search-->
                    <div class="input-group-overlay d-md-none my-3">
                        <form action="{{route('products')}}" type="submit" class="search_form">
                            <input class="form-control appended-form-control search-bar-input-mobile" type="text"
                                   autocomplete="off"
                                   placeholder="{{trans('messages.search')}}" name="name">
                            <input name="data_from" value="search" hidden>
                            <input name="page" value="1" hidden>
                            <button class="input-group-append-overlay search_button" type="submit"
                                    style="border-radius: 0px 7px 7px 0px;">
                            <span class="input-group-text" style="font-size: 20px;">
                                <i class="czi-search text-white"></i>
                            </span>
                            </button>
                            <diV class="card search-card"
                                 style="position: absolute;background: white;z-index: 999;width: 100%;display: none">
                                <div class="card-body search-result-box" id=""
                                     style="overflow:scroll; height:400px;overflow-x: hidden"></div>
                            </diV>
                        </form>
                    </div>

                    @php($categories=\App\CPU\CategoryManager::parents())
                    <ul class="navbar-nav mega-nav pr-2 mr-2 pl-2 d-none d-xl-block "><!--web-->
                        <li class="nav-item {{!request()->is('/')?'dropdown':''}}">
                            <a class="nav-link dropdown-toggle pl-0" href="#" data-toggle="dropdown">
                                <i class="czi-menu align-middle mt-n1 mr-2"></i>
                                <span style="margin-left: 40px !important;margin-right: 50px">
                                    {{ trans('messages.categories')}}
                                </span>
                            </a>
                            @if(request()->is('/'))
                                <ul class="dropdown-menu"
                                    style="display: block!important;margin-top: 7px; box-shadow: none;min-width: 303px !important;margin-left: 1px!important;padding-bottom: 0px!important;">
                                    @foreach($categories as $key=>$category)
                                        @if($key<11)
                                            <li class="dropdown">
                                                <a class="dropdown-item <?php if ($category->childes->count() > 0) echo "dropdown-toggle"?> "
                                                   <?php if ($category->childes->count() > 0) echo "data-toggle='dropdown'"?> href="javascript:"
                                                   onclick="location.href='{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}'">
                                                    <img src="{{asset("storage/app/public/category/$category->icon")}}"
                                                         onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                         style="width: 18px; height: 18px; ">
                                                    <span class="pl-3">{{$category['name']}}</span>
                                                </a>
                                                @if($category->childes->count()>0)
                                                    <ul class="dropdown-menu">
                                                        @foreach($category['childes'] as $subCategory)
                                                            <li class="dropdown">
                                                                <a class="dropdown-item <?php if ($subCategory->childes->count() > 0) echo "dropdown-toggle"?> "
                                                                   <?php if ($subCategory->childes->count() > 0) echo "data-toggle='dropdown'"?> href="javascript:"
                                                                   onclick="location.href='{{route('products',['id'=> $subCategory['id'],'data_from'=>'category','page'=>1])}}'">
                                                                    <span class="pl-3">{{$subCategory['name']}}</span>
                                                                </a>
                                                                @if($subCategory->childes->count()>0)
                                                                    <ul class="dropdown-menu">
                                                                        @foreach($subCategory['childes'] as $subSubCategory)
                                                                            <li>
                                                                                <a class="dropdown-item"
                                                                                   href="{{route('products',['id'=> $subSubCategory['id'],'data_from'=>'category','page'=>1])}}">{{$subSubCategory['name']}}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endif
                                    @endforeach
                                    <a class="dropdown-item" href="{{route('categories')}}" style="left: 29%">
                                        View More
                                    </a>
                                </ul>
                            @else
                                <ul class="dropdown-menu">
                                    @foreach($categories as $category)
                                        <li class="dropdown">
                                            <a class="dropdown-item <?php if ($category->childes->count() > 0) echo "dropdown-toggle"?> "
                                               <?php if ($category->childes->count() > 0) echo "data-toggle='dropdown'"?> href="javascript:"
                                               onclick="location.href='{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}'">
                                                <img src="{{asset("storage/app/public/category/$category->icon")}}"
                                                     onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                     style="width: 18px; height: 18px; ">
                                                <span class="pl-3">{{$category['name']}}</span>
                                            </a>
                                            @if($category->childes->count()>0)
                                                <ul class="dropdown-menu">
                                                    @foreach($category['childes'] as $subCategory)
                                                        <li class="dropdown">
                                                            <a class="dropdown-item <?php if ($subCategory->childes->count() > 0) echo "dropdown-toggle"?> "
                                                               <?php if ($subCategory->childes->count() > 0) echo "data-toggle='dropdown'"?> href="javascript:"
                                                               onclick="location.href='{{route('products',['id'=> $subCategory['id'],'data_from'=>'category','page'=>1])}}'">
                                                                <span class="pl-3">{{$subCategory['name']}}</span>
                                                            </a>
                                                            @if($subCategory->childes->count()>0)
                                                                <ul class="dropdown-menu">
                                                                    @foreach($subCategory['childes'] as $subSubCategory)
                                                                        <li>
                                                                            <a class="dropdown-item"
                                                                               href="{{route('products',['id'=> $subSubCategory['id'],'data_from'=>'category','page'=>1])}}">{{$subSubCategory['name']}}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    </ul>

                    <ul class="navbar-nav mega-nav1 pr-2 pl-2 d-block d-xl-none "><!--mobile-->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle pl-0" href="#" data-toggle="dropdown">
                                <i class="czi-menu align-middle mt-n1 mr-2"></i>
                                <span style="margin-left: 20px !important;">Categories</span>
                            </a>
                            <ul class="dropdown-menu">
                                @foreach($categories as $category)
                                    <li class="dropdown">
                                        <a class="dropdown-item <?php if ($category->childes->count() > 0) echo "dropdown-toggle"?> "
                                           <?php if ($category->childes->count() > 0) echo "data-toggle='dropdown'"?> href="{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}">
                                            <img src="{{asset("storage/app/public/category/$category->icon")}}"
                                                 onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                 style="width: 18px; height: 18px; ">
                                            <span class="pl-3">{{$category['name']}}</span>
                                        </a>
                                        @if($category->childes->count()>0)
                                            <ul class="dropdown-menu">
                                                @foreach($category['childes'] as $subCategory)
                                                    <li class="dropdown">
                                                        <a class="dropdown-item <?php if ($subCategory->childes->count() > 0) echo "dropdown-toggle"?> "
                                                           <?php if ($subCategory->childes->count() > 0) echo "data-toggle='dropdown'"?> href="{{route('products',['id'=> $subCategory['id'],'data_from'=>'category','page'=>1])}}">
                                                            <span class="pl-3">{{$subCategory['name']}}</span>
                                                        </a>
                                                        @if($subCategory->childes->count()>0)
                                                            <ul class="dropdown-menu">
                                                                @foreach($subCategory['childes'] as $subSubCategory)
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                           href="{{route('products',['id'=> $subSubCategory['id'],'data_from'=>'category','page'=>1])}}">{{$subSubCategory['name']}}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                    <!-- Primary menu-->
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown {{request()->is('/')?'active':''}}">
                            <a class="nav-link" href="{{route('home')}}">{{ trans('messages.Home')}}</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#"
                               data-toggle="dropdown">{{ trans('messages.brand') }}</a>
                            <ul class="dropdown-menu scroll-bar">

                                @foreach(\App\CPU\BrandManager::get_brands() as $brand)
                                    <li style="border-bottom: 1px solid #e3e9ef;">
                                        <a class="dropdown-item"
                                           href="{{route('products',['id'=> $brand['id'],'data_from'=>'brand','page'=>1])}}">
                                            {{$brand['name']}}
                                            @if($brand['brand_products_count'] > 0 )
                                                <span class="for-count-value" style="float: right">( {{ $brand['brand_products_count'] }} )</span>
                                            @endif
                                        </a>

                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        @php($seller_registration=\App\Model\BusinessSetting::where(['type'=>'seller_registration'])->first()->value)
                        @if($seller_registration)
                            <li class="nav-item">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            style="color: white;margin-top: 5px;">
                                        <b>{{ trans('messages.Seller')}}  {{ trans('messages.zone')}} </b>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                                         style="min-width: 165px !important;">
                                        <a class="dropdown-item" href="{{route('shop.apply')}}">
                                            <b>{{ trans('messages.Become a')}} {{ trans('messages.Seller')}}</b>
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{route('seller.auth.login')}}">
                                            <b>{{ trans('messages.Seller')}}  {{ trans('messages.login')}} </b>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
