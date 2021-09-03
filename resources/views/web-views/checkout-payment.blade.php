@extends('layouts.front-end.app')

@section('title','Choose Payment Method')

@push('css_or_js')
    <style>
        .stripe-button-el {
            display: none !important;
        }

        .razorpay-payment-button {
            display: none !important;
        }
    </style>

    {{--stripe--}}
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
    <script src="https://js.stripe.com/v3/"></script>
    {{--stripe--}}

@endpush

@section('content')
    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-4">
        <div class="row">
            <div class="col-md-12 mb-5 pt-5">
                <div class="feature_header" style="background: #dcdcdc;line-height: 1px">
                    <span>{{ trans('messages.payment_method')}}</span>
                </div>
            </div>
            <section class="col-lg-8">
                <hr>
                <div class="checkout_details mt-3">
                @include('web-views.partials._checkout-steps',['step'=>3])
                <!-- Payment methods accordion-->
                    <h2 class="h6 pb-3 mb-2 mt-5">{{trans('messages.choose_payment')}}</h2>

                    <div class="row">
                        @php($config=\App\CPU\Helpers::get_business_settings('cash_on_delivery'))
                        @if($config['status'])
                            <div class="col-md-6 mb-4" style="cursor: pointer">
                                <div class="card">
                                    <div class="card-body" style="height: 100px">
                                        <a class="btn btn-block"
                                           href="{{route('checkout-complete',['payment_method'=>'cash_on_delivery'])}}">
                                            <img width="150" style="margin-top: -10px"
                                                 src="{{asset('public/assets/front-end/img/cod.png')}}"/>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @php($config=\App\CPU\Helpers::get_business_settings('ssl_commerz_payment'))
                        @if($config['status'])
                            <div class="col-md-6 mb-4" style="cursor: pointer">
                                <div class="card">
                                    <div class="card-body" style="height: 100px">
                                        <form action="{{ url('/pay-ssl') }}" method="POST" class="needs-validation">
                                            <input type="hidden" value="{{ csrf_token() }}" name="_token"/>
                                            <button class="btn btn-block" type="submit">
                                                <img width="150"
                                                     src="{{asset('public/assets/front-end/img/sslcomz.png')}}"/>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @php($config=\App\CPU\Helpers::get_business_settings('paypal'))
                        @if($config['status'])
                            <div class="col-md-6 mb-4" style="cursor: pointer">
                                <div class="card">
                                    <div class="card-body" style="height: 100px">
                                        <form class="needs-validation" method="POST" id="payment-form"
                                              action="{{route('pay-paypal')}}">
                                            {{ csrf_field() }}
                                            <button class="btn btn-block" type="submit">
                                                <img width="150"
                                                     src="{{asset('public/assets/front-end/img/paypal.png')}}"/>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @php($coupon_discount = session()->has('coupon_discount') ? session('coupon_discount') : 0)
                        @php($amount = \App\CPU\CartManager::cart_grand_total(session('cart')) - $coupon_discount)

                        @php($config=\App\CPU\Helpers::get_business_settings('stripe'))
                        @if($config['status'])
                            @php($config=\App\CPU\Helpers::get_business_settings('stripe'))
                            <div class="col-md-6 mb-4" style="cursor: pointer">
                                <div class="card">
                                    <div class="card-body" style="height: 100px">
                                        @php($config=\App\CPU\Helpers::get_business_settings('stripe'))
                                        <button class="btn btn-block" type="button" id="checkout-button">
                                            <i class="czi-card"></i> Credit / Debit card ( Stripe )
                                        </button>
                                        <script type="text/javascript">
                                            // Create an instance of the Stripe object with your publishable API key
                                            var stripe = Stripe('{{$config['published_key']}}');
                                            var checkoutButton = document.getElementById("checkout-button");
                                            checkoutButton.addEventListener("click", function () {
                                                fetch("{{route('pay-stripe')}}", {
                                                    method: "GET",
                                                }).then(function (response) {
                                                    console.log(response)
                                                    return response.text();
                                                }).then(function (session) {
                                                    console.log(JSON.parse(session).id)
                                                    return stripe.redirectToCheckout({sessionId: JSON.parse(session).id});
                                                }).then(function (result) {
                                                    if (result.error) {
                                                        alert(result.error.message);
                                                    }
                                                }).catch(function (error) {
                                                    console.error("Error:", error);
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @php($config=\App\CPU\Helpers::get_business_settings('razor_pay'))
                        @php($inr=\App\Model\Currency::where(['symbol'=>'₹'])->first())
                        @php($usd=\App\Model\Currency::where(['code'=>'usd'])->first())
                        @if(isset($inr) && isset($usd) && $config['status'])
                            <div class="col-md-6 mb-4" style="cursor: pointer">
                                <div class="card">
                                    <div class="card-body" style="height: 100px">
                                        <form action="{!!route('payment-razor')!!}" method="POST">
                                        @csrf
                                        <!-- Note that the amount is in paise = 50 INR -->
                                            <!--amount need to be in paisa-->
                                            <script src="https://checkout.razorpay.com/v1/checkout.js"
                                                    data-key="{{ \Illuminate\Support\Facades\Config::get('razor.razor_key') }}"
                                                    data-amount="{{(round(\App\CPU\Convert::usdToinr($amount)))*100}}"
                                                    data-buttontext="Pay {{(\App\CPU\Convert::usdToinr($amount))*100}} INR"
                                                    data-name="{{\App\Model\BusinessSetting::where(['type'=>'company_name'])->first()->value}}"
                                                    data-description=""
                                                    data-image="{{asset('storage/app/public/company/'.\App\Model\BusinessSetting::where(['type'=>'company_web_logo'])->first()->value)}}"
                                                    data-prefill.name="{{auth('customer')->user()->f_name}}"
                                                    data-prefill.email="{{auth('customer')->user()->email}}"
                                                    data-theme.color="#ff7529">
                                            </script>
                                        </form>
                                        <button class="btn btn-block" type="button"
                                                onclick="$('.razorpay-payment-button').click()">
                                            <img width="150"
                                                 src="{{asset('public/assets/front-end/img/razor.png')}}"/>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif


                        @php($config=\App\CPU\Helpers::get_business_settings('paystack'))
                        @if($config['status'])
                            <div class="col-md-6 mb-4" style="cursor: pointer">
                                <div class="card">
                                    <div class="card-body" style="height: 100px">
                                        @php($config=\App\CPU\Helpers::get_business_settings('paystack'))
                                        @php($order=\App\Model\Order::find(session('order_id')))
                                        <form method="POST" action="{{ route('paystack-pay') }}" accept-charset="UTF-8"
                                              class="form-horizontal"
                                              role="form">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-8 col-md-offset-2">
                                                    <input type="hidden" name="email"
                                                           value="{{$order->customer->email!=null?$order->customer->email:'required@email.com'}}"> {{-- required --}}
                                                    <input type="hidden" name="orderID" value="{{$order['id']}}">
                                                    <input type="hidden" name="amount"
                                                           value="{{\App\CPU\Convert::usdTozar($order['order_amount'])*100}}"> {{-- required in kobo --}}
                                                    <input type="hidden" name="quantity" value="1">
                                                    <input type="hidden" name="currency"
                                                           value="ZAR">
                                                    <input type="hidden" name="metadata"
                                                           value="{{ json_encode($array = ['key_name' => 'value',]) }}"> {{-- For other necessary things you want to add to your payload. it is optional though --}}
                                                    <input type="hidden" name="reference"
                                                           value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                                                    <p>
                                                        <button class="paystack-payment-button" style="display: none"
                                                                type="submit"
                                                                value="Pay Now!"></button>
                                                    </p>
                                                </div>
                                            </div>
                                        </form>
                                        <button class="btn btn-block" type="button"
                                                onclick="$('.paystack-payment-button').click()">
                                            <img width="100"
                                                 src="{{asset('public/assets/front-end/img/paystack.png')}}"/>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif


                        @php($myr=\App\Model\Currency::where(['code'=>'MYR'])->first())
                        @php($usd=\App\Model\Currency::where(['code'=>'usd'])->first())
                        @php($config=\App\CPU\Helpers::get_business_settings('senang_pay'))
                        @if(isset($myr) && isset($usd) && $config['status'])
                            <div class="col-md-6 mb-4" style="cursor: pointer">
                                <div class="card">
                                    <div class="card-body" style="height: 100px">
                                        @php($config=\App\CPU\Helpers::get_business_settings('senang_pay'))
                                        @php($order=\App\Model\Order::find(session('order_id')))
                                        @php($user=\App\User::where(['id'=>$order['customer_id']])->first())
                                        @php($secretkey = $config['secret_key'])
                                        @php($data = new \stdClass())
                                        @php($data->merchantId = $config['merchant_id'])
                                        @php($data->detail = 'payment')
                                        @php($data->order_id = $order->id)
                                        @php($data->amount = \App\CPU\Convert::usdTomyr($order->order_amount))
                                        @php($data->name = $user->f_name.' '.$user->l_name)
                                        @php($data->email = $user->email)
                                        @php($data->phone = $user->phone)
                                        @php($data->hashed_string = md5($secretkey . urldecode($data->detail) . urldecode($data->amount) . urldecode($data->order_id)))

                                        <form name="order" method="post"
                                              action="https://{{env('APP_MODE')=='live'?'app.senangpay.my':'sandbox.senangpay.my'}}/payment/{{$config['merchant_id']}}">
                                            <input type="hidden" name="detail" value="{{$data->detail}}">
                                            <input type="hidden" name="amount" value="{{$data->amount}}">
                                            <input type="hidden" name="order_id" value="{{$data->order_id}}">
                                            <input type="hidden" name="name" value="{{$data->name}}">
                                            <input type="hidden" name="email" value="{{$data->email}}">
                                            <input type="hidden" name="phone" value="{{$data->phone}}">
                                            <input type="hidden" name="hash" value="{{$data->hashed_string}}">
                                        </form>

                                        <button class="btn btn-block" type="button"
                                                onclick="document.order.submit()">
                                            <img width="100"
                                                 src="{{asset('public/assets/front-end/img/senangpay.png')}}"/>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- Navigation (desktop)-->
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-4">
                            <a class="btn btn-secondary btn-block" href="{{route('checkout-shipping')}}">
                                <span class="d-none d-sm-inline">Back to Shipping</span>
                                <span class="d-inline d-sm-none">Back</span>
                            </a>
                        </div>
                        <div class="col-4"></div>
                    </div>
                </div>
            </section>
            <!-- Sidebar-->
            @include('web-views.partials._order-summary')
        </div>
    </div>
@endsection

@push('script')
    <script>
        setTimeout(function () {
            $('.stripe-button-el').hide();
            $('.razorpay-payment-button').hide();
        }, 10)
    </script>

    <script type="text/javascript">
        // Create an instance of the Stripe object with your publishable API key
        var stripe = Stripe("pk_test_TYooMQauvdEDq54NiTphI7jx");
        var checkoutButton = document.getElementById("checkout-button");

        checkoutButton.addEventListener("click", function () {
            fetch("{{route('pay-stripe')}}", {
                method: "POST",
            }).then(function (response) {
                console.log(response.json());
                return response.text();
            }).then(function (session) {
                return stripe.redirectToCheckout({sessionId: session.id});
            }).then(function (result) {
                if (result.error) {
                    alert(result.error.message);
                }
            }).catch(function (error) {
                console.error("Error:", error);
            });
        });
    </script>
@endpush
