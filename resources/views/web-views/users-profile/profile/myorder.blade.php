@extends('layouts.front-end.app')

@section('title','Home')

@push('css_or_js')

@endpush

@section('content')
    <style>
        .headerTitle {
            font-size: 34px;
            font-weight: bolder;
            margin-top: 3rem;
        }

        .sidebar {
            max-width: 20rem;
        }

        .page-item.active .page-link {
            background-color: blue !important;
        }

        .page-item.active > .page-link {
            box-shadow: 0 0 black !important;
        }

        .custom-control-label::before {
            border: 0 !important;
        }

        .custom-control-label:hover::before {
            border: 0 !important;
            content: "\2713";
            color: #74b9ff !important;
        }

        .custom-control-label:hover {
            color: #74b9ff !important;

        }

        .custom-control-label {
            cursor: pointer;
        }

        .btnF {
            cursor: pointer;
        }

        .widget-categories .accordion-heading > a:hover {
            color: #FFD5A4 !important;
        }

        .widget-categories .accordion-heading > a {
            color: #FFD5A4;
        }

        .list-link:hover {
            color: #030303 !important;
        }

        .border:hover{
            border: 3px solid #4884ea;
    margin-bottom: 5px;
    margin-top: -6px;
        }
        body {
    font-family: 'Titillium Web', sans-serif
}

.card {
    border: none
}



.totals tr td {
    font-size: 13px
}

.footer {
    background-color: #eeeeeea8
}

.footer span {
    font-size: 12px
}

.product-qty span {
    font-size: 14px;
    color: #6A6A6A;
}
.spanTr{
    color: #FFFFFF;
    font-weight: 600;
    font-size: 13px;

}
.spandHead{
   color: #FFFFFF;
    font-weight: 600;
    font-size: 20px;
    margin-left: 25px;
}
.spandHeadO{
   color: #FFFFFF;
    font-weight: 400;
    font-size: 13px;

}
.font-name{
    font-weight: 600;
    font-size: 12px;
    color: #030303;
}
.amount{
    font-size: 15px;
     color:  #030303;
     font-weight: 600;
     margin-left: 60px;

}

a{
    color: #030303;
    cursor: pointer;
}
a:hover{
    color: #4884ea;
    cursor: pointer;
}
.divider-role{
    border-bottom:1px solid whitesmoke;
}
.sidebarL h3:hover+.divider-role{
    border-bottom: 3px solid #1b7fed !important;
    transition: .2s ease-in-out;
}
.sidebarL{
    padding: ;
}
 .price_sidebar{
        padding: 20px;
    }
