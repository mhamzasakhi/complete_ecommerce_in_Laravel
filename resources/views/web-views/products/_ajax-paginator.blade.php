@if($data['data_from']!='search')

    <ul class="pagination">
        @if($data['page_no']-1!=0)
            <li class="page-item">
                <a class="page-link"
                   href="{{route('products',['id'=> $data['id'],'data_from'=>$data['data_from'],'sort_by'=>$data['sort_by'],'min_price'=>$data['min_price'],'max_price'=>$data['max_price'],'page'=>$data['page_no']-1])}}">
                    <i class="czi-arrow-left mr-2"></i>
                    Prev
                </a>
            </li>
        @endif
    </ul>
    <ul class="pagination">
        @for($page=1;$page<=$data['page_number'];$page++)
            <li class="page-item {{$data['page_no']==$page?'active':''}} d-sm-block">
                <a class="page-link"
                   href="{{route('products',['id'=> $data['id'],'data_from'=>$data['data_from'],'sort_by'=>$data['sort_by'],'min_price'=>$data['min_price'],'max_price'=>$data['max_price'],'page'=>$page])}}">
                    {{$page}}
                </a>
            </li>
        @endfor
    </ul>
    <ul class="pagination">
        @if($data['page_no']+1<=$data['page_number'])
            <li class="page-item">
                <a class="page-link"
                   href="{{route('products',['id'=> $data['id'],'data_from'=>$data['data_from'],'sort_by'=>$data['sort_by'],'min_price'=>$data['min_price'],'max_price'=>$data['max_price'],'page'=>$data['page_no']+1])}}"
                   aria-label="Next">
                    Next<i class="czi-arrow-right ml-2"></i>
                </a>
            </li>
        @endif
    </ul>

@else

    <ul class="pagination">
        @if($data['page_no']-1!=0)
            <li class="page-item">
                <a class="page-link"
                   href="{{route('products',['name'=> $data['name'],'data_from'=>$data['data_from'],'sort_by'=>$data['sort_by'],'min_price'=>$data['min_price'],'max_price'=>$data['max_price'],'page'=>$data['page_no']-1])}}">
                    <i class="czi-arrow-left mr-2"></i>
                    Prev
                </a>
            </li>
        @endif
    </ul>
    <ul class="pagination">
        @for($page=1;$page<=$data['page_number'];$page++)
            <li class="page-item {{$data['page_no']==$page?'active':''}} d-sm-block">
                <a class="page-link"
                   href="{{route('products',['name'=> $data['name'],'data_from'=>$data['data_from'],'sort_by'=>$data['sort_by'],'min_price'=>$data['min_price'],'max_price'=>$data['max_price'],'page'=>$page])}}">
                    {{$page}}
                </a>
            </li>
        @endfor
    </ul>
    <ul class="pagination">
        @if($data['page_no']+1<=$data['page_number'])
            <li class="page-item">
                <a class="page-link"
                   href="{{route('products',['name'=> $data['name'],'data_from'=>$data['data_from'],'sort_by'=>$data['sort_by'],'min_price'=>$data['min_price'],'max_price'=>$data['max_price'],'page'=>$data['page_no']+1])}}"
                   aria-label="Next">
                    Next<i class="czi-arrow-right ml-2"></i>
                </a>
            </li>
        @endif
    </ul>

@endif


