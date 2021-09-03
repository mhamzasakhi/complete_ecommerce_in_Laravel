<div id="sidebarMain" class="d-none">
    <aside style="background: #EEEEEE!important;"
        class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered  ">
        <div class="navbar-vertical-container">
            <div class="navbar-vertical-footer-offset pb-0">
                <div class="navbar-brand-wrapper justify-content-between">
                    <!-- Logo -->

                    @php($e_commerce_logo=\App\Model\BusinessSetting::where(['type'=>'company_web_logo'])->first()->value)
                    <a class="navbar-brand" href="{{route('admin.dashboard.index')}}" aria-label="Front">
                        <img style="max-height: 38px"
                             onerror="this.src='{{asset('public/assets/back-end/img/900x400/img1.jpg')}}'"
                             class="navbar-brand-logo-mini for-web-logo"
                             src="{{asset("storage/app/public/company/$e_commerce_logo")}}" alt="Logo">
                    </a>

                    <!-- End Logo -->

                    <!-- Navbar Vertical Toggle -->
                    <button type="button"
                            class="js-navbar-vertical-aside-toggle-invoker navbar-vertical-aside-toggle btn btn-icon btn-xs btn-ghost-dark">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                    <!-- End Navbar Vertical Toggle -->
                </div>

                <!-- Content -->
                <div class="navbar-vertical-content">
                    <ul class="navbar-nav navbar-nav-lg nav-tabs">
                        <!-- Dashboards -->
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin')?'show':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="{{route('admin.dashboard.index')}}" title="Dashboards">
                                <i class="tio-home-vs-1-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{trans('messages.Dashboard')}}
                                </span>
                            </a>
                        </li>
                        <!-- End Dashboards -->


                        <li class="nav-item">
                            <small class="nav-subtitle" title="Pages">{{trans('messages.order_management')}}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>

                        <!-- Order -->
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin/orders*')?'active':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:">
                                <i class="tio-shopping-cart nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{trans('messages.Order')}}
                                </span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                style="display: {{Request::is('admin/order*')?'block':'none'}}">
                                <li class="nav-item {{Request::is('admin/orders/list/all')?'active':''}}">
                                    <a class="nav-link" href="{{route('admin.orders.list',['all'])}}" title="">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{trans('messages.All')}}
                                            <span class="badge badge-info badge-pill ml-1">
                                                {{\App\Model\Order::count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item {{Request::is('admin/orders/list/pending')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.orders.list',['pending'])}}" title="">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{trans('messages.pending')}}
                                            <span class="badge badge-soft-info badge-pill ml-1">
                                                {{\App\Model\Order::where(['order_status'=>'pending'])->count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item {{Request::is('admin/orders/list/confirmed')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.orders.list',['confirmed'])}}" title="">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{trans('messages.confirmed')}}
                                                <span class="badge badge-soft-success badge-pill ml-1">
                                                {{\App\Model\Order::where(['order_status'=>'confirmed'])->count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item {{Request::is('admin/orders/list/processing')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.orders.list',['processing'])}}" title="">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{trans('messages.Processing')}}
                                                <span class="badge badge-warning badge-pill ml-1">
                                                {{\App\Model\Order::where(['order_status'=>'processing'])->count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item {{Request::is('admin/orders/list/out_for_delivery')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.orders.list',['out_for_delivery'])}}"
                                       title="">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{trans('messages.out_for_delivery')}}
                                                <span class="badge badge-warning badge-pill ml-1">
                                                {{\App\Model\Order::where(['order_status'=>'out_for_delivery'])->count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item {{Request::is('admin/orders/list/delivered')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.orders.list',['delivered'])}}" title="">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{trans('messages.delivered')}}
                                                <span class="badge badge-success badge-pill ml-1">
                                                {{\App\Model\Order::where(['order_status'=>'delivered'])->count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item {{Request::is('admin/orders/list/returned')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.orders.list',['returned'])}}" title="">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{trans('messages.returned')}}
                                                <span class="badge badge-soft-danger badge-pill ml-1">
                                                {{\App\Model\Order::where(['order_status'=>'returned'])->count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item {{Request::is('admin/orders/list/failed')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.orders.list',['failed'])}}" title="">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{trans('messages.failed')}}
                                            <span class="badge badge-danger badge-pill ml-1">
                                                {{\App\Model\Order::where(['order_status'=>'failed'])->count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>

                                <li class="nav-item {{Request::is('admin/orders/list/canceled')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.orders.list',['canceled'])}}" title="">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{trans('messages.canceled')}}
                                                <span class="badge badge-soft-dark badge-pill ml-1">
                                                {{\App\Model\Order::where(['order_status'=>'canceled'])->count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- End Order -->


                        <li class="nav-item">
                            <small class="nav-subtitle" title="Pages">{{trans('messages.product_management')}}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>

                        <!-- Pages -->
                        @if(\App\CPU\Helpers::module_permission_check('brand'))

                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/brand*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:"
                                   title="Pages">
                                    <i class="tio-flag nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{trans('messages.Brand')}}</span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{Request::is('admin/brand*')?'block':'none'}}">
                                    <li class="nav-item {{Request::is('admin/brand/add-new')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.brand.add-new')}}"
                                           title="add new brand">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.add_new')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/brand/list')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.brand.list')}}" title=" brand list">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.List')}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if(\App\CPU\Helpers::module_permission_check('banner'))

                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/banner*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="{{route('admin.banner.list')}}"
                                   title="Pages">
                                    <i class="tio-image nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{trans('messages.Banner')}}</span>
                                </a>
                            </li>

                        @endif
                        @if(\App\CPU\Helpers::module_permission_check('category'))
                            <li class="navbar-vertical-aside-has-menu {{(Request::is('admin/category*') ||Request::is('admin/sub*')) ?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:"
                                   title="Pages">
                                    <i class="tio-star-outlined nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{trans('messages.category')}}</span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{(Request::is('admin/category*') ||Request::is('admin/sub*'))?'block':''}}">

                                    <li class="nav-item {{Request::is('admin/category/view')?'active':''}}">


                                        <a class="nav-link " href="{{route('admin.category.view')}}"
                                           title="add new category">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.category')}}</span>
                                        </a>

                                    </li>
                                    <li class="nav-item {{Request::is('admin/sub-category/view')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.sub-category.view')}}"
                                           title="add new sub-category">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.sub_category')}}</span>
                                        </a>


                                    </li>
                                    <li class="nav-item {{Request::is('admin/sub-sub-category/view')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.sub-sub-category.view')}}"
                                           title="add new sub-sub-category">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.sub_sub_category')}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if(\App\CPU\Helpers::module_permission_check('product'))

                            <li class="navbar-vertical-aside-has-menu {{(Request::is('admin/attribute*') || Request::is('admin/product*'))?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:"
                                   title="Pages">
                                    <i class="tio-premium-outlined nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{trans('messages.Products')}}  </span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{(Request::is('admin/attribute*') || Request::is('admin/product*'))?'block':''}}">
                                    <li class="nav-item {{Request::is('admin/attribute/view')?'active':''}}">

                                        @if(\App\CPU\Helpers::module_permission_check('attribute'))
                                            <a class="nav-link " href="{{route('admin.attribute.view')}}"
                                               title="add attribute ">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span class="text-truncate">{{trans('messages.Attribute')}}</span>
                                            </a>
                                        @endif
                                    </li>
                                    <li class="nav-item {{Request::is('admin/product/list/in_house')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.product.list',['in_house'])}}"
                                           title="InHouse Products">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.InHouse Products')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/product/list/seller')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.product.list',['seller'])}}"
                                           title="Seller Products">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.Seller Products')}}</span>
                                        </a>
                                    </li>

                                    <li class="nav-item {{Request::is('admin/product/bulk-import')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.product.bulk-import')}}"
                                           title="add new brand">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.bulk_import')}}</span>
                                        </a>
                                    </li>

                                    <li class="nav-item {{Request::is('admin/product/bulk-export')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.product.bulk-export')}}"
                                           title="add new brand">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.bulk_export')}}</span>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        @endif


                        @if(\App\CPU\Helpers::module_permission_check('employee'))
                            <li class="nav-item">
                                <small class="nav-subtitle"
                                       title="Layouts">{{trans('messages.employee_handle')}}</small>
                                <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                            </li>
                            <!-- Nav Item - Pages Collapse Menu -->
                            @if(\App\CPU\Helpers::module_permission_check('custom_role'))
                                <li class="navbar-vertical-aside-has-menu {{Request::is('admin/custom-role*')?'active':''}}">
                                    <a class="js-navbar-vertical-aside-menu-link nav-link"
                                       href="{{route('admin.custom-role.create')}}"
                                       title="Pages">
                                        <i class="tio-incognito nav-icon"></i>
                                        <span
                                            class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{trans('messages.role_management')}}</span>
                                    </a>
                                </li>
                                <li class="navbar-vertical-aside-has-menu {{Request::is('admin/employee*')?'active':''}}">
                                    <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                       href="javascript:"
                                       title="Pages">
                                        <i class="tio-user nav-icon"></i>
                                        <span
                                            class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{trans('messages.Employee')}}</span>
                                    </a>
                                    <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                        style="display: {{Request::is('admin/employee*')?'block':'none'}}">
                                        <li class="nav-item {{Request::is('admin/employee/add-new')?'active':''}}">
                                            <a class="nav-link " href="{{route('admin.employee.add-new')}}"
                                               title="add new employee">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span class="text-truncate">{{trans('messages.add_new')}}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item {{Request::is('admin/employee/list')?'active':''}}">
                                            <a class="nav-link " href="{{route('admin.employee.list')}}"
                                               title=" employee List">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span class="text-truncate">{{trans('messages.List')}}</span>
                                            </a>
                                        </li>

                                    </ul>
                                </li>

                            @endif
                        @endif
                        {{--to do--}}
                        @if(\App\CPU\Helpers::module_permission_check('seller'))
                            <li class="nav-item">
                                <small class="nav-subtitle"
                                       title="Layouts">    {{trans('messages.seller_section')}}</small>
                                <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                            </li>


                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/seller*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:"
                                   title="Pages">
                                    <i class="tio-users-switch nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{trans('messages.Sellers')}}</span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{Request::is('admin/seller*')?'block':'none'}}">
                                    <li class="nav-item {{Request::is('admin/sellers/seller-list')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.sellers.seller-list')}}"
                                           title="add new  seller list">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.seller_list')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/sellers/withdraw_list')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.sellers.withdraw_list')}}"
                                           title="add new  seller list">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span
                                                class="text-truncate">{{trans('messages.Withdraw')}} {{trans('messages.List')}}</span>
                                        </a>
                                    </li>


                                </ul>
                            </li>

                        @endif

                        @if(\App\CPU\Helpers::module_permission_check('deal'))
                            <li class="nav-item">
                                <small class="nav-subtitle"
                                       title="Layouts">    {{trans('messages.deal_management')}}</small>
                                <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                            </li>


                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/deal*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:"
                                   title="Pages">
                                    <i class="tio-image nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{trans('messages.all_deals')}}</span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{Request::is('admin/deal*')?'block':'none'}}">
                                    <li class="nav-item {{Request::is('admin/deal/flash')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.deal.flash')}}"
                                           title="add new flash deal">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.flash_deal')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/deal/day')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.deal.day')}}" title=" deal List">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.deal_of_the_day')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/deal/feature')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.deal.feature')}}" title=" deal List">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.feature_deal')}}</span>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        @endif



                    <!-- End Pages -->
                        @if(\App\CPU\Helpers::module_permission_check('customerList'))
                            <li class="nav-item">
                                <small class="nav-subtitle" title="Layouts">{{trans('messages.business_management')}}
                                </small>
                                <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                            </li>
                            <li class="nav-item {{Request::is('admin/customer/list')?'active':''}}">
                                <a class="nav-link " href="{{route('admin.customer.list')}}"
                                   title="customer base">
                                    <span class="tio-poi-user nav-icon"></span>
                                    <span
                                        class="text-truncate">{{trans('messages.Customer')}}  {{trans('messages.List')}}  </span>
                                </a>
                            </li>
                        @endif
                        @if(\App\CPU\Helpers::module_permission_check('productReview'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/reviews*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="{{route('admin.reviews.list')}}"
                                   title="Pages">
                                    <i class="tio-star nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{trans('messages.Product')}} {{trans('messages.Reviews')}}
                                </span>
                                </a>
                            </li>
                        @endif
                    <!-- Pages -->
                        @if(\App\CPU\Helpers::module_permission_check('messages'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/contact*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="{{route('admin.contact.list')}}"
                                   title="Pages">
                                    <i class="tio-messages nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{trans('messages.customer_message')}}
                                </span>
                                </a>
                            </li>

                        @endif
                    <!-- End Pages -->

                        @if(\App\CPU\Helpers::module_permission_check('messages'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/support-ticket*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="{{route('admin.support-ticket.view')}}"
                                   title="Pages">
                                    <i class="tio-chat nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{trans('messages.support_ticket')}}
                                </span>
                                </a>
                            </li>

                        @endif
                        @if(\App\CPU\Helpers::module_permission_check('notification'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/notification*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="{{route('admin.notification.add-new')}}"
                                   title="Pages">
                                    <i class="tio-notifications nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                        {{trans('messages.Send')}} {{trans('messages.Notification')}}
                                    </span>
                                </a>
                            </li>
                        @endif



                    <!-- Pages -->
                        @if(\App\CPU\Helpers::module_permission_check('coupon'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/coupon*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="{{route('admin.coupon.add-new')}}"
                                   title="Pages">
                                    <i class="tio-gift nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{trans('messages.Coupon')}}</span>
                                </a>
                            </li>

                        @endif
                    <!-- End Pages -->

                        @if(\App\CPU\Helpers::module_permission_check('business_settings'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/business-settings*')||Request::is('admin/currency*')|| Request::is('admin/helpTopic*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:"
                                   title="Pages">
                                    <i class="tio-settings nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{trans('messages.business_settings')}}</span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{Request::is('admin/business-settings*')|| Request::is('admin/currency*') || Request::is('admin/helpTopic*') ?'block':'none'}}">
                                    <li class="nav-item {{Request::is('admin/business-settings/language')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.business-settings.language.index')}}"
                                           title="add new  language">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.Language')}} ( Web )</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/business-settings/language-app')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.business-settings.language.index-app')}}"
                                           title="add new  language">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.Language')}} ( App )</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/business-settings/mail')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.business-settings.mail.index')}}"
                                           title=" mail config">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.mail_config')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/business-settings/shipping-method/by/admin')?'active':''}}">
                                        <a class="nav-link"
                                           href="{{route('admin.business-settings.shipping-method.by.admin')}}"
                                           title=" shippitng method">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                              {{trans('messages.Admin')}} {{trans('messages.shipping_method')}}
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/business-settings/shipping-method/by/seller')?'active':''}}">
                                        <a class="nav-link"
                                           href="{{route('admin.business-settings.shipping-method.by.seller')}}"
                                           title=" shippitng method">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                               {{trans('messages.Seller')}} {{trans('messages.shipping_method')}}
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/currency/view')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.currency.view')}}"
                                           title="add new currency">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.Currency')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/business-settings/payment-method')?'active':''}}">
                                        <a class="nav-link "
                                           href="{{route('admin.business-settings.payment-method.index')}}"
                                           title="add new payment method">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.payment_method')}}</span>
                                        </a>
                                    </li>
                                    {{--<a class="collapse-item {{Request::is('admin/business-settings/sms*')?'active':''}}"
                                          href="{{route('admin.business-settings.sms-gateway.index')}}">{{trans('messages.sms_gateway')}}</a>--}}

                                    <li class="nav-item {{Request::is('admin/helpTopic/list')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.helpTopic.list')}}"
                                           title="add new Faq">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.faq')}}</span>
                                        </a>
                                    </li>

                                    <li class="nav-item {{Request::is('admin/business-settings/about-us')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.business-settings.about-us')}}"
                                           title="add new about us">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.about_us')}}</span>
                                        </a>
                                    </li>

                                    <li class="nav-item {{Request::is('admin/business-settings/terms-condition')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.business-settings.terms-condition')}}"
                                           title="add new about us">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.terms_and_condition')}}</span>
                                        </a>
                                    </li>

                                    <li class="nav-item {{Request::is('admin/business-settings/privacy-policy')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.business-settings.privacy-policy')}}"
                                           title="add new about us">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.privacy_policy')}}</span>
                                        </a>
                                    </li>

                                    <li class="nav-item {{Request::is('admin/business-settings/web-config')?'active':''}}">
                                        <a class="nav-link "
                                           href="{{route('admin.business-settings.web-config.index')}}"
                                           title="change web config">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.web_config')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/business-settings/fcm-index')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.business-settings.fcm-index')}}"
                                           title="add new banner">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">Push Notification</span>
                                        </a>
                                    </li>

                                    <li class="nav-item {{Request::is('admin/business-settings/social-media')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.business-settings.social-media')}}"
                                           title="change social media">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.social_media')}}</span>
                                        </a>
                                    </li>

                                    <li class="nav-item {{Request::is('admin/business-settings/seller-settings*')?'active':''}}">
                                        <a class="nav-link "
                                           href="{{route('admin.business-settings.seller-settings.index')}}"
                                           title="change seller settings">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.seller_settings')}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @if(\App\CPU\Helpers::module_permission_check('report'))
                            <li class="nav-item">
                                <div class="nav-divider"></div>
                            </li>

                            <li class="nav-item">
                                <small class="nav-subtitle" title="Documentation">{{trans('messages.Report')}}
                                    & {{trans('messages.Analytics')}}  </small>
                                <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                            </li>

                            <!-- Pages -->
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/report*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:"
                                   title="Pages">
                                    <i class="tio-report-outlined nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{trans('messages.Report')}}</span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{Request::is('admin/report*')?'block':'none'}}">
                                    <li class="nav-item {{Request::is('admin/report/earning')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.report.earning')}}"
                                           title="add new banner">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span
                                                class="text-truncate">{{trans('messages.Earning')}} {{trans('messages.Report')}} </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/report/order')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.report.order')}}"
                                           title="add new banner">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span
                                                class="text-truncate">{{trans('messages.Order')}} {{trans('messages.Report')}} </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/report/inhoue-product-sale')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.report.inhoue-product-sale')}}"
                                           title="add new banner">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span
                                                class="text-truncate">{{trans('messages.inhouse')}} {{trans('messages.product')}} {{trans('messages.sale')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/report/seller-product-sale')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.report.seller-product-sale')}}"
                                           title="add new banner">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span
                                                class="text-truncate text-capitalize">{{trans('messages.seller')}} {{trans('messages.product')}} {{trans('messages.sale')}}</span>
                                        </a>
                                    </li>

                                    <li class="nav-item {{Request::is('admin/report/product-stock')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.report.product-stock')}}"
                                           title="add new banner">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span
                                                class="text-truncate"> {{trans('messages.product')}} {{trans('messages.stock')}}</span>
                                        </a>
                                    </li>

                                    <li class="nav-item {{Request::is('admin/report/product-in-wishlist')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.report.product-in-wishlist')}}"
                                           title="add new banner">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span
                                                class="text-truncate"> {{trans('messages.product')}} {{trans('messages.in')}}  {{trans('messages.wish_list')}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- End Pages -->
                        @endif
                        <li class="nav-item" style="padding-top: 100px">
                            <div class="nav-divider"></div>
                        </li>
                    </ul>
                </div>
                <!-- End Content -->
            </div>
        </div>
    </aside>
</div>
