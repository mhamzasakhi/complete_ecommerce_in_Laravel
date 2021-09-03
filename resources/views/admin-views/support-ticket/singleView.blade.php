@extends('layouts.back-end.app')
@section('title','Support Ticket')
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{asset('public/assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{asset('public/assets/back-end/css/croppie.css')}}" rel="stylesheet">
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #377dff;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #377dff;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
@endpush

@section('content')
<div class="content container-fluid"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Support Tickets</li>
        </ol>
    </nav>

    @foreach($supportTicket as $ticket )
        <?php
        $userDetails = \App\User::where('id', $ticket['customer_id'])->first();
        $conversations = \App\Model\SupportTicketConv::where('support_ticket_id', $ticket['id'])->get();
        $admin = \App\Model\Admin::get();
        ?>
        <div class="media pb-4">
            <img class="rounded-circle" style="width: 40px; height:40px;"
                 src="{{asset('storage/app/public/profile')}}/{{$userDetails['image']}}"
                 alt="{{$userDetails['name']}}"/>
            <div class="media-body pl-3">
                <h6 class="font-size-md mb-2">{{$userDetails['name']}}</h6>
                <p class="font-size-md mb-1">{{$ticket['description']}}</p>
                <span class="font-size-ms text-muted">
                             <i class="czi-time align-middle mr-2">{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$ticket['created_at'])->format('Y-m-d h:i A')}}</i></span>
            </div>
        </div>
        @foreach($conversations as $conversation)
            @if($conversation['admin_message'] ==null )
                <div class="media pb-4">
                    <img class="rounded-circle" style="width: 40px; height:40px;"
                         src="{{asset('storage/app/public/profile')}}/{{$userDetails['image']}}"
                         alt="{{$userDetails['name']}}"/>
                    <div class="media-body pl-3">
                        <h6 class="font-size-md mb-2">{{$userDetails['name']}}</h6>
                        <p class="font-size-md mb-1">{{$conversation['customer_message']}}</p>
                        <span class="font-size-ms text-muted">
                         <i class="czi-time align-middle mr-2"></i>{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$conversation['created_at'])->format('Y-m-d h:i A')}}</span>
                    </div>
                </div>
            @endif
            @if($conversation['customer_message'] ==null )
                <div class="media pb-4 " style="text-align: right">
                    <div class="media-body pl-3 ">
                        <h6 class="font-size-md mb-2"></h6>
                        <p class="font-size-md mb-1">{{$conversation['admin_message']}}</p>
                        <span
                            class="font-size-ms text-muted"> {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$conversation['updated_at'])->format('Y-m-d h:i A')}}</span>
                    </div>
                </div>
            @endif
        @endforeach

    @endforeach
    <!-- Leave message-->
    <h3 class="h5 mt-2 pt-4 pb-2">Leave a Message</h3>
    @foreach($supportTicket as $reply)
        <form class="needs-validation" href="{{route('admin.support-ticket.replay',$reply['id'])}}" method="post"
              novalidate>
            @csrf
            <input type="hidden" name="id" value="{{$reply['id']}}">
            <input type="hidden" name="adminId" value="1">
            <div class="form-group">
                <textarea class="form-control" name="replay" rows="8" placeholder="Write your message here..."
                          required></textarea>
                <div class="invalid-tooltip">Please write the message!</div>
            </div>
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="custom-control custom-checkbox d-block">
                </div>
                <button class="btn btn-primary my-2" type="submit">Submit Reply</button>
            </div>
        </form>
    @endforeach

</div>
@endsection

@push('script')
    <!-- Page level plugins -->
    <script src="{{asset('public/assets/back-end')}}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('public/assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('public/assets/back-end')}}/js/demo/datatables-demo.js"></script>
    <script src="{{asset('public/assets/back-end/js/croppie.js')}}"></script>

@endpush
