@include('cache.news.popular_category')
<?php
global $popular_category;
use App\Library\Helpers;
$nameCat = $idCategory == 2 ? 'Sao Việt' : ($idCategory == 3 ? 'Sao Hàn' : ($idCategory == 4 ? 'Sao Âu Mỹ' : 'Sao Việt'));
?>
@extends('web.news.layouts.app')

@section('content')
    <section class="c-section__breadcrumb">
        <div class="o-container">
            <div class="c-breadcrumb">
                <ul>
                    <li><a href="index.html" title="Home"><span>Trang chủ</span></a></li>
                    <li><span>{{$nameCat}}</span></li>
                </ul>
            </div>
        </div>
    </section>
    <section class="c-section">
        <div class="o-container">
            <div id="c-slider__main" class="c-slider__main">
                @foreach($popular_category[$idCategory] as $item)
                    <div class="c-item">
                        <div class="c-card c-card__01--type02">
                            <div class="c-card__header">
                                <div class="c-thumbnail">
                                    <div class="c-thumbnail--ratio">
                                        <a href="/tin-tuc/{{$item['slug']}}-p-{{$item['id']}}.html">
                                            <img src="<?php echo Helpers::news_image($item['image'], 'full') ?>" alt="{{$item['title']}}">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="c-card__body">
                                <h4 class="c-card__title"><a href="/{{$item['slug']}}-p-{{$item['id']}}.html">{{$item['title']}}</a></h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="c-slider__main--nav" class="c-slider__main--nav">
                @foreach($popular_category[$idCategory] as $item)
                    <div class="c-item">
                    <div class="c-card">
                        <div class="c-card__header">
                            <div class="c-thumbnail">
                                <div class="c-thumbnail--ratio">
                                    <a href="/tin-tuc/{{$item['slug']}}-p-{{$item['id']}}.html">
                                    <img src="<?php echo Helpers::news_image($item['image']) ?>" alt="{{$item['title']}}">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="c-card__body">
                            <h4 class="c-card__title"><a href="/tin-tuc/{{$item['slug']}}-p-{{$item['id']}}.html">{{$item['title']}}</a></h4>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <div class="o-container">
        <div class="c-border__dash"></div>
    </div>
    <section class="c-section">
        <div class="o-container">
            <div class="c-list__container c-list__container--01">
                <?php echo $firstCategory ?>
            </div>
        </div>
    </section>
@endsection
@section('contentJS')
    <script>
        $('.c-list__container').find('.pagination li a').on('click', function (e) {
            e.preventDefault();
            categoryPage($(this).attr('href'));
        });
        window.addEventListener('popstate', function(e) {
            // var state = e.originalEvent.state;
            var page = findGetParameter('page', 1);
            categoryPage(window.location.pathname + (page != 1 ? '?page=' + page : ''), false);
        });
        function categoryPage(url, pushPage = true) {
            if(pushPage) {
                var page = parseFloat(url.substr(url.indexOf("?page=") + 6));
                page = isNaN(page) ? 1 : page;
                window.history.pushState({}, '', window.location.pathname +  (page != 1 ? '?page=' + page : ''));
            }
            $.ajax({
                url: url,
                type: "GET",
                dataType: "html",
                data: {
                    'id': <?php echo $idCategory ?>,
                    'tab': 'ajax_page'
                },
                beforeSend: function () {
                    if(loaded) return false;
                    loaded = true;
                    // $('html,body').animate({ scrollTop: 0 }, 400);
                    $('html, body').animate({
                        scrollTop: $("div.c-list__container").offset().top -200
                    }, 200)
                },
                success: function(response) {
                    $('.c-list__container').html(response);
                    $('.c-list__container').find('.pagination li a').on('click', function (e) {
                        e.preventDefault();
                        categoryPage($(this).attr('href'));
                    });
                }
            });
        }
    </script>
@endsection