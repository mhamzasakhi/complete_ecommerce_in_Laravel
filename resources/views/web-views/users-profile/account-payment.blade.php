@extends('layouts.front-end.app')

@section('title','My Payment')

@push('css_or_js')
    <link rel="stylesheet" media="screen"
          href="{{asset('public/assets/front-end')}}/vendor/nouislider/distribute/nouislider.min.css"/>
@endpush

@section('content')
    <!-- Add Payment Method-->
    <form class="needs-validation modal fade" method="post" id="add-payment" tabindex="-1" novalidate>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add a payment method</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="custom-control custom-radio mb-4">
                        <input class="custom-control-input" type="radio" id="paypal" name="payment-method">
                        <label class="custom-control-label" for="paypal">PayPal<img class="d-inline-block align-middle ml-2" src="{{asset('public/assets/front-end')}}/img/card-paypal.png" width="39" alt="PayPal"></label>
                    </div>
                    <div class="custom-control custom-radio mb-4">
                        <input class="custom-control-input" type="radio" id="card" name="payment-method" checked>
                        <label class="custom-control-label" for="card">Credit / Debit card<img class="d-inline-block align-middle ml-2" src="{{asset('public/assets/front-end')}}/img/cards.png" width="187" alt="Credit card"></label>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <input class="form-control" type="text" name="number" placeholder="Card Number" required>
                            <div class="invalid-feedback">Please fill in the card number!</div>
                        </div>
                        <div class="form-group col-sm-6">
                            <input class="form-control" type="text" name="name" placeholder="Full Name" required>
                            <div class="invalid-feedback">Please provide name on the card!</div>
                        </div>
                        <div class="form-group col-sm-3">
                            <input class="form-control" type="text" name="expiry" placeholder="MM/YY" required>
                            <div class="invalid-feedback">Please provide card expiration date!</div>
                        </div>
                        <div class="form-group col-sm-3">
                            <input class="form-control" type="text" name="cvc" placeholder="CVC" required>
                            <div class="invalid-feedback">Please provide card CVC code!</div>
                        </div>
                        <div class="col-sm-6">
                            <button class="btn btn-primary btn-block mt-0" type="submit">Register this card</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Page Title-->
    <div class="page-title-overlap bg-dark pt-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
            <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                        <li class="breadcrumb-item"><a class="text-nowrap" href="{{route('home')}}"><i class="czi-home"></i>Home</a></li>
                        <li class="breadcrumb-item text-nowrap"><a href="{{route('user-account')}}">Account</a>
                        </li>
                        <li class="breadcrumb-item text-nowrap active" aria-current="page">Payment methods</li>
                    </ol>
                </nav>
            </div>
            <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
                <h1 class="h3 text-light mb-0">My payment methods</h1>
            </div>
        </div>
    </div>
    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-3">
        <div class="row">
            <!-- Sidebar-->
            @include('web-views.partials._profile-aside')
            <!-- Content  -->
            <section class="col-lg-8">
                <!-- Toolbar-->
                <div class="d-none d-lg-flex justify-content-between align-items-center pt-lg-3 pb-4 pb-lg-5 mb-lg-4">
                    <h6 class="font-size-base text-light mb-0">Primary payment method is used by default</h6><a class="btn btn-primary btn-sm" href="{{route('customer.auth.logout')}}"><i class="czi-sign-out mr-2"></i>Sign out</a>
                </div>
                <!-- Payment methods list-->
                <div class="table-responsive font-size-md">
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr>
                            <th>Your credit / debit cards</th>
                            <th>Name on card</th>
                            <th>Expires on</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="py-3 align-middle">
                                <div class="media align-items-center"><img class="mr-2" src="{{asset('public/assets/front-end')}}/img/card-visa.png" width="39" alt="Visa">
                                    <div class="media-body"><span class="font-weight-medium text-heading mr-1">Visa</span>ending in 4999<span class="align-middle badge badge-info ml-2">Primary</span></div>
                                </div>
                            </td>
                            <td class="py-3 align-middle">Susan Gardner</td>
                            <td class="py-3 align-middle">08 / 2019</td>
                            <td class="py-3 align-middle"><a class="nav-link-style mr-2" href="#" data-toggle="tooltip" title="Edit"><i class="czi-edit"></i></a><a class="nav-link-style text-danger" href="#" data-toggle="tooltip" title="Remove">
                                    <div class="czi-trash"></div></a></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                <hr class="pb-4">
                <div class="text-sm-right"><a class="btn btn-primary" href="#add-payment" data-toggle="modal">Add payment method</a></div>
            </section>
        </div>
    </div>

@endsection

@push('script')
    <script src="{{asset('public/assets/front-end')}}/vendor/nouislider/distribute/nouislider.min.js"></script>
@endpush
