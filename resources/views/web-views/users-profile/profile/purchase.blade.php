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
    font-weight: 600;
    font-size: 14px;
    
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


}

.tdBorder {
        border-right: 1px solid #f7f0f0;
    text-align: center;
}
.bodytr {
   text-align: center;
}
.sellerName {
        font-size: 15px;
    font-weight: 400;
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
    .marl{
        margin-left: 7px ;
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
    .marl{
        margin-left: none !important;
    }
    .price_sidebar{
        padding: 20px;
    }
}

    </style>
    <!-- Page Title-->
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-9 sidebar_heading">
               
                        <h1 class="h3  mb-0 folot-left headerTitle">PURCHASE STATMENT</h1>
                    
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
            <section class="col-lg-9 mt-3">
              <div class="card box-shadow-sm">
              

                    <table class="table table-bordered">
                     <thead>
                      <tr style="background: #92C6FF" >
                                      <td class="tdBorder">
                                      <div class="py-2"> <span class="d-block spandHeadO ">Tranx ID</span>
                                    </td>
                                    <td class="tdBorder" >
                                        <div class="py-2 ml-2"> <span class="d-block spandHeadO ">Payment method</div>
                                    </td>
                                    
                                      <td class="tdBorder">
                                      <div class="py-2"> <span class="d-block spandHeadO"> Status</span> </div>
                                    </td>
                                  
                                  
                                      <td class="tdBorder">
                                        <div class="py-2"> <span class="d-block spandHeadO"> Total</span> </div>
                                    </td>
                                </tr>
  </thead>
  
  <tbody>
                                 <tr>

                                    <td class="bodytr font-weight-bold" style="color: #92C6FF;"><span class="marl">9480598430</span> </td>
                                   <td  class="sellerName bodytr "><span class="">SSl Commerze</span></td>                              
                                       
                                          <td  class="bodytr"><span class="">Pending</span></td>
                                  
                                   <td  class="bodytr"> <span class=" amount ">$770.50</span> </td>

        
                                </tr> 
                                <tr>

                                    <td class="bodytr font-weight-bold" style="color: #92C6FF;"><span class="marl">9480598430</span> </td>
                                   <td  class="sellerName bodytr"><span class="">SSl Commerze</span></td>                              
                                       
                                          <td  class="bodytr"><span class="">Pending</span></td>
                                  
                                   <td  class="bodytr"> <span class=" amount ">$770.50</span> </td>

        
                                </tr> 
                                <tr>

                                    <td class="bodytr font-weight-bold" style="color: #92C6FF;"><span class="marl">9480598430</span> </td>
                                   <td  class="sellerName bodytr"><span class="">SSl Commerze</span></td>                              
                                       
                                          <td  class="bodytr"><span class="">Pending</span></td>
                                  
                                   <td  class="bodytr"> <span class=" amount ">$770.50</span> </td>

        
                                </tr> 

                           </div>
                      </table>
                 </div>


           

            </section>

                </div>
     
          
        </div>
    

@endsection

