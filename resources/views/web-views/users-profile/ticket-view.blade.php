@extends('layouts.front-end.app')

@section('title','Support Ticket')

@push('css_or_js')
    <style>
        .headerTitle {
            font-size: 24px;
            font-weight: 600;
            margin-top: 1rem;
        }

        body {
            font-family: 'Titillium Web', sans-serif
        }

        .product-qty span {
            font-size: 14px;
            color: #6A6A6A;
        }

        .font-nameA {
            font-weight: 600;
            display: inline-block;
            margin-bottom: 0;
            font-size: 17px;
            color: #030303;
        }

        .spandHeadO {
            color: #FFFFFF !important;
            font-weight: 600 !important;
            font-size: 14px !important;

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

        .modal-footer {
            border-top: none;
        }

        .sidebarL h3:hover + .divider-role {
            border-bottom: 3px solid {{$web_config['primary_color']}}                !important;
            transition: .2s ease-in-out;
        }

        .marl {
            margin-left: 7px;
        }
        .badge-warning{
            color:white;
            background: {{$web_config['primary_color']}};

        }
        .badge-secondary{
            color:white;
            background: {{$web_config['secondary_color']}};
        }
        ..badge-success {

        }

         .for-margin-sms{
            margin-left: 56.3333333333%;
         }
         @media(max-width:475px){
            .for-margin-sms {
            margin-left: 0.333333%;
           }
         }
        @media (max-width: 600px) {
            .sidebar_heading {
                background: {{$web_config['primary_color']}}





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
    <!-- Page Title-->
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-9 sidebar_heading">
                <h1 class="h3  mb-0 folot-left headerTitle">{{trans('messages.SUPPORT TICKET ANSWER')}}</h1>
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
                <div
                    class="d-none d-lg-flex justify-content-between align-items-center pt-lg-3 pb-4 pb-lg-5 mb-lg-4">
                    <div class="d-flex w-100 text-light text-center mr-3">
                        <div class="font-size-ms px-3">
                            <div class="font-weight-medium">{{trans('messages.Date Submitted')}}</div>
                            <div
                                class="opacity-60">{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$ticket['created_at'])->format('Y-m-d')}}</div>
                        </div>
                        <div class="font-size-ms px-3">
                            <div class="font-weight-medium">{{trans('messages.Last Updated')}}</div>
                            <div
                                class="opacity-60">{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$ticket['updated_at'])->format('Y-m-d')}}</div>
                        </div>
                        <div class="font-size-ms px-3">
                            <div class="font-weight-medium">{{trans('messages.Type')}}</div>
                            <div class="opacity-60">{{$ticket['type']}}</div>
                        </div>
                        <div class="font-size-ms px-3">
                            <div class="font-weight-medium" style="color:black">{{trans('messages.Priority')}}</div>
                            <span class="badge badge-warning">{{$ticket['priority']}}</span>
                        </div>
                        <div class="font-size-ms px-3">
                            <div class="font-weight-medium" style="color: black">{{trans('messages.Status')}}</div>
                            @if($ticket['status']=='open')
                                <span class="badge badge-secondary">{{$ticket['status']}}</span>
                            @else
                                <span class="badge badge-secondary">{{$ticket['status']}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Ticket details (visible on mobile)-->
                <div class="d-flex d-lg-none flex-wrap bg-secondary text-center rounded-lg pt-4 px-4 pb-1 mb-4">
                    <div class="font-size-sm px-3 pb-3">
                        <div class="font-weight-medium">{{trans('messages.Date Submitted')}}</div>
                        <div
                            class="text-muted">{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$ticket['created_at'])->format('Y-m-d')}}</div>
                    </div>
                    <div class="font-size-sm px-3 pb-3">
                        <div class="font-weight-medium">{{trans('messages.Last Updated')}}</div>
                        <div
                            class="text-muted">{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$ticket['updated_at'])->format('Y-m-d')}}</div>
                    </div>
                    <div class="font-size-sm px-3 pb-3">
                        <div class="font-weight-medium">{{trans('messages.Type')}}</div>
                        <div class="text-muted">{{$ticket['type']}}</div>
                    </div>
                    <div class="font-size-sm px-3 pb-3">
                        <div class="font-weight-medium">{{trans('messages.Priority')}}</div>
                        <span class="badge badge-warning">{{$ticket['priority']}}</span>
                    </div>
                    <div class="font-size-sm px-3 pb-3">
                        <div class="font-weight-medium">{{trans('messages.Status')}}</div>
                        @if($ticket['status']=='open')
                            <span class="badge btn btn-secondary">{{$ticket['status']}}</span>
                        @else
                            <span class="badge btn btn-secondary">{{$ticket['status']}}</span>
                        @endif
                    </div>
                </div>
                <!-- Comment-->

                {{-- <div class="media pb-4" style="text-align: right;">

                </div> --}}
                <div class="col-sm-6 col-lg-5 media pb-4  for-margin-sms">
                    <img class="rounded-circle" style="text-align: right; height:40px; width:40px;" 
                         onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                         src="{{asset('storage/app/public/profile')}}/{{auth('customer')->user()->image}}"
                         alt="{{auth('customer')->user()->f_name}}"/>
                    <div class="media-body pl-3">
                        <h6 class="font-size-md mb-2">{{auth('customer')->user()->f_name}}</h6>
                        <p class="font-size-md mb-1">{{$ticket['description']}}</p>
                        <span class="font-size-ms text-muted">
                                 <i class="czi-time align-middle mr-2"></i>
                            {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$ticket['created_at'])->format('Y-m-d h:i A')}}
                        </span>
                    </div>
                </div>
                @foreach($ticket->conversations as $conversation)
{{--                    {{dd($conversation)}}--}}
                    @if($conversation['customer_message'] == null )
                        <div class="media pb-4 ">
                            <div class="media-body pl-3 ">
                                @php($admin=\App\Model\Admin::where('id',$conversation['admin_id'])->first())
                                <h6 class="font-size-md mb-2">{{$admin['name']}}</h6>
                                <p class="font-size-md mb-1">{{$conversation['admin_message']}}</p>
                                <span
                                    class="font-size-ms text-muted"> {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$conversation['updated_at'])->format('Y-m-d h:i A')}}</span>
                            </div>
                        </div>
                    @endif
                    @if($conversation['admin_message'] == null)
                        <div class="col-sm-6 col-lg-5 media pb-4 for-margin-sms">
                            <img class="rounded-circle" height="40" width="40"
                                 onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                 src="{{asset('storage/app/public/profile')}}/{{auth('customer')->user()->image}}"
                                 alt="{{auth('customer')->user()->f_name}}"/>
                            <div class="media-body pl-3">
                                <h6 class="font-size-md mb-2">{{auth('customer')->user()->f_name}}</h6>
                                <p class="font-size-md mb-1">{{$conversation['customer_message']}}</p>
                                <span class="font-size-ms text-muted">
                                             <i class="czi-time align-middle mr-2"></i>
                                    {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$conversation['created_at'])->format('Y-m-d h:i A')}}
                                </span>
                            </div>
                        </div>
                @endif
            @endforeach
            <!-- Leave message-->
                <div class="col-sm-12">
                    <h3 class="h5 mt-2 pt-4 pb-2">{{trans('messages.Leave a Message')}}</h3>
                    <form class="needs-validation" href="{{route('support-ticket.comment',[$ticket['id']])}}"
                          method="post" novalidate>
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="comment" rows="8"
                                      placeholder="Write your message here..." required></textarea>
                            <div class="invalid-tooltip">{{trans('messages.Please write the message')}}!</div>
                        </div>
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                            <div class="">
                                <a href="{{route('support-ticket.close',[$ticket['id']])}}" class="btn btn-secondary"
                                   style="color: white">{{trans('messages.close')}}</a>
                            </div>
                            <button class="btn btn-primary my-2" type="submit">{{trans('messages.Submit message')}}</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>

@endsection

@push('script')

@endpush