@media(max-width:600px){
    .sidebar_heading{
        background: #1B7FED;
    }
    .sidebar_heading h1{
        text-align: center;
        color: aliceblue;
        padding-bottom: 17px;
        font-size: 19px;
    }
    .sidebarR{
        padding: 24px;
    }
    .price_sidebar{
        padding: 20px;
    }
}
@media(max-width:600px){
    .order_table_tr{
        display: grid;
    }
    .order_table_td{
    border-bottom: 1px solid #fff !important;
    }
    .order_table_info_div{
        width: 100%;
        display: flex;
    }
    .order_table_info_div_1{
        width: 50%;
    }
    .order_table_info_div_2{
        width: 49%;
        text-align: right !important;
    }
    .spandHeadO{
        font-size:16px; margin-left: 16px;
    }
    .spanTr{
        font-size:16px;
         margin-right: 16px;
         margin-top: 10px;
    }
    .amount{
    font-size: 13px;
     margin-left: 0px;

}
.counting{
    margin-left: 30%;
}

}
    </style>
    <!-- Page Title-->
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-9 ">

                <div class="row mt-4">
                    <div class="col-md-6">  <a class="page-link" href="#"><i class="czi-arrow-left mr-2"></i>Back</a></div>
                     <div class="col-md-6">

                     </div>
                </div>
                  <div class="float-right mt-2"><a href="#" style="color: #1B7FED;">Print the invoice</a><i class="czi-printer" style="color: black; padding:2px;"></i></div>
            </div>
        </div>


    </div>

    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-4 mt-3">
        <div class="row">
            <!-- Sidebar-->
            <div class="sidebarR col-lg-3">
                <!--Price Sidebar-->
                <div class="price_sidebar rounded-lg box-shadow-sm" id="shop-sidebar" style="margin-bottom: -10px;">
                    <div class="box-shadow-sm">

                    </div>
                    <div class="pb-0" style="padding-top: 12px;">
                        <!-- Filter by price-->
                        <div class="sidebarL">
                            <h3 class="widget-title btnF" style="font-weight: 700;"><a href="{{ route('orderList') }}" style="color: #1B7FED">My Orders</a></h3>
                            <div class="divider-role"
                                 style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;"></div>

                        </div>
                    </div>
                       <div class="pb-0" style="padding-top: 12px;">
                        <!-- Filter by price-->
                        <div class="sidebarL ">
                            <h3 class="widget-title btnF" style="font-weight: 700;"> <a href="{{ route('wishList') }}"> Wish List </a></h3>
                            <div class="divider-role"
                                 style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;"></div>

                        </div>
                    </div>
                      <div class="pb-0" style="padding-top: 12px;">
                        <!-- Filter by price-->
                        <div class=" sidebarL">
                            <h3 class="widget-title btnF" style="font-weight: 700;"> <a href=""> Chat With Sellers </a></h3>
                            <div class="divider-role"
                                 style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;"></div>

                        </div>
                    </div>
                      <div class="pb-0" style="padding-top: 12px;">
                        <!-- Filter by price-->
                        <div class=" sidebarL">
                            <h3 class="widget-title btnF" style="font-weight: 700;"> <a href="{{ route('profile') }}"> Profile Info </a></h3>
                            <div class="divider-role"
                                 style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;"></div>

                        </div>
                    </div>
                      <div class="pb-0" style="padding-top: 12px;">
                        <!-- Filter by price-->
                        <div class=" sidebarL">
                            <h3 class="widget-title btnF" style="font-weight: 700;"> <a href="">Address </a></h3>
                            <div class="divider-role"
                                 style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;"></div>

                        </div>
                    </div>
                      <div class="pb-0" style="padding-top: 12px;">
                        <!-- Filter by price-->
                        <div class=" sidebarL">
                            <h3 class="widget-title btnF" style="font-weight: 700;"> <a href="{{ route('support-ticket') }}">Support ticket </a></h3>
                            <div class="divider-role"
                                 style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;"></div>

                        </div>
                    </div>
                      <div class="pb-0" style="padding-top: 12px;">
                        <!-- Filter by price-->
                        <div class="sidebarL ">
                            <h3 class="widget-title btnF" style="font-weight: 700;"><a href="">Transaction history </a></h3>
                            <div class="divider-role"
                                 style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;"></div>

                        </div>
                    </div>
                       <div class="pb-1" style="padding-top: 12px;">
                        <!-- Filter by price-->
                        <div class="sidebarL ">
                            <h3 class="widget-title btnF" style="font-weight: 700;"><a href="">Payment method </a></h3>
                            <div class="divider-role"
                                 style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;"></div>

                        </div>
                    </div>
                </div>
            </div>
            <section class="col-lg-9">
              <div class="card box-shadow-sm">
                 <div class="payment border-top mt-3 mb-3  table-responsive">
                        <table class="table table-borderless">
                            <tbody >
                                <tr class="order_table_tr" style="background: #92C6FF" >
                                    <td class="order_table_td">
                                        <div class="order_table_info_div">
                                            <div class="order_table_info_div_1" class="py-2 ml-2">
                                                <span class="d-block spandHeadO ml-2">Seller</span>
                                            </div>
                                            <div class="order_table_info_div_2">
                                                <span class="spanTr"> Gadget Insider BD</span>
                                            </div>
                                            {{-- <div class="py-2 ml-2"> <span class="d-block spandHeadO ml-2">Seller</span> <span class="spanTr"> Gadget Insider BD</span> </div> --}}
                                        </div>
                                    </td>
                                    <td class="order_table_td">
                                        <div class="order_table_info_div">
                                            <div class="order_table_info_div_1" class="py-2 ml-2">
                                                <span class="d-block spandHeadO ml-2">Order No</span>
                                            </div>
                                            <div class="order_table_info_div_2">
                                                <span class="spanTr"> S1523562542397845</span>
                                            </div>

                                        </div>
                                    </td>
                                    <td class="order_table_td">
                                        <div class="order_table_info_div">
                                            <div class="order_table_info_div_1" class="py-2 ml-2">
                                                <span class="d-block spandHeadO ml-2">Order Date</span>
                                            </div>
                                            <div class="order_table_info_div_2">
                                                <span class="spanTr"> 12 Jan,2508</span>
                                            </div>

                                        </div>
                                    </td>
                                    <td class="order_table_td">
                                        <div class="order_table_info_div">
                                            <div class="order_table_info_div_1" class="py-2 ml-2">
                                                <span class="d-block spandHeadO ml-2">Shiping Address</span>
                                            </div>
                                            <div class="order_table_info_div_2">
                                                <span class="spanTr"> 45,St street, NY, 113</span>
                                            </div>

                                        </div>
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
                                        <div class="col-md-6">
                                              <td width="30%"> <img  src="{{asset("storage/app/public/product/th03.jpg")}}" width="100"> </td>
                                    <td width="60%"> <span class="font-name">Bee Willow Home Hand-quilted Velvet Quiit Set</span>
                                        <div class="product-qty"> <span class="d-block">Size: XL</span></div>
                                    </td>
                                        </div>
                                        <td width="20%">
                                        <div class=""> <span class="font-weight-bold amount ">Pending</span> </div>
                                          </td>
                                        <div class="col-md-6">
                                               <td width="20%">
                                        <div class="text-right"> <span class="font-weight-bold amount">$770.50</span> </div>
                                    </td>
                                        </div>
                                    </div>

                                </tr>
                                     <tr>
                                    <div class="row">
                                        <div class="col-md-6">
                                              <td width="30%"> <img  src="{{asset("storage/app/public/product/th03.jpg")}}" width="100"> </td>
                                    <td width="60%"> <span class="font-name">Bee Willow Home Hand-quilted Velvet Quiit Set</span>
                                        <div class="product-qty"> <span class="d-block">Size: XL</span></div>
                                    </td>
                                        </div>
                                        <td width="20%">
                                        <div class=""> <span class="font-weight-bold amount ">Pending</span> </div>
                                          </td>
                                        <div class="col-md-6">
                                               <td width="20%">
                                        <div class="text-right"> <span class="font-weight-bold amount">$770.50</span> </div>
                                    </td>
                                        </div>
                                    </div>

                                </tr>
                                     <tr>
                                    <div class="row">
                                        <div class="col-md-6">
                                              <td width="30%"> <img  src="{{asset("storage/app/public/product/th03.jpg")}}" width="100"> </td>
                                    <td width="60%"> <span class="font-name">Bee Willow Home Hand-quilted Velvet Quiit Set</span>
                                        <div class="product-qty"> <span class="d-block">Size: XL</span></div>
                                    </td>
                                        </div>
                                        <td width="20%">
                                        <div class=""> <span class="font-weight-bold amount ">Pending</span> </div>
                                          </td>
                                        <div class="col-md-6">
                                               <td width="20%">
                                        <div class="text-right"> <span class="font-weight-bold amount">$770.50</span> </div>
                                    </td>
                                        </div>
                                    </div>

                                </tr>
                                   <tr>
                                    <div class="row">
                                        <div class="col-md-6">
                                              <td width="30%"> <img  src="{{asset("storage/app/public/product/th03.jpg")}}" width="100"> </td>
                                    <td width="60%"> <span class="font-name">Bee Willow Home Hand-quilted Velvet Quiit Set</span>
                                        <div class="product-qty"> <span class="d-block">Size: XL</span></div>
                                    </td>
                                        </div>
                                        <td width="20%">
                                        <div class=""> <span class="font-weight-bold amount ">Pending</span> </div>
                                          </td>
                                        <div class="col-md-6">
                                               <td width="20%">
                                        <div class="text-right"> <span class="font-weight-bold amount">$770.50</span> </div>
                                    </td>
                                        </div>
                                    </div>


                                </tr>
                            </tbody>
                        </table>
                    </div>
                 </div>

                 <div class="card box-shadow-sm">
                    <div class="payment border-top mt-3 mb-3  table-responsive">
                           <table class="table table-borderless">
                               <tbody >
                                   <tr class="order_table_tr" style="background: #92C6FF" >
                                       <td class="order_table_td">
                                           <div class="order_table_info_div">
                                               <div class="order_table_info_div_1" class="py-2 ml-2">
                                                   <span class="d-block spandHeadO ml-2">Seller</span>
                                               </div>
                                               <div class="order_table_info_div_2">
                                                   <span class="spanTr"> Gadget Insider BD</span>
                                               </div>
                                               {{-- <div class="py-2 ml-2"> <span class="d-block spandHeadO ml-2">Seller</span> <span class="spanTr"> Gadget Insider BD</span> </div> --}}
                                           </div>
                                       </td>
                                       <td class="order_table_td">
                                           <div class="order_table_info_div">
                                               <div class="order_table_info_div_1" class="py-2 ml-2">
                                                   <span class="d-block spandHeadO ml-2">Order No</span>
                                               </div>
                                               <div class="order_table_info_div_2">
                                                   <span class="spanTr"> S1523562542397845</span>
                                               </div>

                                           </div>
                                       </td>
                                       <td class="order_table_td">
                                           <div class="order_table_info_div">
                                               <div class="order_table_info_div_1" class="py-2 ml-2">
                                                   <span class="d-block spandHeadO ml-2">Order Date</span>
                                               </div>
                                               <div class="order_table_info_div_2">
                                                   <span class="spanTr"> 12 Jan,2508</span>
                                               </div>

                                           </div>
                                       </td>
                                       <td class="order_table_td">
                                           <div class="order_table_info_div">
                                               <div class="order_table_info_div_1" class="py-2 ml-2">
                                                   <span class="d-block spandHeadO ml-2">Shiping Address</span>
                                               </div>
                                               <div class="order_table_info_div_2">
                                                   <span class="spanTr"> 45,St street, NY, 113</span>
                                               </div>

                                           </div>
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
                                           <div class="col-md-6">
                                                 <td width="30%"> <img  src="{{asset("storage/app/public/product/th03.jpg")}}" width="100"> </td>
                                       <td width="60%"> <span class="font-name">Bee Willow Home Hand-quilted Velvet Quiit Set</span>
                                           <div class="product-qty"> <span class="d-block">Size: XL</span></div>
                                       </td>
                                           </div>
                                           <td width="20%">
                                           <div class=""> <span class="font-weight-bold amount ">Pending</span> </div>
                                             </td>
                                           <div class="col-md-6">
                                                  <td width="20%">
                                           <div class="text-right"> <span class="font-weight-bold amount">$770.50</span> </div>
                                       </td>
                                           </div>
                                       </div>

                                   </tr>
                                        <tr>
                                       <div class="row">
                                           <div class="col-md-6">
                                                 <td width="30%"> <img  src="{{asset("storage/app/public/product/th03.jpg")}}" width="100"> </td>
                                       <td width="60%"> <span class="font-name">Bee Willow Home Hand-quilted Velvet Quiit Set</span>
                                           <div class="product-qty"> <span class="d-block">Size: XL</span></div>
                                       </td>
                                           </div>
                                           <td width="20%">
                                           <div class=""> <span class="font-weight-bold amount ">Pending</span> </div>
                                             </td>
                                           <div class="col-md-6">
                                                  <td width="20%">
                                           <div class="text-right"> <span class="font-weight-bold amount">$770.50</span> </div>
                                       </td>
                                           </div>
                                       </div>

                                   </tr>
                                        <tr>
                                       <div class="row">
                                           <div class="col-md-6">
                                                 <td width="30%"> <img  src="{{asset("storage/app/public/product/th03.jpg")}}" width="100"> </td>
                                       <td width="60%"> <span class="font-name">Bee Willow Home Hand-quilted Velvet Quiit Set</span>
                                           <div class="product-qty"> <span class="d-block">Size: XL</span></div>
                                       </td>
                                           </div>
                                           <td width="20%">
                                           <div class=""> <span class="font-weight-bold amount ">Pending</span> </div>
                                             </td>
                                           <div class="col-md-6">
                                                  <td width="20%">
                                           <div class="text-right"> <span class="font-weight-bold amount">$770.50</span> </div>
                                       </td>
                                           </div>
                                       </div>

                                   </tr>
                                      <tr>
                                       <div class="row">
                                           <div class="col-md-6">
                                                 <td width="30%"> <img  src="{{asset("storage/app/public/product/th03.jpg")}}" width="100"> </td>
                                       <td width="60%"> <span class="font-name">Bee Willow Home Hand-quilted Velvet Quiit Set</span>
                                           <div class="product-qty"> <span class="d-block">Size: XL</span></div>
                                       </td>
                                           </div>
                                           <td width="20%">
                                           <div class=""> <span class="font-weight-bold amount ">Pending</span> </div>
                                             </td>
                                           <div class="col-md-6">
                                                  <td width="20%">
                                           <div class="text-right"> <span class="font-weight-bold amount">$770.50</span> </div>
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
                                            <div class="text-left"> <span class="product-qty ">Iteam</span> </div>
                                        </td>
                                        <td>
                                            <div class="text-right"> <span>5</span> </div>
                                        </td>
                                    </tr>
                                       <tr>
                                        <td>
                                            <div class="text-left"> <span class="product-qty ">Tax Fee</span> </div>
                                        </td>
                                        <td>
                                            <div class="text-right"> <span>$7.65</span> </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="text-left"> <span class="product-qty ">Subtotal</span> </div>
                                        </td>
                                        <td>
                                            <div class="text-right"> <span>$168.50</span> </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="text-left"> <span class="product-qty ">Shipping Fee</span> </div>
                                        </td>
                                        <td>
                                            <div class="text-right"> <span>$22</span> </div>
                                        </td>
                                    </tr>


                                    <tr class="border-top ">
                                        <td>
                                            <div class="text-left"> <span class="font-weight-bold">Total</span> </div>
                                        </td>
                                        <td>
                                            <div class="text-right"> <span class="font-weight-bold amount ">$238.50</span> </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                 </div>


            </section>

                </div>


        </div>
    </div>

@endsection

