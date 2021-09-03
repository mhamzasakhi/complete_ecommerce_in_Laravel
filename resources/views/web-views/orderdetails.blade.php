@extends('layouts.front-end.app')

@section('title','Order Details')

@push('css_or_js')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

        body {
            font-family: 'Titillium Web', sans-serif
        }

        .card {
            border: none
        }


        .totals tr td {
            font-size: 13px
        }

        .footer span {
            font-size: 12px
        }

        .product-qty span {
            font-size: 14px;
            color: #6A6A6A;
        }

        .spanTr {
            color: #1B7FED;
            font-weight: 700;

        }

        .btn {
            width: 49%;
            background-color: #1B7FED;
            color: white;
            height: 55px
        }

        .spandHead {
            color: #030303;
            font-weight: 500;
            font-size: 20px;
            margin-left: 25px;
        }

        .spandHeadO {
            color: #030303;
            font-weight: 500;
            font-size: 20px;

        }

        .font-name {
            font-weight: 600;
            font-size: 13px;
        }

        .amount {
            font-size: 17px;
            color: #1B7FED;

        }

        .marl {
            margin-left: 6px;
        }

        .btn2 {
            width: 50%;
            background-color: #F7931E;
            color: white;
            height: 55px;
        }

        .confirmation_container {
            padding: 55px;
        }

        @media (max-width: 600px) {
            .orderId {
                margin-right: 91px;
            }

            .marl {
                margin-left: 6px;
            }

            .yourOrder {
                text-align: center;
            }

            .confirmation_container {
                padding: 10px;
            }

            .spanTr {
                color: #1B7FED;
                font-weight: 400 !important;
                font-size: 12px;
            }

            .spandHeadO {
                color: #030303;
                font-weight: 300;
                font-size: 12px;

            }

            .table th, .table td {
                padding: 5px;
            }

            .btn {
                width: 80%;
                background-color: #1B7FED;
                color: white;
                height: 55px;
                display: flex;
                margin-left: 35px;
                padding: 15px 0 0 100px;

                margin-top: 6px;
            }

            .btn2 {
                width: 80%;
                background-color: #F7931E;
                color: white;
                height: 55px;
            }

            .thanks_msg {
                text-align: center;
            }

            .spandHead {
                font-size: 12px;
                margin: auto;
            }

            .contact {
                margin-right: 12%;
            }

            .orderId {
                font-size: 13px;
                text-align: center;
            }

            .confirmation_container {
                padding: 10px;
            }

            .counting {
                margin-left: 30%;
            }
        }

    </style>
