<?php
    $catalog = config('constants.catalog');
    use App\Library\Helpers;
    global $memberVip;
    if($memberVip == null)
        $memberVip = Helpers::checkMemberVip();
?>

    <div id="right1_banner">
        @if (isset($category->cat_id) && $category->cat_id == 6)
            <a href="https://www.facebook.com/groups/csn.kpop.fan/" target="_blank"><img src="/images/banner/kpop-fbgroup-300x170.jpg" width="300" height="170"></a>
        @else
            @if(!$memberVip)
{{--                @if(View::exists('cache.code_ads.pc_right_home'))--}}
                    @include('cache.code_ads.pc_right_home')
                {{--@endif--}}
            @endif
        @endif
    </div>

    <br>

    @if(isset($short))
        <?php $id = 1; ?>
        @foreach($catalog as $key => $val)
            <a class="catalog1 weekend" style="background-image: url('/imgs/chude/{{$val['img_web']}}')" href="/chu-de/{{$key}}.html" title="{{$val['label']}}">
                <span>{{$val['label']}}</span>
            </a>
            @if(++$id > 2)
                @break;
            @endif
        @endforeach
    @else
        @foreach($catalog as $key => $val)
            <a class="catalog1 weekend" style="background-image: url('/imgs/chude/{{$val['img_web']}}')" href="/chu-de/{{$key}}.html" title="{{$val['label']}}">
                <span>{{$val['label']}}</span>
            </a>
        @endforeach
    @endif
