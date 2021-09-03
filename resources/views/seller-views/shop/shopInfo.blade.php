@extends('layouts.back-end.app-seller')
@section('title','Shop view')
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{asset('public/assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="content container-fluid"> 
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="h3 mb-0  ">{{trans('messages.my_shop')}} {{trans('messages.Info')}} </h3>
            </div>
            <div class="card-body">
                <div class="row mt-2">
                    @if($shop->image=='def.png')
                    <div class="col-md-4">
                        <img height="200" width="200"  class="rounded-circle border"
                        src="{{asset('public/assets/back-end')}}/img/shop.png"
                        alt="User Pic">
                    </div>
                    
                    @else
                    
                        <div class="col-md-4">
                            <img src="{{asset('storage/app/public/shop/'.$shop->image)}}" class="rounded-circle border"
                            height="200" width="200" alt="">
                        </div>

                    
                    @endif
                 
                  
                    <div class="col-md-8 mt-4">
                        <h4>{{trans('messages.Name')}} : {{$shop->name}}</h4>
                        <h6>{{trans('messages.Phone')}} : {{$shop->contact}}</h6>
                        <h6>{{trans('messages.address')}} : {{$shop->address}}</h6>
                        <a class="btn btn-primary" href="{{route('seller.shop.edit',[$shop->id])}}">EDIT</a>
                    </div>
                </div>
                
               
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('script')
    <!-- Page level plugins -->
@endpush
