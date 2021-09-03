@extends('layouts.back-end.app')

@section('title','Brand List')

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('messages.Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{trans('messages.Dashboard')}}</li>
            </ol>
        </nav>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0 text-black-50">{{trans('messages.brand_list')}}</h1>
        </div>

        <div class="row" style="margin-top: 20px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ trans('messages.brand_table')}}</h5>
                    </div>
                    <div class="card-body" style="padding: 0">
                        <div class="table-responsive">
                            <table
                                class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="width: 100px">
                                        {{ trans('messages.brand')}} {{ trans('messages.ID')}}
                                    </th>
                                    <th scope="col">{{ trans('messages.name')}}</th>
                                    <th scope="col">{{ trans('messages.image')}}</th>
                                    <th scope="col" style="width: 100px" class="text-center">
                                        {{ trans('messages.action')}}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($br as $k=>$b)
                                    <tr>
                                        <td class="text-center">{{$b['id']}}</td>
                                        <td>{{$b['name']}}</td>
                                        <td>
                                            <img style="width: 60px;height: 60px"
                                                 onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                 src="{{asset('storage/app/public/brand')}}/{{$b['image']}}">
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-sm"
                                               href="{{route('admin.brand.update',[$b['id']])}}">
                                                <i class="tio-edit"></i> {{ trans('messages.Edit')}}
                                            </a>
                                            <a class="btn btn-danger btn-sm delete"
                                               id="{{$b['id']}}">
                                                <i class="tio-add-to-trash"></i> {{ trans('messages.Delete')}}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{$br->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).on('click', '.delete', function () {
            var id = $(this).attr("id");
            Swal.fire({
                title: 'Are you sure delete this brand?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{route('admin.brand.delete')}}",
                        method: 'POST',
                        data: {id: id},
                        success: function () {
                            toastr.success('Brand deleted successfully');
                            location.reload();
                        }
                    });
                }
            })
        });
    </script>
@endpush
