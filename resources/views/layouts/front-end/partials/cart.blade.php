{{--code improved Md. Al imrun Khandakar--}}
<div class="navbar-tool dropdown ml-3" style="margin-right: 6px">
    <a class="navbar-tool-icon-box bg-secondary dropdown-toggle" href="{{route('shop-cart')}}">
        <span class="navbar-tool-label">
            {{session()->has('cart')?count(session()->get('cart')):0}}
        </span>
        <i class="navbar-tool-icon czi-cart"></i>
    </a>
    <a class="navbar-tool-text" href="{{route('shop-cart')}}"><small>{{trans('messages.my_cart')}}</small>
        {{\App\CPU\Helpers::currency_converter(\App\CPU\CartManager::cart_total_applied_discount(session()->get('cart')))}}
    </a>
    <!-- Cart dropdown-->
    <div class="dropdown-menu dropdown-menu-right" style="width: 20rem;">
        <div class="widget widget-cart px-3 pt-2 pb-3">
            @if(session()->has('cart') && count( session()->get('cart')) > 0)
                <div style="height: 15rem;" data-simplebar data-simplebar-auto-hide="false">
                    @php($sub_total=0)
                    @php($total_tax=0)
                    @foreach(session('cart') as $key => $cartItem)
                        <div class="widget-cart-item pb-2">
                            <button class="close text-danger " type="button" onclick="removeFromCart({{ $key }})"
                                    aria-label="Remove"><span
                                    aria-hidden="true">&times;</span>
                            </button>
                            <div class="media align-items-center">
                                <a class="d-block mr-2"
                                   href="{{route('product',$cartItem['slug'])}}">
                                    <img width="64"
                                         onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                         src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$cartItem['thumbnail']}}"
                                         alt="Product"/>
                                </a>
                                <div class="media-body">
                                    <h6 class="widget-product-title">
                                        <a href="{{route('product',$cartItem['slug'])}}">{{$cartItem['name']}}</a></h6>
                                    @foreach($cartItem['variations'] as $key =>$variation)
                                        <span style="font-size: 14px">{{$key}} : {{$variation}}</span><br>
                                    @endforeach
                                    <div class="widget-product-meta">
                                        <span class="text-muted mr-2">x {{$cartItem['quantity']}}</span>
                                        <span class="text-accent mr-2">
                                                {{\App\CPU\Helpers::currency_converter(($cartItem['price']-$cartItem['discount'])*$cartItem['quantity'])}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php($sub_total+=($cartItem['price']-$cartItem['discount'])*$cartItem['quantity'])
                        @php($total_tax+=$cartItem['tax']*$cartItem['quantity'])
                    @endforeach
                </div>
                <hr>
                <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
                    <div class="font-size-sm mr-2 py-2 float-right">
                        <span class="">Subtotal :</span>
                        <span class="text-accent font-size-base ml-1">
                             {{\App\CPU\Helpers::currency_converter($sub_total)}}
                        </span>
                    </div>

                    <a class="btn btn-outline-secondary btn-sm" href="{{route('shop-cart')}}">
                        Expand cart<i class="czi-arrow-right ml-1 mr-n1"></i>
                    </a>
                </div>
                <a class="btn btn-primary btn-sm btn-block" href="{{route('checkout-details')}}">
                    <i class="czi-card mr-2 font-size-base align-middle"></i>Checkout
                </a>
            @else
                <div class="widget-cart-item">
                    <h6 class="text-danger text-center"><i class="fa fa-cart-arrow-down"></i> {{trans('messages.Empty')}} {{trans('messages.Cart')}} </h6>
                </div>
            @endif
        </div>
    </div>
</div>
{{--code improved Md. Al imrun Khandakar--}}
{{--to do discount--}}
