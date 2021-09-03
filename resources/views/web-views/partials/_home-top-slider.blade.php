<style>
    .just-padding {
        padding: 15px;
        border: 1px solid #ccccccb3;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
        height: 100%;
        background-color: white;
    }

    .list-group.list-group-root {
        padding: 0;
        overflow: hidden;
    }

    .list-group.list-group-root .list-group {
        margin-bottom: 0;
    }

    .list-group.list-group-root .list-group-item {
        border-radius: 0;
        border-width: 1px 0 0 0;
    }

    .list-group.list-group-root > .list-group-item:first-child {
        border-top-width: 0;
    }

    .list-group.list-group-root > .list-group > .list-group-item {
        padding-left: 30px;
    }

    .list-group.list-group-root > .list-group > .list-group > .list-group-item {
        padding-left: 45px;
    }

    .list-group-item .glyphicon {
        margin-right: 5px;
    }

    .sub-menu {
        /* display: block;
         margin-left: 18%;
         margin-top: -8px;
         position: fixed;
         z-index: 99;
         min-width: 215px;*/
    }
    a{
        color: black;!important;
    }
</style>

<div class="row">
    <div class="col-xl-3 d-none d-xl-block">
        <div class="just-padding"></div>
    </div>

    <div class="col-xl-9 col-md-12" style="margin-top: 11px">
        @php($main_banner=\App\Model\Banner::where('banner_type','Main Banner')->where('published',1)->orderBy('id','desc')->get())
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($main_banner as $key=>$banner)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}"
                        class="{{$key==0?'active':''}}">
                    </li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach($main_banner as $key=>$banner)
                    <div class="carousel-item {{$key==0?'active':''}}">
                        <a href="{{$banner['url']}}">
                            <img class="d-block w-100" style="max-height: 350px"
                                 onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                 src="{{asset('storage/app/public/banner')}}/{{$banner['photo']}}"
                                 alt="">
                        </a>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
               data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
               data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="cz-carousel">
            <div class="d-flex flex-nowrap">
                @foreach(\App\Model\Banner::where('banner_type','Footer Banner')->where('published',1)->orderBy('id','desc')->take(3)->get() as $banner)
                    <div class="footer_banner">
                        <a data-toggle="modal" data-target="#quick_banner{{$banner->id}}"
                           style="cursor: pointer;">
                            <img class="d-block mx-auto footer_banner_img"
                                 onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                 src="{{asset('storage/app/public/banner')}}/{{$banner['photo']}}"
                                 width="315">
                        </a>

                    </div>
                    <div class="modal fade" id="quick_banner{{$banner->id}}" tabindex="-1"
                         role="dialog" aria-labelledby="exampleModalLongTitle"
                         aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <p class="modal-title"
                                       id="exampleModalLongTitle">{{ trans('messages.banner_photo')}}</p>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img class="d-block mx-auto"
                                         onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                         src="{{asset('storage/app/public/banner')}}/{{$banner['photo']}}">
                                    @if ($banner->url!="")
                                        <div class="text-center mt-2">
                                            <a href="{{$banner->url}}"
                                               class="btn btn-outline-accent">{{trans('messages.Explore')}} {{trans('messages.Now')}}</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Banner group-->
</div>


<script>
    $(function () {
        $('.list-group-item').on('click', function () {
            $('.glyphicon', this)
                .toggleClass('glyphicon-chevron-right')
                .toggleClass('glyphicon-chevron-down');
        });
    });
</script>
