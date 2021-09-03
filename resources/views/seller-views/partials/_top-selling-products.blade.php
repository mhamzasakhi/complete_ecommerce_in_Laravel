<!-- Header -->
<div class="card-header">
    <h5 class="card-header-title">
        <i class="tio-align-to-top"></i> {{trans('messages.top_selling_products')}}
    </h5>
    <i class="tio-gift" style="font-size: 45px"></i>
</div>
<!-- End Header -->

<!-- Body -->
<div class="card-body">
    <div class="row">
        @foreach($top_sell as $key=>$item)
            <div class="col-md-4 col-sm-6 mt-2"
                 onclick="location.href='{{route('admin.product.view',[$item['product_id']])}}'"
                 style="cursor: pointer;padding-right: 6px;padding-left: 6px">
                <div class="grid-card">
                    <label class="label_1">Sold : {{$item['count']}}</label>
                    <center class="mt-4">
                        <img style="height: 90px"
                             src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$item->product['thumbnail']}}"
                             onerror="this.src='{{asset('public/assets/back-end/img/160x160/img2.jpg')}}'"
                             alt="{{$item->product->name}} image">
                    </center>
                    <div class="text-center mt-2">
                        <span class="" style="font-size: 10px">{{substr($item->product['name'],0,20)}} {{strlen($item->product['name'])>20?'...':''}}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<!-- End Body -->
