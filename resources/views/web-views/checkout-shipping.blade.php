@extends('layouts.front-end.app')

@section('title','Shipping Address Choose')

@push('css_or_js')
    <style>
        .btn-outline {
            border-color: {{$web_config['primary_color']}} ;
        }

        .btn-outline {
            color: #020512;
            border-color: {{$web_config['primary_color']}}   !important;
        }

        .btn-outline:hover {
            color: white;
            background: {{$web_config['primary_color']}};

        }

        .btn-outline:focus {
            border-color: {{$web_config['primary_color']}}   !important;
        }

    </style>

@endpush

@section('content')
    <div class="container pb-5 mb-2 mb-md-4">
        <div class="row">
            <div class="col-md-12 mb-5 pt-5">
                <div class="feature_header" style="background: #dcdcdc;line-height: 1px">
                    <span>{{ trans('messages.shipping_address')}}</span>
                </div>
            </div>
            <section class="col-lg-8">
                <hr>
                <div class="checkout_details mt-3">
                    <!-- Steps-->
                @include('web-views.partials._checkout-steps',['step'=>2])
                <!-- Shipping methods table-->
                    <h2 class="h4 pb-3 mb-2 mt-5">{{ trans('messages.shipping_address')}} {{ trans('messages.choose_shipping_address')}}</h2>
                    @php($shipping_addresses=\App\Model\ShippingAddress::where('customer_id',auth('customer')->id())->get())
                    <form method="post" action="" id="address-form">
                        @csrf
                        <div class="card-body" style="padding: 0!important;">
                            <ul class="list-group">
                                @foreach($shipping_addresses as $key=>$address)
                                    <li class="list-group-item mb-2 mt-2"
                                        style="cursor: pointer;background: rgba(245,245,245,0.51)"
                                        onclick="$('#sh-{{$address['id']}}').prop( 'checked', true )">
                                        <input type="radio" name="shipping_method_id"
                                               id="sh-{{$address['id']}}"
                                               value="{{$address['id']}}" {{$key==0?'checked':''}}>
                                        <span class="checkmark" style="margin-right: 10px"></span>
                                        <label class="badge"
                                               style="background: {{$web_config['primary_color']}}; color:white !important;">{{$address['address_type']}}</label>
                                        <small>
                                            <i class="fa fa-phone"></i> {{$address['phone']}}
                                        </small>
                                        <hr>
                                        <span>{{ trans('messages.contact_person_name')}}: {{$address['contact_person_name']}}</span><br>
                                        <span>{{ trans('messages.address')}} : {{$address['address']}}, {{$address['city']}}, {{$address['zip']}}, {{$address['country']}}.</span>
                                    </li>
                                @endforeach
                                <li class="list-group-item mb-2 mt-2" onclick="anotherAddress()">
                                    <input type="radio" name="shipping_method_id"
                                           id="sh-0" value="0" data-toggle="collapse"
                                           data-target="#collapseThree" {{$shipping_addresses->count()==0?'checked':''}}>
                                    <span class="checkmark" style="margin-right: 10px"></span>
                                    <label class="badge"
                                           style="background: {{$web_config['primary_color']}}; color:white !important;">
                                        <i class="fa fa-plus-circle"></i></label>
                                    <button type="button" class="btn btn-outline" data-toggle="collapse"
                                            data-target="#collapseThree">{{ trans('messages.Another')}} {{ trans('messages.address')}}
                                    </button>
                                    <div id="accordion">
                                        <div id="collapseThree"
                                             class="collapse {{$shipping_addresses->count()==0?'show':''}}"
                                             aria-labelledby="headingThree"
                                             data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label
                                                        for="exampleInputEmail1">{{ trans('messages.contact_person_name')}}
                                                        <span style="color: red">*</span></label>
                                                    <input type="text" class="form-control"
                                                           name="contact_person_name" {{$shipping_addresses->count()==0?'required':''}}>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{{ trans('messages.Phone')}}<span
                                                            style="color: red">*</span></label>
                                                    <input type="text" class="form-control"
                                                           name="phone" {{$shipping_addresses->count()==0?'required':''}}>
                                                </div>
                                                <div class="form-group">
                                                    <label
                                                        for="exampleInputPassword1">{{ trans('messages.address')}} {{ trans('messages.Type')}}</label>
                                                    <select class="form-control" name="address_type">
                                                        <option
                                                            value="permanent">{{ trans('messages.Permanent')}}</option>
                                                        <option value="home">{{ trans('messages.Home')}}</option>
                                                        <option value="others">{{ trans('messages.Others')}}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ trans('messages.Country')}} <span
                                                            style="color: red">*</span></label>
                                                    <input type="text" class="form-control"
                                                           name="country" {{$shipping_addresses->count()==0?'required':''}}>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{{ trans('messages.City')}} <span
                                                            style="color: red">*</span></label>
                                                    <input type="text" class="form-control"
                                                           name="city" {{$shipping_addresses->count()==0?'required':''}}>
                                                </div>

                                                <div class="form-group">
                                                    <label
                                                        for="exampleInputEmail1">{{ trans('messages.zip_code')}} <span
                                                            style="color: red">*</span></label>
                                                    <input type="number" class="form-control"
                                                           name="zip" {{$shipping_addresses->count()==0?'required':''}}>
                                                </div>

                                                <div class="form-group">
                                                    <label
                                                        for="exampleInputEmail1">{{ trans('messages.address')}} <span
                                                            style="color: red">*</span></label>
                                                    <textarea class="form-control"
                                                              name="address" {{$shipping_addresses->count()==0?'required':''}}></textarea>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" name="save_address" class="form-check-input"
                                                           id="exampleCheck1">
                                                    <label class="form-check-label" for="exampleCheck1">
                                                        {{ trans('messages.save_this_address')}}
                                                    </label>
                                                </div>
                                                <button type="submit" class="btn btn-primary" style="display: none"
                                                        id="address_submit"></button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </form>
                    <!-- Navigation (desktop)-->
                    <div class="row">
                        <div class="col-6">
                            <a class="btn btn-secondary btn-block" href="{{route('checkout-details')}}">
                                <i class="czi-arrow-left mt-sm-0 mr-1"></i>
                                <span
                                    class="d-none d-sm-inline">{{ trans('messages.Back')}} {{ trans('messages.to')}} {{ trans('messages.address')}}</span>
                                <span class="d-inline d-sm-none">{{ trans('messages.Back')}}</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a class="btn btn-primary btn-block" href="javascript:" onclick="proceed_to_next()">
                                <span class="d-none d-sm-inline">{{ trans('messages.proceed_payment')}}</span>
                                <span class="d-inline d-sm-none">{{ trans('messages.Next')}}</span>
                                <i class="czi-arrow-right mt-sm-0 ml-1"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Sidebar-->
                </div>
            </section>
            @include('web-views.partials._order-summary')
        </div>
    </div>
