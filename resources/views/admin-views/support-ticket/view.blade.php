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
            width: 48px;
            height: 23px;
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
            height: 15px;
            width: 15px;
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
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('messages.Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{trans('messages.support_ticket')}}</li>
            </ol>
        </nav>


        <div class="row" style="margin-top: 20px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between pl-4 pr-4">
                            <div>
                                <h5>{{trans('messages.support_ticket')}}</h5>
                            </div>
                            <div>
                                <!-- Modal -->
                                <div class="modal fade" id="addCurrency" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="exampleModalLabel">{{trans('messages.Currency')}}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="#" method="post">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="text" name="name" class="form-control"
                                                                       id="name" placeholder="Enter currency Name">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="text" name="symbol" class="form-control"
                                                                       id="symbol" placeholder="Enter currency symbol">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="text" name="code" class="form-control"
                                                                       id="code" placeholder="Enter currency code">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="number" name="exchange_rate"
                                                                       class="form-control" id="exchange_rate"
                                                                       placeholder="Enter currency exchange rate">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group text-center">
                                                        <button type="submit" id="add" class="btn btn-primary"
                                                                style="color: white">{{trans('messages.Save')}}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body" style="padding: 0">
                        <div class="table-responsive">
                            <table id="datatable"
                                   class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                                   style="width: 100%">
                                <thead class="thead-light">
                                <tr class="text-center">
                                    <th>{{trans('messages.SL#')}}</th>
                                    <th>{{trans('messages.Subject')}}</th>
                                    <th>{{trans('messages.Priority')}}</th>
                                    <th>{{trans('messages.Status')}}</th>
                                    <th>{{trans('messages.Action')}}</th>
                                </tr>
                                </thead>
                                <?php
                                $i = 1;
                                ?>
                                <tbody>
                                @foreach($tickets as $key =>$ticket)
                                    <tr class="text-center">
                                        <td>{{$i++}}</td>
                                        <td>{{$ticket->subject}}</td>
                                        <td>{{$ticket->priority}}</td>
                                        <td><label class="switch"><input type="checkbox" class="status"
                                                                         id="{{$ticket->id}}" <?php if ($ticket->status == 'open') echo "checked" ?>><span
                                                    class="slider round"></span></label></td>
                                        <td>
                                            <a href="{{route('admin.support-ticket.singleTicket',$ticket['id'])}}"
                                               class="btn btn-primary   btn-sm">{{trans('messages.View')}}</a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{$tickets->links()}}
                    </div>
                </div>
            </div>
        @endsection

        @push('script')
            <!-- Page level plugins -->
                <script src="{{asset('public/assets/back-end')}}/vendor/datatables/jquery.dataTables.min.js"></script>
                <script
                    src="{{asset('public/assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

                <script>
                    // Call the dataTables jQuery plugin
                    $(document).ready(function () {
                        $('#dataTable').DataTable();
                    });
                </script>

                <!-- Page level custom scripts -->
                <script src="{{asset('public/assets/back-end/js/croppie.js')}}"></script>
                <script>
                    $(document).on('change', '.status', function () {
                        var id = $(this).attr("id");
                        if ($(this).prop("checked") == true) {
                            var status = 'open';
                        } else if ($(this).prop("checked") == false) {
                            var status = 'close';
                        }

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{route('admin.support-ticket.status')}}",
                            method: 'POST',
                            data: {
                                id: id,
                                status: status
                            },
                            success: function () {
                                toastr.success('Ticket closed successfully');
                            }
                        });
                    });
                </script>
    @endpush
