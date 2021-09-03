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
    font-size: 15px;
    color: #030303;
    background: #F2F8FF;
    padding: 13px;
    border-radius: 6px;
}
.amount{
    font-size: 15px;
     color:  #030303;
     font-weight: 400;
     margin-bottom: 5px;
     margin-top: 4px;


}

.tdBorder {
        border-right: 1px solid #f7f0f0;
    text-align: center;
}
.bodytr {
   border: 1px solid #dadada;
}
.sellerName {
        font-size: 15px;
    font-weight: 600;
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

//for -message
.container{max-width:1170px; margin:auto;}
img{ max-width:100%;}
.inbox_people {
  background: #ffffff none repeat scroll 0 0;
  float: left;
  overflow: hidden;
  width:; border-right:1px;
}
.inbox_msg {
    border: 1px solid #D8D8D8;
    clear: both;
    overflow: hidden;
    border-radius: 4px;
    padding-bottom: 40px;
}
}
.top_spac{ margin: 20px 0 0;}


.recent_heading {float: left; width:40%;}
.srch_bar {
  display: inline-block;
  color: #92C6FF;
  width: 100%; padding:
}
input {
 border: none;
  
}
.headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:none;}

.recent_heading h4 {
  color: #05728f;
  font-size: 21px;
  margin: auto;
}
.srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:100%; padding:2px 0 4px 6px; background:none;}
.srch_bar .input-group-addon button {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  padding: 0;
  color: #707070;
  font-size: 18px;
}
.srch_bar .input-group-addon { margin: 0 0 0 -27px;}

.chat_ib h5{ font-size:15px; font-size: 13px;
    color: #030303; 
    font-weight: 600; margin:0 0 8px 0;}
.chat_ib h5 span{ font-size: 80%;
    float: right;
    padding: 10px;
    background: #4884ea;
    color: white;
    border-radius: 100%;}
.chat_ib p{ font-size:14px; color:#989898; margin:auto}
.chat_img {
  float: left;
  width: 12%;
}
.chat_ib {
  float: left;
  padding: 0 0 0 15px;
  width: 88%;
  margin-top: 0.56rem;
}

.chat_people{ overflow:hidden; clear:both;}
.chat_list {
  border-bottom: none;
  margin: 0;
  padding: 18px 16px 10px;
}
.inbox_chat { height: 510px; overflow-y: scroll;}

.active_chat{ background:#ebebeb;}

.incoming_msg_img {
  display: inline-block;
  width: 6%;
}
.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
 }
 .received_withd_msg p {
    background: #E2F0FF none repeat scroll 0 0;
    border-radius: 10px;
    color: #030303;
    font-size: 14px;
    margin: 0;
    padding: 4px 8px 3px 10px;
    width: 100%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}
.received_withd_msg { width: 57%;}
.mesgs {
  float: left;
  padding: 30px 15px 0 25px;

}

 .sent_msg p {
  background: #4884ea  none repeat scroll 0 0;
  border-radius: 8px;
  font-size: 14px;
  margin: 0; color:#fff;
  padding: 5px 10px 5px 12px;
  width:100%;
}
.outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
.sent_msg {
  float: right;
  width: 46%;
}
.input_msg_write input {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 100%;
}

.type_msg {position: relative;}
.msg_send_btn {
  background none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: #4884ea;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 0;
  top: 11px;
  width: 33px;
}
.messaging {}
.msg_history {
  height: 516px;
  overflow-y: auto;
}
.faPadding {
    padding:16px;
}
.aSend{
    padding: 10px;
    color: #4884ea;
    font-size: 16px;
    font-weight: 600;
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
    .Chat{
        margin-top: 1.65rem;
    }
    .sidebarR{
        padding: 24px;
    }
    .price_sidebar{
        padding: 20px;
    }
    .sent_msg{
        margin-right: 7px;
    }
}

    </style>
    <!-- Page Title-->
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="sidebar_heading col-md-9">
               
                        <h1 class="h3  mb-0 folot-left headerTitle">SUPPORT TICKET</h1>
                    
            </div>
        </div>


    </div>

    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-4 mt-3">
        <div class="row mt-3">
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
            <div class="col-lg-3">
                <div class="card box-shadow-sm " style="padding: 17px;"> 
                    <span class="amount">Ticket submitted by</span>
                    <div class="font-name"><span>Abdur Rahim</span></div>

                    <span class="amount">Subject</span>
                    <div class="font-name"><span>Payment Issue</span></div>
                    <span class="amount">Type</span>
                    <div class="font-name"><span>Web Problem</span></div>
                </div>
                <br>
                <div class="card box-shadow-sm" style="padding: 17px;"> 
                  
                    <span class="amount">Supporting by</span>
                    <div class="font-name"><span >Abdur Rahim</span>
                       <div> <span class="amount">WEB DEVELOPER, Sixvely</span></div>
                    </div>
                </div>
            </div>
            <section class="col-lg-6 Chat">
              <div class="card box-shadow-sm">
              
              
                <div class="messaging">
                      <div class="inbox_msg">

                      
                        <div class="mesgs">
                          <div class="msg_history">
                            <div class="incoming_msg">
                              <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                              <div class="received_msg">
                                <div class="received_withd_msg">
                                  <p>Test which is a new approach to have all
                                    solutions</p>
                                  <span class="time_date"> 11:01 AM    |    June 9</span></div>
                              </div>
                            </div>
                            <div class="outgoing_msg">
                              <div class="sent_msg">
                                <p>Test which is a new approach to have all
                                  solutions</p>
                                <span class="time_date"> 11:01 AM    |    June 9</span> </div>
                            </div>
                            <div class="incoming_msg">
                              <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                              <div class="received_msg">
                                <div class="received_withd_msg">
                                  <p>Test, which is a new approach to have</p>
                                  <span class="time_date"> 11:01 AM    |    Yesterday</span></div>
                              </div>
                            </div>
                            <div class="outgoing_msg">
                              <div class="sent_msg">
                                <p>Feni Computer Instinute , Feni Feni Shodor</p>
                                <span class="time_date"> 11:01 AM    |    Today</span> </div>
                            </div>
                            <div class="incoming_msg">
                              <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                              <div class="received_msg">
                                <div class="received_withd_msg">
                                  <p>We work directly with our designers and suppliers,
                                    and sell direct to you, which means quality, exclusive
                                    products, at a price anyone can afford.</p>
                                  <span class="time_date"> 11:01 AM    |    Today</span></div>
                              </div>
                            </div>
                          </div>
                          <div class="type_msg">
                            <div class="input_msg_write"> 
                              <div class="card" style="border: 1px solid #F2F8FF;">
                             
                                <form class="form-inline d-flex justify-content-center md-form form-sm active-cyan-2 mt-2">
                                    <input class="form-control form-control-sm mr-3 w-75" type="text" placeholder="Send a message"
                                      aria-label="Search"><a href="" class="aSend">Send</a>
                                    <i class="fa fa-send" style="color: #92C6FF" aria-hidden="true"></i>
                                    
                                  </form>
                                  <hr>
                             <div class="card-header">
                                <a href=""> <i class="fa fa-smile-o fa-lg faPadding"></i></a>
                                 <a href=""><i class="fa fa-link fa-lg faPadding" aria-hidden="true"></i></a>
                          
                               <a href=""><i class="fa fa-text-height faPadding " aria-hidden="true"></i></a> 
                            </div>
                              </div>
                              
                             
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      
                   
                      
                    </div>
            
                   
                 </div>

            </section>

                </div>
     
          
        </div>
    </div>

@endsection