@endsection

@push('script')

    <script>
        function anotherAddress() {
            $('#sh-0').prop('checked', true);
            $("#collapseThree").collapse();
        }
    </script>

    <script>
        function proceed_to_next() {

            let allAreFilled = true;
            document.getElementById("address-form").querySelectorAll("[required]").forEach(function (i) {
                if (!allAreFilled) return;
                if (!i.value) allAreFilled = false;
                if (i.type === "radio") {
                    let radioValueCheck = false;
                    document.getElementById("address-form").querySelectorAll(`[name=${i.name}]`).forEach(function (r) {
                        if (r.checked) radioValueCheck = true;
                    });
                    allAreFilled = radioValueCheck;
                }
            });


            if (allAreFilled) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post({
                    url: '{{route('customer.choose-shipping-address')}}',
                    dataType: 'json',
                    data: $('#address-form').serialize(),
                    beforeSend: function () {
                        $('#loading').show();
                    },
                    success: function (data) {
                        if (data.errors) {
                            for (var i = 0; i < data.errors.length; i++) {
                                toastr.error(data.errors[i].message, {
                                    CloseButton: true,
                                    ProgressBar: true
                                });
                            }
                        } else {
                            location.href = '{{route('checkout-payment')}}';
                        }
                    },
                    complete: function () {
                        $('#loading').hide();
                    },
                    error: function () {
                        toastr.error('Something went wrong!', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }
                });
            } else {
                toastr.error('Please fill all required fields', {
                    CloseButton: true,
                    ProgressBar: true
                });
            }
        }
    </script>
@endpush
