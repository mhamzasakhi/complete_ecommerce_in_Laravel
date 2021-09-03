@extends('layouts.front-end.app')

@section('title','Flash Deal Products')

@push('css_or_js')
    <meta property="og:image" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="og:title" content="Deals of {{$web_config['name']->value}} "/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <meta property="twitter:card" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="twitter:title" content="Deals of {{$web_config['name']->value}}"/>
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:description" content="{!! substr($web_config['about']->value,0,100) !!}">
    <style>
        .for-banner {
            margin-top: 5px;
        }
        .for-discoutn-value {
            background-color: {{$web_config['primary_color']}};
    color: white;
    padding: 3px 4px 2px 5px;
    border-radius: 0px 5px;
    font-size: small;
}

.for-discoutn-value-null {
    color: white;
    padding: 3px 4px 2px 5px;
    border-radius: 0px 5px;
    font-size: small;
    display: inline-block;
}
.for-dicount-div-null {
    margin-bottom: 8%;
}
.for-dicount-div {
    margin-top: -6%;
    margin-right: -9%;
    margin-bottom: 6%;
}
.for-count-value {
    position: absolute;

    right: 0.6875rem;
    width: 1.25rem;
    height: 1.25rem;
    border-radius: 50%;
    color: #fff;
    font-size: 0.75rem;
    font-weight: 500;
    text-align: center;
    line-height: 1.25rem;
}

        .cz-countdown-days {
            color: white !important;
            background-color: {{$web_config['primary_color']}};
            padding: 0px 6px;
            border-radius: 3px;
            margin-right: 3px !important;
        }

        .cz-countdown-hours {
            color: white !important;
            background-color: {{$web_config['primary_color']}};
            padding: 0px 6px;
            border-radius: 3px;
            margin-right: 3px !important;
        }

        .flash_deal_title {
            font-weight: 700;
            font-size: 30px;

            text-transform: uppercase;
        }

        .cz-countdown {
            font-size: 18px;
        }

        .cz-countdown-minutes {
            color: white !important;
            background-color: {{$web_config['primary_color']}};
            padding: 0px 6px;
            border-radius: 3px;
            margin-right: 3px !important;
        }

        .cz-countdown-seconds {
            color: {{$web_config['primary_color']}};
            border: 1px solid{{$web_config['primary_color']}};
            padding: 0px 6px;
            border-radius: 3px !important;
        }

        .flash_deal_product_details .flash-product-price {
            font-weight: 700;
            font-size: 25px;
            color: {{$web_config['primary_color']}};
        }

        .for-image {
            width: 100%;
            height: 200px;
        }
        @media (max-width: 600px) {
            .flash_deal_title {
                font-weight: 600;
                font-size: 26px;
            }

            .cz-countdown {
                font-size: 14px;
            }
            .for-image {

            height: 100px;
        }
        }
        @media (max-width: 768px){
            .for-deal-tab{
                display: contents;
            }


        }
    </style>
@endpush

@section('content')
    <!-- Page Title-->

    <!-- Page Content-->
    <div class="for-banner container">

        <img class="d-block for-image" onerror="this.src='{{asset('storage/app/public/png/flashDeal.jpg')}}'"
             src="{{asset('storage/app/public/deal')}}/{{$deal['banner']}}"
             alt="Shop Converse">

    </div>
    <div class="container md-4 mt-3">
        <div class="row">
            <section class="col-lg-12 for-deal-tab">
                @php($flash_deals=\App\Model\FlashDeal::with(['products.product.reviews'])->where(['status'=>1])->whereDate('start_date','<=',date('Y-m-d'))->whereDate('end_date','>=',date('Y-m-d'))->first())
                <div class="col-md-6  pt-3">
                    <div class="d-inline-flex">
                        <span class="flash_deal_title mr-3">
                            {{ trans('messages.flash_deal_b')}}
                        </span>
                        <span class="cz-countdown mt-2"
                              data-countdown="{{isset($flash_deals)?date('m/d/Y',strtotime($flash_deals['end_date'])):''}} 11:59:00 PM">
                        <span class="cz-countdown-days">
                            <span class="cz-countdown-value"></span>
                        </span>
                        <span class="cz-countdown-value">:</span>
                        <span class="cz-countdown-hours">
                            <span class="cz-countdown-value"></span>
                        </span>
                        <span class="cz-countdown-value">:</span>
                        <span class="cz-countdown-minutes">
                            <span class="cz-countdown-value"></span>
                        </span>
                        <span class="cz-countdown-value">:</span>
                        <span class="cz-countdown-seconds">
                            <span class="cz-countdown-value"></span>
                        </span>
                    </span>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- Toolbar-->

    <!-- Products grid-->
    <div class="container pb-5 mb-2 mb-md-4 mt-3">
        <div class="row">
            <section class="col-lg-12">
                <div class="row mt-4">
                    @if($discountPrice)
                        @foreach($deal->products as $dp)
                            <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-4">
                                @include('web-views.partials._single-product',['product'=>$dp->product])
                                <hr class="d-sm-none">
                            </div>
                        @endforeach
                    @endif
                </div>
                <!-- Pagination-->
                {{-- <nav class="d-flex justify-content-between pt-2" aria-label="Page navigation" id="paginator-ajax">
                   @include('web-views.products._ajax-paginator',['page'=>$dp['page_no'],'data'=>$dp])
               </nav> --}}
            </section>
        </div>
    </div>
@endsection

@push('script')

@endpush
