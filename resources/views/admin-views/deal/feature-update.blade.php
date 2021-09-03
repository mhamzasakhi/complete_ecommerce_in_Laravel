@extends('layouts.back-end.app')
@section('title','Feature Deal Update')
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
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{ trans('messages.Dashboard')}}</a></li>
            <li class="breadcrumb-item" aria-current="page">{{ trans('messages.feature_deal')}}</li>
            <li class="breadcrumb-item">Update Deal</li>
        </ol>
    </nav>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ trans('messages.deal_form')}}
                </div>
                <div class="card-body">
                    <form action="{{route('admin.deal.update',[$deal['id']])}}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <input type="text" name="deal_type" value="feature_deal"  class="d-none">
                                <div class="col-md-12">
                                    <label for="name">{{ trans('messages.title')}}</label>
                                    <input type="text" name="title" value="{{$deal->title}}" required
                                           class="form-control" id="title"
                                           placeholder="Ex : LUX">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">{{ trans('messages.start_date')}}</label>
                                    <input type="date" value="{{date('Y-m-d',strtotime($deal['start_date']))}}" name="start_date" required
                                           class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="name">{{ trans('messages.end_date')}}</label>
                                    <input type="date" value="{{date('Y-m-d', strtotime($deal['end_date']))}}" name="end_date" required
                                           class="form-control">
                                </div>
                            </div>

                        </div>

                        <div class="card-footer pl-0">
                            <button type="submit"
                                    class="btn btn-primary ">{{ trans('messages.update')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection

@push('script')
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
