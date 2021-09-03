@extends('layouts.front-end.app')

@section('title','Contact Us')

@push('css_or_js')
    <meta property="og:image" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="og:title" content="Contact {{$web_config['name']->value}} "/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <meta property="twitter:card" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="twitter:title" content="Contact {{$web_config['name']->value}}"/>
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <style>
        .headerTitle {
            font-size: 25px;
            font-weight: 700;
            margin-top: 2rem;
        }

        .for-contac-image {
            padding: 6%;
        }

        .for-send-message {
            padding: 26px;
            margin-bottom: 2rem;
            margin-top: 2rem;
        }

        @media (max-width: 600px) {
            .sidebar_heading {
                background: {{$web_config['primary_color']}}

            }

            .headerTitle {

                font-weight: 700;
                margin-top: 1rem;
            }

            .sidebar_heading h1 {
                text-align: center;
                color: aliceblue;
                padding-bottom: 17px;
                font-size: 19px;
            }
        }
    </style>
@endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 sidebar_heading text-center mb-2">
                <h1 class="h3  mb-0 folot-left headerTitle">{{trans('messages.contact_bold')}}</h1>
            </div>
        </div>
    </div>

    <!-- Split section: Map + Contact form-->
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-6 iframe-full-height-wrap ">
                <img style="" class="for-contac-image" src="{{asset("storage/app/public/png/contact.png")}}" alt="">
            </div>
            <div class="col-lg-6 for-send-message px-4 px-xl-5  box-shadow-sm">
                <h2 class="h4 mb-4 text-center"
                    style="color: #030303; font-weight:600;">{{trans('messages.send_us_a_message')}}</h2>
                    <form action="" method="POST" id="contactForm">
                        @csrf
                        <div class="row">
                          <div class="col-sm-6">
                              <div class="form-group">
                                <label >{{trans('messages.your_name')}}</label>
                                <input class="form-control name" name="name" type="text" placeholder="John Doe" required>

                              </div>
                            </div>
                          <div class="col-sm-6">
                              <div class="form-group">
                                <label for="cf-email">{{trans('messages.email_address')}}</label>
                                <input class="form-control email" name="email" type="email" placeholder="johndoe@email.com" required >

                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="cf-phone">{{trans('messages.your_phone')}}</label>
                                <input class="form-control mobile_number"  type="text" name="mobile_number" placeholder="Contact Number" required>

                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="cf-subject">{{trans('messages.Subject')}}:</label>
                                <input class="form-control subject" type="text" name="subject"  placeholder="Short title" required>

                              </div>
                            </div>
                             <div class="col-md-12">
                            <div class="form-group">
                              <label for="cf-message">{{trans('messages.Message')}}</label>
                              <textarea class="form-control message" name="message"  rows="6" placeholder="Please describe in detail your request" required></textarea>

                            </div>
                          </div>
                        </div>
                        <div class=" ">
                          <button class="btn btn-primary" type="submit"  id="submit">Send message</button>
                      </div>
                    </form>
            </div>
        </div>
    </div>

@endsection


@push('script')
<script type="text/javascript">

$('#contactForm').on('submit',function(event){
    event.preventDefault();

    name = $('.name').val();
    email = $('.email').val();
    mobile_number = $('.mobile_number').val();
    subject = $('.subject').val();
    message = $('.message').val();

    $.ajax({
      url: "{{route('admin.contact.store')}}",
      type:"POST",
      data:{
        "_token": "{{ csrf_token() }}",
        name:name,
        email:email,
        mobile_number:mobile_number,
        subject:subject,
        message:message,
      },
      success:function(response){
        toastr.success(response.success);
        $('#contactForm').trigger('reset');
        $('.invalid-feedback').remove();
        // window.location.reload();


      },
       });
    });
  </script>
@endpush
