@extends('layouts.back-end.app')

@section('title','Sub Sub Category')

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('messages.Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{trans('messages.category')}}</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ trans('messages.sub_sub_category_form')}}
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.sub-sub-category.store')}}" method="POST">
                            @csrf
                            @php($language=\App\Model\BusinessSetting::where('type','pnc_language')->first())
                            @php($language = $language->value ?? null)
                            @php($default_lang = 'en')
                            @if($language)
                                @php($default_lang = json_decode($language)[0])
                                <ul class="nav nav-tabs mb-4">
                                    @foreach(json_decode($language) as $lang)
                                        <li class="nav-item">
                                            <a class="nav-link lang_link {{$lang == $default_lang? 'active':''}}"
                                               href="#"
                                               id="{{$lang}}-link">{{\App\CPU\Helpers::get_language_name($lang).'('.strtoupper($lang).')'}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="row">
                                    @foreach(json_decode($language) as $lang)
                                        <div
                                            class="col-12 form-group {{$lang != $default_lang ? 'd-none':''}} lang_form"
                                            id="{{$lang}}-form">
                                            <label class="input-label"
                                                   for="exampleFormControlInput1">Sub {{trans('messages.sub_category')}} {{trans('messages.name')}}
                                                ({{strtoupper($lang)}})</label>
                                            <input type="text" name="name[]" class="form-control"
                                                   placeholder="New Sub Sub Category" {{$lang == $default_lang? 'required':''}}>
                                        </div>
                                        <input type="hidden" name="lang[]" value="{{$lang}}">
                                    @endforeach
                                    @else
                                        <div class="col-12">
                                            <div class="form-group lang_form" id="{{$default_lang}}-form">
                                                <label
                                                    class="input-label">Sub {{trans('messages.sub_category')}} {{trans('messages.name')}}
                                                    ({{strtoupper($lang)}})</label>
                                                <input type="text" name="name[]" class="form-control"
                                                       placeholder="New Sub Category" required>
                                            </div>
                                            <input type="hidden" name="lang[]" value="{{$default_lang}}">
                                        </div>
                                    @endif

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label
                                                class="input-label">{{trans('messages.main')}} {{trans('messages.category')}}
                                                <span class="input-label-secondary">*</span></label>
                                            <select class="form-control" id="cat_id" required>
                                                <option value="0">---select---</option>
                                                @foreach(\App\Model\Category::where(['position'=>0])->get() as $category)
                                                    <option
                                                        value="{{$category['id']}}">{{$category['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label
                                            for="name">{{trans('messages.sub_category')}} {{trans('messages.name')}}</label>
                                        <select name="parent_id" id="parent_id" class="form-control">

                                        </select>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <button type="submit"
                                                class="btn btn-primary">{{trans('messages.submit')}}</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 20px" id="cate-table">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ trans('messages.sub_sub_category_table')}}</h5>
                    </div>
                    <div class="card-body" style="padding: 0">
                        <div class="table-responsive">
                            <table
                                class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="width: 120px">{{ trans('messages.category')}} {{ trans('messages.ID')}}</th>
                                    <th scope="col">{{ trans('messages.sub_sub_category_name')}}</th>
                                    <th scope="col">{{ trans('messages.slug')}}</th>
                                    <th scope="col" class="text-center"
                                        style="width: 120px">{{ trans('messages.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $key=>$category)
                                    <tr>
                                        <td class="text-center">{{$category['id']}}</td>
                                        <td>{{$category['name']}}</td>
                                        <td>{{$category['slug']}}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm edit" style="cursor: pointer;"
                                               href="{{route('admin.category.edit',[$category['id']])}}">
                                                <i class="tio-edit"></i>{{ trans('messages.Edit')}}
                                            </a>
                                            <a class="btn btn-danger btn-sm delete" style="cursor: pointer;"
                                               id="{{$category['id']}}">
                                                <i class="tio-add-to-trash"></i>{{ trans('messages.Delete')}}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{$categories->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- Page level plugins -->
    <script src="{{asset('public/assets/back-end')}}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('public/assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script>
        $(".lang_link").click(function (e) {
            e.preventDefault();
            $(".lang_link").removeClass('active');
            $(".lang_form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            let lang = form_id.split("-")[0];
            console.log(lang);
            $("#" + lang + "-form").removeClass('d-none');
            if (lang == '{{$default_lang}}') {
                $(".from_part_2").removeClass('d-none');
            } else {
                $(".from_part_2").addClass('d-none');
            }
        });

        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>

    <script>
        $('#cat_id').on('change', function () {
            var id = $(this).val();
            if (id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '{{route('admin.sub-sub-category.getSubCategory')}}',
                    data: {
                        id: id
                    },
                    success: function (result) {
                        $("#parent_id").html(result);
                    }
                });
            }
        });

        $(document).on('click', '.delete', function () {
            var id = $(this).attr("id");
            Swal.fire({
                title: 'Are you sure to delete this?',
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
                        url: "{{route('admin.sub-sub-category.delete')}}",
                        method: 'POST',
                        data: {id: id},
                        success: function () {
                            toastr.success('Sub Sub Category deleted Successfully.');
                            location.reload();
                        }
                    });
                }
            })
        });
    </script>
@endpush
