@extends('layouts.back-end.app')
@section('title','Coupon Edit')
@push('css_or_js')
    <link href="{{asset('public/assets/back-end')}}/css/select2.min.css" rel="stylesheet"/>
@endpush

@section('content')
<div class="content container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Coupon Update</li>
        </ol>
    </nav>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <dev class="card-header">
                    {{trans('messages.coupon_update_form')}}
                </dev>
                <div class="card-body">
                    <form action="{{route('admin.coupon.update',[$c['id']])}}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Type</label>
                                    <select class="js-example-responsive" name="coupon_type"
                                            style="width: 100%">
                                        {{--<option value="delivery_charge_free" {{$c['coupon_type']=='delivery_charge_free'?'selected':''}}>Delivery Charge Free</option>--}}
                                        <option value="discount_on_purchase" {{$c['coupon_type']=='discount_on_purchase'?'selected':''}}>Discount on Purchase</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="name">Title</label>
                                    <input type="text" name="title" value="{{$c['title']}}" class="form-control" id="title"
                                           placeholder="Title" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Code</label>
                                    <input type="text" name="code" value="{{$c['code']}}"
                                           class="form-control" id="code"
                                           placeholder="" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="name">Start Date</label>
                                    <input type="date" name="start_date" value="{{$c['start_date']}}" class="form-control" id="start date"
                                           placeholder="start date" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Expire date</label>
                                    <input type="date" name="expire_date" value="{{$c['expire_date']}}" class="form-control" id="expire date"
                                           placeholder="expire date" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="name">Minimum Purchase</label>
                                    <input type="number" min="1" max="1000000" name="min_purchase" value="{{\App\CPU\Convert::default($c['min_purchase'])}}" class="form-control" id="minimum purchase"
                                           placeholder="minimum purchase" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Discount</label>
                                    <input type="number" min="1" max="1000000" name="discount" value="{{$c['discount_type']=='amount'?\App\CPU\Convert::default($c['discount']):$c['discount']}}" class="form-control" id="discount"
                                           placeholder="discount" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="name">Discount Type</label>
                                    <select class="js-example-responsive" name="discount_type"
                                            onchange="checkDiscountType(this.value)"
                                            style="width: 100%">
                                        <option value="amount" {{$c['discount_type']=='amount'?'selected':''}}>Amount</option>
                                        <option value="percentage" {{$c['percentage']=='amount'?'selected':''}}>Percentage ( % )</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Maximum Discount</label>
                                    <input type="number" min="1" max="1000000" name="max_discount" value="{{\App\CPU\Convert::default($c['max_discount'])}}" class="form-control" id="maximum discount"
                                           placeholder="maximum discount" required>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{trans('messages.submit')}}</button>
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
        function checkDiscountType(val) {
            if (val == 'amount') {
                $('#max-discount').hide()
            } else if (val == 'percentage') {
                $('#max-discount').show()
            }
        }
    </script>
    <script src="{{asset('public/assets/back-end')}}/js/select2.min.js"></script>
    <script>
        $(".js-example-theme-single").select2({
            theme: "classic"
        });

        $(".js-example-responsive").select2({
            width: 'resolve'
        });
    </script>
@endpush
