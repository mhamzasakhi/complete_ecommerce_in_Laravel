@extends('layouts.back-end.app')
@section('title','Deal Page')
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
            <li class="breadcrumb-item" aria-current="page">{{trans('messages.deal_of_the_day')}}</li>
            <li class="breadcrumb-item">{{trans('messages.add_new')}}</li>
        </ol>
    </nav>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Deal of the day form
                </div>
                <div class="card-body">
                    <form action="{{route('admin.deal.day')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name">{{ trans('messages.Title')}}</label>
                                    <input type="text" name="title" required class="form-control" id="title"
                                           placeholder="Ex : LUX">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name">{{ trans('messages.Products')}}</label>
                                    <select
                                        class="js-example-basic-multiple js-states js-example-responsive form-control"
                                        name="product_id">
                                        @foreach (\App\Model\Product::orderBy('name', 'asc')->get() as $key => $product)
                                            <option value="{{ $product->id }}">
                                                {{$product['name']}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer pl-0">
                            <button type="submit"
                                    class="btn btn-primary ">{{ trans('messages.save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ trans('messages.deal_of_the_day')}}</h5>
                </div>
                <div class="card-body" style="padding: 0">
                    <div class="table-responsive">
                        <table id="datatable"
                               class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                               style="width: 100%">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ trans('messages.sl')}}</th>
                                <th scope="col">{{ trans('messages.title')}}</th>
                                {{--<th scope="col">{{ trans('messages.discount')}}</th>
                                <th scope="col">{{ trans('messages.discount_type')}}</th>--}}
                                <th scope="col">{{ trans('messages.status')}}</th>
                                <th scope="col" style="width: 100px">{{ trans('messages.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($deals as $k=>$deal)
                                <tr>
                                    <th scope="row">{{$k+1}}</th>
                                    <td>{{$deal['title']}}</td>
                                    {{--<td>{{$deal['discount_type']=='amount'?\App\CPU\BackEndHelper::usd_to_currency($deal['discount']):$deal['discount']}}</td>
                                    <td>{{$deal['discount_type']}}</td>--}}
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" class="status"
                                                   id="{{$deal['id']}}" {{$deal->status == 1?'checked':''}}>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.deal.day-update',[$deal['id']])}}"
                                           class="btn btn-primary btn-sm">
                                           {{ trans ('Edit')}}
                                        </a>
                                        <a href="{{route('admin.deal.day-delete',[$deal['id']])}}"
                                           class="btn btn-danger btn-sm">
                                           {{ trans ('Delete')}}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{$deals->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')

    <script>
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
                url: "{{route('admin.deal.day-status-update')}}",
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
@endpush
