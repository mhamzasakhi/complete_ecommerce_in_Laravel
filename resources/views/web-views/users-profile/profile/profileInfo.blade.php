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
   color: #1B7FED;
    font-weight: 400;
    font-size: 13px;
    
}
.spandHeadO:hover{
   color: #1B7FED;
    font-weight: 400;
    font-size: 13px;
    
}
.font-name{
    font-weight: 600;
    margin-top: 1rem;
    margin-bottom: 0;
    font-size: 15px;
    color: #030303;
}
.font-nameA{
    font-weight: 600;
    margin-top: 2rem;
    margin-bottom: 0;
    font-size: 17px;
    color: #030303;
}
.btn-p{


    color: #fff;
    background-color: #4884ea;
    border-color: #4884ea;
    box-shadow: none;
}
.btn-p:hover{


    color: #fff;
    background-color: #4884ea;
    border-color: #4884ea;
    box-shadow: none;
}

label{
    font-size: 16px;
}
.photoHeader{
        border: 1px solid #dae1e7;
            margin-left: 1rem;
    margin-right: 2rem;
    padding: 13px;
}
.card-header{
    border-bottom: none;
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
/* @media (max-width: 800px)
{
.col-lg-9 {
    -ms-flex: 0 0 75%;
    flex: 0 0 75%;
    max-width: 75%;
}
.col-lg-3{
       display: contents ; 
    }
} */
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
    .photoHeader{
        border:none;
          
    padding: 13px;
}
.btn-p{
    width: 337px;
    margin-right: 0px;
    margin-bottom: 5px;
    
    }


}


    </style>
    <!-- Page Title-->
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-9 sidebar_heading">
           <h1 class="h3  mb-0 folot-left headerTitle">PROFILE INFO</h1>
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

        <div class="card-header">
            <div class="row photoHeader">

                
                       <img style=" border-radius: 50px;   margin-left: 7px;" height="80" width="80" class="rounded-circle border"
                            src="{{asset('public/assets/front-end')}}/img/contacts/blank.jpg"
                            >
                
                <div class="col-md-10">
                    
                <h5 class="font-name">Abdur Rhim</h5>
                <a href="" class="spandHeadO"><span> Change Your Profile</span></a>
                </div>

            </div>
         
        </div>
        <div class="card-body ml-3">
            <h3 class="font-nameA">Accounting Information</h3>
            <form class="mt-3">
                   <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="firstName">First Name</label>
                  <input type="text" class="form-control" id="firstName" placeholder="">
                </div>
                <div class="form-group col-md-6">
                  <label for="lastName">Last Name</label>
                  <input type="text" class="form-control" id="lastName" placeholder="">
                </div>
              </div>
                 <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Email</label>
                  <input type="email" class="form-control" id="inputEmail4" placeholder="">
                </div>
                <div class="form-group col-md-6">
                  <label for="phone">Phone Number</label>
                  <input type="password" class="form-control" id="phone" placeholder="">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="oldPass">Old Password</label>
                  <input type="email" class="form-control" id="oldPass" placeholder="">
                </div>
                <div class="form-group col-md-6">
                  <label for="newPass">New Password</label>
                  <input type="password" class="form-control" id="newPass" placeholder="">
                </div>
              </div>
 



  <button type="submit" class="btn btn-p float-right">Update Information</button>
</form>
        </div>
          
          </div>


            </section>

                </div>
     
          
        </div>
    </div>

@endsection

