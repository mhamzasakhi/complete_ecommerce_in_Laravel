@extends('layouts.front-end.app')

@section('title','Home')

@push('css_or_js')

@endpush

@section('content')
    <style>
       .headerTitle {
            font-size: 24px;
            font-weight: 600;
            margin-top: 1rem;
        }

        .sidebar {
            max-width: 20rem;
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
    font-size: 12px;
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
.sellerName{

     font-weight: 600;
    font-size: 10px;
    color: #030303;
}
.amount{
    font-size: 15px;
    margin-top: 4px;
     color:  #1B7FED;
     font-weight: 600;
 

}

.addtocart{
    color: #1B7FED;
    cursor: pointer;
}
.addtocart:hover{
    color: #1B7FED;
    cursor: pointer;
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
.marginLeft{
    margin-left: -60px;
    margin-top: 6px;
}
 .price_sidebar{
        padding: 20px;
    }
 .mrl{
     margin-left: 6px;
 }
 
@media(max-width:600px){
    .sidebar_heading{
        background: #1B7FED;
    }
    .czi-close-circle {
        font-size: 12px;
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
    .mrl{
     margin-left: 1px;
    }
    .marginLeft{
    margin-left: -36px;
 }
 .amount{
     font-size: 12px;
 }
  
}
@media(max-width:600px){
    .wishlist_product_img{
        width: 20%;
    }
    .forPadding{
        padding:6px;
    }
    .wishlist_product_desc{
        width: 50%;
        margin-top: 0px !important;
    }
    .wishlist_product_icon{
        margin-left: 1px !important;
    }
    .wishlist_product_btn{
        width: 30%;
        margin-top: 10px !important;
    }
    .wishlist_product_cart_btn{
        margin-left: 0px !important;
    }
}
    </style>
    <!-- Page Title-->
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-9 sidebar_heading">
           <h1 class="h3  mb-0 folot-left headerTitle">WISHLIST</h1>
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
            <section class="col-lg-9 mt-2">
                <div class="card box-shadow-sm mt-2">
                    <div class="product mb-2">
                        <div class="card">
                            <div class="row forPadding">
                                <div class="wishlist_product_img col-md-2 col-lg-2 col-sm-2"> <img  src="{{asset("storage/app/public/product/th03.jpg")}}" width="100"></div>
                                <div class="wishlist_product_desc col-md-4 mt-4">
                                    <span class="font-name">Bee Willow Home Hand-quilted Velvet Quiit Set</span>
                                        <span class="sellerName">Bee Willow Home </span>
                                        
                                    <div class="product-qty"> <span class="d-block">Size: XL</span></div>
                                    <div class=""> <span class="font-weight-bold amount">$345.50</span> </div>
                                </div>
                                <div class="wishlist_product_btn col-md-6 col-lg-6 col-sm-6 mt-5 float-right bodytr font-weight-bold" style="color: #92C6FF;">  
                                    
                                    <span class="amount wishlist_product_cart_btn" style="margin-left: 15rem;"> <a href="" class="addtocart"> Add To Cart</a></span> 
                                    <a href=""  class="wishlist_product_icon ml-2"><i class="czi-close-circle" style="color: red" ></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                         <div class="card box-shadow-sm mt-2">
          
                     <div class="product mb-2 ">
                            <div class="card">
                                <div class="row forPadding">
                                    <div class="col-md-2 wishlist_product_img"> <img  src="{{asset("storage/app/public/product/th03.jpg")}}" width="100"></div>
                                    <div class="col-md-4 mt-4 wishlist_product_desc">
                                        <span class="font-name">Bee Willow Home Hand-quilted Velvet Quiit Set</span>
                                         <span class="sellerName">Bee Willow Home </span>
                                       
                                        <div class="product-qty"> <span class="d-block">Size: XL</span></div>
                                        <div class=""> <span class="font-weight-bold amount">$345.50</span> </div>
                                    </div>
                                    <div class="col-md-6 mt-5 wishlist_product_btn">  <td class="bodytr font-weight-bold" style="color: #92C6FF;"> <a href=""></a>
                                        <span class="amount wishlist_product_cart_btn" style="margin-left: 15rem;"> <a href="" class="addtocart"> Add To Cart</a></span> <a href=""  class="wishlist_product_icon ml-2"><i class="czi-close-circle" style="color: red" ></i></a></td></div>
                                </div>
                                </div>
                            </div>
                        </div>

 <div class="card box-shadow-sm mt-2">
          
                     <div class="product mb-2 ">
                            <div class="card">
                                <div class="row forPadding">
                                    <div class="col-md-2 wishlist_product_img"> <img  src="{{asset("storage/app/public/product/th03.jpg")}}" width="100"></div>
                                    <div class="col-md-4 mt-4 wishlist_product_desc">
                                        <span class="font-name">Bee Willow Home Hand-quilted Velvet Quiit Set</span>
                                         <span class="sellerName">Bee Willow Home </span>
                                          
                                        <div class="product-qty"> <span class="d-block">Size: XL</span></div>
                                        <div class=""> <span class="font-weight-bold amount">$345.50</span> </div>
                                    </div>
                                    <div class="col-md-6 mt-5 wishlist_product_btn">  <td class="bodytr font-weight-bold" style="color: #92C6FF;"> <a href=""></a>
                                        <span class="wishlist_product_cart_btn amount" style="margin-left: 15rem;"> <a href="" class="addtocart"> Add To Cart</a></span> 
                                        <a href=""  class="wishlist_product_icon ml-2"><i class="czi-close-circle" style="color: red" ></i></a></td>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="product border-bottom table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                   <tr>
                                        <div class="row">
                                            <div class="col-md-3">
                                                  <td width="30%" class="paddingtd"> <img src="{{asset("storage/app/public/product/th03.jpg")}}"  width="100"> </td>
                                        <td width="60%" class="paddingtd"> <span class="font-name">Bee Willow Home Hand-quilted Velvet Quiit Set</span>
                                            <div class="product-qty"> <span class="d-block">Size : L </span></div>
                                            <div class=""> <span class="font-weight-bold amount">$345.50</span> </div>

                                        </td>
                                            </div>
                                            <td width="20%">
                                                <div class="marginLeft"> <span class=" amount" > <a href="" class="addtocart"> Add To Cart</a></span> 
                                                    <a href="" ><i class="czi-close-circle mrl" style="color: red" ></i></a></div>
                                            </td>
                                        </div>
                                    </tr>
                                  
                                   <tr>
                                        <div class="row">
                                            <div class="col-md-3">
                                                  <td width="30%"> <img  src="{{asset("storage/app/public/product/th03.jpg")}}" width="100"> </td>
                                        <td width="60%"> <span class="font-name">Bee Willow Home Hand-quilted Velvet Quiit Set</span>
                                            <div class="product-qty"> <span class="d-block">Size: XL</span></div>
                                        </td>
                                            </div>
                                            <div class="col-md-6">
                                                   <td width="20%">
                                            <div class="text-right"> <span class="font-weight-bold amount">$770.50</span> </div>
                                        </td>
                                            </div>
                                        </div>
                                      
                                     
                                    </tr>
                                </tbody>
                            </table>
                        </div> --}}


            </section>

                </div>
     
          
        </div>
    </div>

@endsection

