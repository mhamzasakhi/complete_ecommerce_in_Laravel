
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

        body {
    font-family: 'Titillium Web', sans-serif
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
.font-nameA{
    font-weight: 600;
   display: inline-block;
    margin-bottom: 0;
    font-size: 17px;
    color: #030303;
}

.spandHead{
   color: #FFFFFF;
    font-weight: 600;
    font-size: 20px;
    margin-left: 25px;
}
.spandHeadO{
   color: #FFFFFF !important;
    font-weight: 600 !important;
    font-size: 14px !important;
    
}
.modal-header{
        border-top: 20px solid #4884ea;
        border-bottom: none;
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

.tdBorder {
        border-right: 1px solid #f7f0f0;
    text-align: center;
}
.bodytr {
   border: 1px solid #dadada;
   text-align: center;
}
.sellerName {
        font-size: 15px;
    font-weight: 600;
}
.modal-footer{
    border-top: none;
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
label{
    font-size: 15px;
    font-style: bold;
    margin-bottom: 8px;

}
.sidebarL{
    padding: ;
}
.marl{
    margin-left: 7px;
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
    .marl{
    margin-left: none !important;
}
    .sidebarR{
        padding: 24px;
    }
    .price_sidebar{
        padding: 20px;
    }
    .table th, .table td {
     padding: none !important;
}
}

    </style>
    <!-- Page Title-->
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-9 sidebar_heading">
               
                        <h1 class="h3  mb-0 folot-left headerTitle">SUPPORT TICKET</h1>
                    
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

                <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg  " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row">
            
                  <div class="col-md-12"> <h5 class="modal-title font-nameA ">Submit new ticket</h5></div>  
               
                 <div class="col-md-12" style=" color: #030303;  margin-top: 1rem;"><span >At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren</span></div>

            
              
        </div>
       
        
       
     
      </div>
      <div class="modal-body">
                   <form class="mt-3" method="post" action="{{route('ticket-submit')}}" id="open-ticket">
                    @csrf
                    <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="firstName">Subject</label>
                  <input type="text" class="form-control" id="ticket-subject" name="ticket_subject" required>
                </div>
              
              </div>
                 <div class="form-row">
                     <div class="form-group col-md-6">
                   <div class="">
                      <label class="" for="inlineFormCustomSelect">Type</label>
                      <select class="custom-select " id="ticket-type" name="ticket_type" required>
                        <option value>Choose type</option>
                        <option value="Website problem">Website problem</option>
                        <option value="Partner request">Partner request</option>
                        <option value="Complaint">Complaint</option>
                        <option value="Info inquiry">Info inquiry</option>
                      </select>
                    </div>
                </div>
                  <div class="form-group col-md-6">
                   <div class="">
                      <label class="" for="inlineFormCustomSelect">Priority</label>
                      <select class="form-control custom-select" id="ticket-priority" name="ticket_priority" required>
                        <option value>How urgent is your issue?</option>
                        <option value="Urgent">Urgent</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                    </div>
                </div>
              </div>
              <div class="form-row">
               <label for="detaaddressils">Describe your issue</label>
                  <textarea class="form-control" rows="6"  id="ticket-description" name="ticket_description" required placeholder="Enter Address" ></textarea>
              </div>
 


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-p">Submit a ticket</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="card box-shadow-sm">
  <div style="overflow: auto">         
         <table class="table table-bordered">
                   <thead>
                      <tr style="background: #92C6FF" >
                                      <td class="tdBorder">
                                      <div class="py-2"> <span class="d-block spandHeadO ">Topic</span></div>
                                    </td>
                                    <td class="tdBorder" >
                                        <div class="py-2 ml-2"> <span class="d-block spandHeadO ">Submition date</div>
                                    </td>
                                      <td class="tdBorder">
                                      <div class="py-2"> <span class="d-block spandHeadO">Type</span> </div>
                                    </td>
                                      <td class="tdBorder">
                                      <div class="py-2"> <span class="d-block spandHeadO"> Status</span> </div>
                                    </td>

                                  
                                  
                                      <td class="tdBorder">
                                        <div class="py-2"> <span class="d-block spandHeadO">Action </span> </div>
                                    </td>
                                </tr>
  </thead>
  
  <tbody>

                           <tr>

                                    <td class="bodytr font-weight-bold" style="color: #92C6FF;"><span class="marl">Payment Issus</span> </td>
                                  <td  class="bodytr"><span class="">12-12-2020 &nbsp; 10:00</span></td>                              
                                        <td  class="bodytr"><span class="">Payment</span></td>                                 
                                          <td  class="sellerName"><span class="">Urgent</span></td>
                                  
                                  <td  class="bodytr"> <a href=""  class=" marl"><i class="czi-trash" style="font-size: 25px; color:#e81616;" ></i></a> </td>

        
                                </tr> 
                                        <tr>

                                    <td class="bodytr font-weight-bold" style="color: #92C6FF;"><span class="marl">Payment Issus</span> </td>
                                  <td  class="bodytr"><span class="">12-12-2020 &nbsp; 10:00</span></td>                              
                                        <td  class="bodytr"><span class="">Payment</span></td>                                 
                                          <td  class="sellerName"><span class="">Urgent</span></td>
                                  
                                  <td  class="bodytr"> <a href=""  class=" marl"><i class="czi-trash" style="font-size:25px;  color:#e81616;" ></i></a> </td>

        
                                </tr> 
                                 <tr>

                                    <td class="bodytr font-weight-bold" style="color: #92C6FF;"><span class="marl">Payment Issus</span> </td>
                                  <td  class="bodytr"><span class="">12-12-2020 &nbsp; 10:00</span></td>                              
                                        <td  class="bodytr"><span class="">Payment</span></td>                                 
                                          <td  class="sellerName"><span class="">Urgent</span></td>
                                  
                                  <td  class="bodytr"> <a href=""  class=" marl"><i class="czi-trash" style="font-size:25px;  color:#e81616;" ></i></a> </td>

        
                                </tr> 

   
  </tbody>
              

            </table>

        </div>     
            
            </div> 
            <div class="mt-3">
                <button type="submit" class="btn btn-p float-right"  data-toggle="modal" data-target="#exampleModal">Add New Ticket</button>
                </div> 
         </section>

         </div>
        </div>
  
@endsection

