<div id="headerMain" class="d-none">
    <header id="header" style="background-color: #F7F8FA"
            class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-flush navbar-container navbar-bordered">
        <div class="navbar-nav-wrap">
            <div class="navbar-brand-wrapper">
                <!-- Logo -->
                @php($seller_logo=\App\Model\Shop::where(['seller_id'=>auth('seller')->id()])->first()->image)

                <a class="navbar-brand" href="{{route('seller.dashboard.index')}}" aria-label="">
                    <img class="navbar-brand-logo" style="max-height: 42px;"
                         onerror="this.src='{{asset('public/assets/back-end/img/160x160/img1.jpg')}}'"
                         src="{{asset("storage/app/public/shop/$seller_logo")}}" alt="Logo" height="40" width="40">
                    <img class="navbar-brand-logo-mini" style="max-height: 42px;"
                         onerror="this.src='{{asset('public/assets/back-end/img/160x160/img1.jpg')}}'"
                         src="{{asset("storage/app/public/shop/$seller_logo")}}"
                         alt="Logo" height="40" width="40">

                </a>
                <!-- End Logo -->
            </div>

            <div class="navbar-nav-wrap-content-left">
                <!-- Navbar Vertical Toggle -->
                <button type="button" class="js-navbar-vertical-aside-toggle-invoker close mr-3">
                    <i class="tio-first-page navbar-vertical-aside-toggle-short-align" data-toggle="tooltip"
                       data-placement="right" title="Collapse"></i>
                    <i class="tio-last-page navbar-vertical-aside-toggle-full-align"
                       data-template='<div class="tooltip d-none d-sm-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                       data-toggle="tooltip" data-placement="right" title="Expand"></i>
                </button>
                <!-- End Navbar Vertical Toggle -->
                <div class="d-none d-md-block">
                    <form class="position-relative">
                    </form>
                </div>
            </div>


            <!-- Secondary Content -->
            <div class="navbar-nav-wrap-content-right">
                <!-- Navbar -->
                <ul class="navbar-nav align-items-center flex-row">

                    <li class="nav-item d-none d-sm-inline-block">
                        <!-- Notification -->
                        <div class="hs-unfold">
                            <a title="Website Home" class="js-hs-unfold-invoker btn btn-icon btn-ghost-secondary rounded-circle"
                               href="{{route('home')}}" target="_blank">
                                <i class="tio-globe"></i>
                                {{--<span class="btn-status btn-sm-status btn-status-danger"></span>--}}
                            </a>
                        </div>
                        <!-- End Notification -->
                    </li>

                    <li class="nav-item d-none d-sm-inline-block">
                        <!-- Notification -->
                        <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker btn btn-icon btn-ghost-secondary rounded-circle"
                               href="{{route('seller.messages.chat')}}">
                                <i class="tio-email"></i>
                                @php($message=\App\Model\Chatting::where(['seen_by_seller'=>1,'seller_id'=>auth('seller')->id()])->count())
                                @if($message!=0)
                                    <span class="btn-status btn-sm-status btn-status-danger"></span>
                                @endif
                            </a>
                        </div>
                        <!-- End Notification -->
                    </li>

                    <li class="nav-item d-none d-sm-inline-block">
                        <!-- Notification -->
                        <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker btn btn-icon btn-ghost-secondary rounded-circle"
                               href="{{route('seller.orders.list',['pending'])}}">
                                <i class="tio-shopping-cart-outlined"></i>

                            </a>
                        </div>
                        <!-- End Notification -->
                    </li>


                    <li class="nav-item">
                        <!-- Account -->
                        <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker navbar-dropdown-account-wrapper" href="javascript:;"
                               data-hs-unfold-options='{
                                     "target": "#accountNavbarDropdown",
                                     "type": "css-animation"
                                   }'>
                                <div class="avatar avatar-sm avatar-circle">
                                    {{-- <img src="{{asset('storage/app/public/seller/'.auth('seller')->user()->image)}}"  onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'" class="img-profile rounded-circle"> --}}
                                    <img class="avatar-img"
                                         onerror="this.src='{{asset('public/assets/back-end/img/160x160/img1.jpg')}}'"
                                         src="{{asset('storage/app/public/seller/')}}/{{auth('seller')->user()->image}}"
                                         alt="Image Description">
                                    <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                                </div>
                            </a>

                            <div id="accountNavbarDropdown"
                                 class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right navbar-dropdown-menu navbar-dropdown-account"
                                 style="width: 16rem;">
                                <div class="dropdown-item-text">
                                    <div class="media align-items-center">
                                        <div class="avatar avatar-sm avatar-circle mr-2">
                                            {{-- <img src="{{asset('storage/app/public/seller/'.auth('seller')->user()->image)}}"  onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'" class="img-profile rounded-circle"> --}}
                                            <img class="avatar-img"
                                                 onerror="this.src='{{asset('public/assets/back-end/img/160x160/img1.jpg')}}'"
                                                 src="{{asset('storage/app/public/seller/')}}/{{auth('seller')->user()->image}}"
                                                 alt="Image Description">
                                        </div>
                                        <div class="media-body">
                                            <span class="card-title h5">{{auth('seller')->user()->f_name}}</span>

                                            <span class="card-text">{{auth('seller')->user()->email}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item"
                                   href="{{route('seller.profile.update',auth('seller')->user()->id)}}">
                                    <span class="text-truncate pr-2" title="Settings">Settings</span>
                                </a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="javascript:" onclick="Swal.fire({
                                    title: 'Do you want to logout?',
                                    showDenyButton: true,
                                    showCancelButton: true,
                                    confirmButtonColor: '#377dff',
                                    cancelButtonColor: '#363636',
                                    confirmButtonText: `Yes`,
                                    denyButtonText: `Don't Logout`,
                                    }).then((result) => {
                                    if (result.value) {
                                    location.href='{{route('seller.auth.logout')}}';
                                    } else{
                                    Swal.fire('Canceled', '', 'info')
                                    }
                                    })">
                                    <span class="text-truncate pr-2" title="Sign out">Sign out</span>
                                </a>
                            </div>
                        </div>
                        <!-- End Account -->
                    </li>
                </ul>
                <!-- End Navbar -->
            </div>
            <!-- End Secondary Content -->
        </div>
    </header>
</div>
<div id="headerFluid" class="d-none"></div>
<div id="headerDouble" class="d-none"></div>
