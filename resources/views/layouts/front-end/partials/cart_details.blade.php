<div class="feature_header">
    <span>{{ trans('messages.shopping_cart')}}</span>
</div>
<!-- Grid-->
<hr class="view_border">

<div class="row">
    <!-- List of items-->
    <section class="col-lg-8">
        <div class="cart_information">
            @if(session()->has('cart') && count( session()->get('cart')) > 0)
                @foreach(session()->get('cart') as $key => $cartItem)
                    <div class="cart_item mb-2">
                        <div class="row">
                            <div class="col-md-7 col-sm-6 col-9 d-flex align-items-center">
                                <div class="media">
                                    <div
                                        class="media-header d-flex justify-content-center align-items-center mr-2">
                                        <a href="{{route('product',$cartItem['slug'])}}">
                                            <img style="height: 82px;"
                                                 onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                 src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$cartItem['thumbnail']}}"
                                                 alt="Product">
                                        </a>
                                    </div>

                                    <div class="media-body d-flex justify-content-center align-items-center">
                                        <div class="cart_product">
                                            <div class="product-title">
                                                <a href="{{route('product',$cartItem['slug'])}}">{{$cartItem['name']}}</a>
                                            </div>
                                            <div
                                                class=" text-accent">{{ \App\CPU\Helpers::currency_converter($cartItem['price']-$cartItem['discount']) }}</div>
                                            @if($cartItem['discount'] > 0)
                                                <strike style="font-size: 12px!important;color: grey!important;">
                                                    {{\App\CPU\Helpers::currency_converter($cartItem['price'])}}
                                                </strike>
                                            @endif
                                            @foreach($cartItem['variations'] as $key1 =>$variation)
                                                <div class="text-muted"><span
                                                        class="mr-2">{{$key1}} :</span>{{$variation}}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 col-sm-2 col-3 d-flex align-items-center">
                                <div>
                                    <select name="quantity[{{ $key }}]" id="cartQuantity{{$key}}"
                                            onchange="updateCartQuantity('{{$key}}')">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option
                                                value="{{$i}}" <?php if ($cartItem['quantity'] == $i) echo "selected"?>>
                                                {{$i}}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div
                                class="col-md-4 col-sm-4 offset-4 offset-sm-0 text-center d-flex justify-content-between align-items-center">
                                <div class="">
                                    <div class=" text-accent">
                                        {{ \App\CPU\Helpers::currency_converter(($cartItem['price']-$cartItem['discount'])*$cartItem['quantity']) }}
                                    </div>
                                </div>
                                <div style="margin-top: 3px;">
                                    <button class="btn btn-link px-0 text-danger"
                                            onclick="removeFromCart({{ $key }})" type="button"><i
                                            class="czi-close-circle mr-2"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="d-flex justify-content-center align-items-center">
                    <h4 class="text-danger">Cart Empty</h4>
                </div>
            @endif
        </div>
        <div class="row pt-2">
            <div class="col-12">
                <select class="form-control" id="shipping_method_id" onchange="set_shipping_id(this.value)">
                    <option value="0">Choose Shipping Method</option>
                    @foreach(\App\Model\ShippingMethod::where(['status'=>1])->get() as $shipping)
                        <option
                            value="{{$shipping['id']}}" {{session()->has('shipping_method_id')?session('shipping_method_id')==$shipping['id']?'selected':'':''}}>
                            {{$shipping['title'].' ( '.$shipping['duration'].' ) '.\App\CPU\Helpers::currency_converter($shipping['cost'])}}
                        </option>
                    @endforeach
                </select>
                <br>
            </div>

            <div class="col-6">
                <a href="{{route('home')}}" class="btn btn-primary">
                    <i class="fa fa-backward"></i> Continue Shopping
                </a>
            </div>

            <div class="col-6">
                <a href="{{route('checkout-details')}}" class="btn btn-primary pull-right">
                    Checkout <i class="fa fa-forward"></i>
                </a>
            </div>
        </div>
    </section>
    <!-- Sidebar-->
    @include('web-views.partials._order-summary')
</div>


<script>
    cartQuantityInitialize();

    function set_shipping_id(id) {
        @foreach(session()->get('cart') as $key => $item)
        let key = '{{$key}}';
        @break
        @endforeach
        $.get({
            url: '{{url('/')}}/customer/set-shipping-method',
            dataType: 'json',
            data: {
                id: id,
                key: key
            },
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (data) {
                if (data.status == 1) {
                    toastr.success('Shipping method selected', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    setInterval(function () {
                        location.reload();
                    }, 2000);
                } else {
                    toastr.error('Choose proper shipping method.', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            },
            complete: function () {
                $('#loading').hide();
            },
        });
    }
</script>
