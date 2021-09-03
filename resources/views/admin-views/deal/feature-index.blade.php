@extends('layouts.back-end.app')
@section('title','Feature Deal')
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('messages.Dashboard')}}</a></li>
            <li class="breadcrumb-item" aria-current="page"> {{ trans('messages.feature_deal')}}</li>

        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ trans('messages.deal_form')}}
                </div>
                <div class="card-body">
                    <form action="{{route('admin.deal.flash')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <input type="text" name="deal_type" value="feature_deal"  class="d-none">
                                <div class="col-md-12">

                                    <label for="name">{{ trans('messages.Title')}}</label>
                                    <input type="text" name="title" required class="form-control" id="title"
                                           placeholder="Ex : LUX">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">{{ trans('messages.start_date')}}</label>
                                    <input type="date" name="start_date" required class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="name">{{ trans('messages.end_date')}}</label>
                                    <input type="date" name="end_date" required class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit"
                                    class="btn btn-primary ">{{ trans('messages.save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--modal-->

    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ trans('messages.feature_deal')}} {{ trans('messages.Table')}}</h5>
                </div>
                <div class="card-body" style="padding: 0">
                    <div class="table-responsive">
                        <table id="datatable"
                               class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                               style="width: 100%">
                            <thead class="thead-light">
                            <tr>
                                <th>{{ trans('messages.SL#')}}</th>
                                <th>{{ trans('messages.Title')}}</th>
                                <th>{{ trans('messages.Start')}}</th>
                                <th>{{ trans('messages.end')}}</th>
                                <th></th>
                                <th>{{ trans('messages.status')}}</th>
                                <th style="width: 50px">{{ trans('messages.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($flash_deals as $k=>$deal)
                                <tr>
                                    <th scope="row">{{$k+1}}</th>
                                    <td>{{$deal['title']}}</td>
                                    <td>{{$deal['start_date']}}</td>
                                    <td>{{$deal['end_date']}}</td>
                                    <td>
                                        <a href="{{route('admin.deal.add-product',[$deal['id']])}}"
                                           class="btn btn-primary btn-sm">
                                            Add Product
                                        </a>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" class="status"
                                                   id="{{$deal['id']}}" {{$deal->status == 1?'checked':''}}>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.deal.edit',[$deal['id']])}}"
                                           class="btn btn-primary btn-sm">
                                           {{ trans ('Edit')}}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{$flash_deals->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        $(document).on('change', '.featured', function () {
            var id = $(this).attr("id");
            if ($(this).prop("checked") == true) {
                var featured = 1;
            } else if ($(this).prop("checked") == false) {
                var featured = 0;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.deal.featured-update')}}",
                method: 'POST',
                data: {
                    id: id,
                    featured: featured
                },
                success: function () {
                    toastr.success('Status updated successfully');
                    // location.reload();
                }
            });
        });
        $(document).on('change', '.status', function () {
            var id = $(this).attr("id");
            if ($(this).prop("checked") == true) {
                var status = 1;
            } else if ($(this).prop("checked") == false) {
                var status = 0;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.deal.feature-status')}}",
                method: 'POST',
                data: {
                    id: id,
                    status: status
                },
                success: function () {
                    toastr.success('Status updated successfully');
                    location.reload();
                }
            });
        });

    </script>

    <!-- Page level custom scripts -->

    <script>
        $(document).ready(function () {
            // color select select2
            $('.color-var-select').select2({
                templateResult: colorCodeSelect,
                templateSelection: colorCodeSelect,
                escapeMarkup: function (m) {
                    return m;
                }
            });

            function colorCodeSelect(state) {
                var colorCode = $(state.element).val();
                if (!colorCode) return state.text;
                return "<span class='color-preview' style='background-color:" + colorCode + ";'></span>" + state.text;
            }
        });
    </script>
@endpush
