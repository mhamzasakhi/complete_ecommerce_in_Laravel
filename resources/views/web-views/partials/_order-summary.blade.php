<style>
    .cart_total {
        background: #FFFFFF 0% 0% no-repeat padding-box;
        box-shadow: 0px 3px 6px #00000029;
        border-radius: 3px;
        padding: 16px;
    }

    .cart_title {
        font-weight: 400 !important;
        font-size: 16px;
    }

    .cart_value {
        font-weight: 600 !important;
        font-size: 16px;
    }

    .cart_total_value {
        font-weight: 700 !important;
        font-size: 25px !important;
        color: {{$web_config['primary_color']}}   !important;
    }

    . .deal-title {
        font-size: 12px;
    }
</style>

<aside class="col-lg-4 pt-4 pt-lg-0">
    <div class="cart_total">
        @php($sub_total=0)
        @php($total_tax=0)
        @php($total_shipping_cost=0)
        @php($total_discount_on_product=0)
        @if(session()->has('cart') && count( session()->get('cart')) > 0)
            @foreach(session('cart') as $key => $cartItem)
                {{--<div class="d-flex justify-content-between">
                    <span class="cart_title">{{$cartItem['name']}}</span>
                    <span
                        class="cart_value">{{\App\CPU\Helpers::currency_converter($cartItem['price']*$cartItem['quantity'])}}</span>
                </div>--}}
                @php($sub_total+=$cartItem['price']*$cartItem['quantity'])
                @php($total_tax+=$cartItem['tax']*$cartItem['quantity'])
                @php($total_shipping_cost+=$cartItem['shipping_cost'])
                @php($total_discount_on_product+=$cartItem['discount']*$cartItem['quantity'])
            @endforeach
        @else
            <span>Empty Cart</span>
        @endif
        <div class="d-flex justify-content-between">
            <span class="cart_title">Sub Total</span>
            <span class="cart_value">
                {{\App\CPU\Helpers::currency_converter($sub_total)}}
            </span>
        </div>
        <div class="d-flex justify-content-between">
            <span class="cart_title">Tax</span>
            <span class="cart_value">
                {{\App\CPU\Helpers::currency_converter($total_tax)}}
            </span>
        </div>
        <div class="d-flex justify-content-between">
            <span class="cart_title">Shipping</span>
            <span class="cart_value">
                {{\App\CPU\Helpers::currency_converter($total_shipping_cost)}}
            </span>
        </div>
        <div class="d-flex justify-content-between">
            <span class="cart_title">Discount on Product</span>
            <span class="cart_value">
                - {{\App\CPU\Helpers::currency_converter($total_discount_on_product)}}
            </span>
        </div>
        @if(session()->has('coupon_discount'))
            <div class="d-flex justify-content-between">
                <span class="cart_title">Coupon Discount</span>
                <span class="cart_value" id="coupon-discount-amount">
                    - {{session()->has('coupon_discount')?\App\CPU\Helpers::currency_converter(session('coupon_discount')):0}}
                </span>
            </div>
            @php($coupon_dis=session('coupon_discount'))
        @else
            <div class="mt-2">
                <form class="needs-validation" method="post" novalidate id="coupon-code-ajax">
                    <div class="form-group">
                        <input class="form-control input_code" type="text" name="code" placeholder="Coupon code"
                               required>
                        <div class="invalid-feedback">Please provide coupon code.</div>
                    </div>
                    <button class="btn btn-primary btn-block" type="button" onclick="couponCode()">Apply Code
                    </button>
                </form>
            </div>
            @php($coupon_dis=0)
        @endif
        <hr class="mt-2 mb-2">
        <div class="d-flex justify-content-between">
            <span class="cart_title">Total</span>
            <span class="cart_value">
               {{\App\CPU\Helpers::currency_converter($sub_total+$total_tax+$total_shipping_cost-$coupon_dis-$total_discount_on_product)}}
            </span>
        </div>

        <div class="d-flex justify-content-center">
            <span class="cart_total_value mt-2">
                {{\App\CPU\Helpers::currency_converter($sub_total+$total_tax+$total_shipping_cost-$coupon_dis-$total_discount_on_product)}}
            </span>
        </div>
    </div>
    <div class="container mt-3">
        <div class="row p-0">
            <div class="col-md-3 p-0 text-center mobile-padding">
                <img style="height: 29px;" src="{{asset("storage/app/public/png/delivery.png")}}" alt="">
                <div class="deal-title">3 Days <br><span>Fast Delivery</span></div>
            </div>

            <div class="col-md-3 p-0 text-center">
                <img style="height: 29px;" src="{{asset("storage/app/public/png/money.png")}}" alt="">
                <div class="deal-title">Money Back <br><span>Gurrantey</span></div>
            </div>
            <div class="col-md-3 p-0 text-center">
                <img style="height: 29px;" src="{{asset("storage/app/public/png/Genuine.png")}}" alt="">
                <div class="deal-title">100% Genuine<br><span>Product</span></div>
            </div>
            <div class="col-md-3 p-0 text-center">
                <img style="height: 29px;" src="{{asset("storage/app/public/png/Payment.png")}}" alt="">
                <div class="deal-title">Authentic<br><span>Payment</span></div>
            </div>
        </div>
    </div>
</aside>