@endpush

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="confirmation_container">
                        <div class="row">
                            <div class="col-md-6 yourOrder"><h5
                                    style="font-size: 20px; font-weight: 900">Your order
                                    Confirmed!</h5></div>
                            <div class="col-md-6 "><p class="float-right orderId ">Order No: <strong>RM984893</strong>
                                </p></div>
                        </div>

                        <span class="font-weight-bold d-block mt-4" style="font-size: 17px;">Hello, Refat</span> <span>You order has been confirmed and will be shipped in next two days!</span>
                        <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr style="background: #E2F0FF">
                                    <td>
                                        <div class="py-2 marl"><span class="d-block spandHead ">Seller</span> <span
                                                class="spanTr"> Baj Product LTD</span></div>
                                    </td>
                                    <td>
                                        <div class="py-2"><span class="d-block spandHeadO">Order Date</span> <span
                                                class="spanTr">12 Jan,2018</span></div>
                                    </td>

                                    <td>
                                        <div class="py-2"><span class="d-block spandHeadO">Shiping Address</span> <span
                                                class="spanTr">414 Advert Avenue, NY,USA</span></div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="product border-bottom table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <td width="30%" class="paddingtd"><img
                                                    src="{{asset("storage/app/public/product/th03.jpg")}}" width="100">
                                            </td>
                                            <td width="60%" class="paddingtd"><span class="font-name">Bee Willow Home Hand-quilted Velvet Quiit Set</span>
                                                <div class="product-qty"><span class="d-block">Size : L </span></div>
                                            </td>
                                        </div>
                                        <div class="col-md-6">
                                            <td width="20%" class="paddingtd">
                                                <div class="text-right"><span
                                                        class="font-weight-bold amount">$345.50</span></div>
                                            </td>
                                        </div>
                                    </div>


                                </tr>
                                <tr>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <td width="30%"><img src="{{asset("storage/app/public/product/th02.jpg")}}"
                                                                 width="100"></td>
                                            <td width="60%"><span class="font-name">Bee Willow Home Hand-quilted Velvet Quiit Set</span>
                                                <div class="product-qty"><span class="d-block">Size : 43</span></div>
                                            </td>
                                        </div>
                                        <div class="col-md-6">
                                            <td width="20%">
                                                <div class="text-right"><span
                                                        class="font-weight-bold amount">$78.50</span></div>
                                            </td>
                                        </div>
                                    </div>


                                </tr>
                                <tr>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <td width="30%"><img src="https://i.imgur.com/SmBOua9.jpg" width="100"></td>
                                            <td width="60%"><span class="font-name">Bee Willow Home Hand-quilted Velvet Quiit Set</span>
                                                <div class="product-qty"><span class="d-block">Size : M</span></div>
                                            </td>
                                        </div>
                                        <div class="col-md-6">
                                            <td width="20%">
                                                <div class="text-right"><span
                                                        class="font-weight-bold amount ">$797.50</span></div>
                                            </td>
                                        </div>
                                    </div>


                                </tr>
                                <tr>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <td width="30%"><img src="{{asset("storage/app/public/product/th03.jpg")}}"
                                                                 width="100"></td>
                                            <td width="60%"><span class="font-name">Bee Willow Home Hand-quilted Velvet Quiit Set</span>
                                                <div class="product-qty"><span class="d-block">Size: XL</span></div>
                                            </td>
                                        </div>
                                        <div class="col-md-6">
                                            <td width="20%">
                                                <div class="text-right"><span
                                                        class="font-weight-bold amount">$770.50</span></div>
                                            </td>
                                        </div>
                                    </div>


                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row d-flex justify-content-end">
                            <div class="col-md-5 counting">
                                <table class="table table-borderless">
                                    <tbody class="totals">
                                    <tr>
                                        <td>
                                            <div class="text-left"><span class="product-qty ">Iteam</span></div>
                                        </td>
                                        <td>
                                            <div class="text-right"><span>5</span></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="text-left"><span class="product-qty ">Tax Fee</span></div>
                                        </td>
                                        <td>
                                            <div class="text-right"><span>$7.65</span></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="text-left"><span class="product-qty ">Subtotal</span></div>
                                        </td>
                                        <td>
                                            <div class="text-right"><span>$168.50</span></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="text-left"><span class="product-qty ">Shipping Fee</span></div>
                                        </td>
                                        <td>
                                            <div class="text-right"><span>$22</span></div>
                                        </td>
                                    </tr>


                                    <tr class="border-top ">
                                        <td>
                                            <div class="text-left"><span class="font-weight-bold">Total</span></div>
                                        </td>
                                        <td>
                                            <div class="text-right"><span
                                                    class="font-weight-bold amount ">$238.50</span></div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- <p>We will be sending shipping confirmation email when the item shipped successfully!</p> --}}
                        <p class="thanks_msg font-weight-bold mb-2">Thanks for shopping with us!</p>
                        <hr>
                        <div class="justify-content mt-4 ">
                            <button class="btn font-weight-bold" type="button" style="">
                                Go To Shopping
                            </button>
                            <button class="btn btn2 font-weight-bold" type="button" style="">

                                Track Order
                            </button>
                        </div>
                        <div class="contact">
                            <p class="float-right mt-3 contact "><span style="font-size: 16px; font-weight: 400;">Nedd Help ?</span>
                                <a href="" style="color:  #1B7FED;">Contact To Help Center</a></p>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
@endsection

@push('script')

@endpush
