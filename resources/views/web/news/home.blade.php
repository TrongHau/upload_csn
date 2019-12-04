@include('cache.news.popular_post')
@include('cache.news.news_post')
@include('cache.news.popular_category')
<?php
global $popular_post;
global $news_post;
global $popular_category;
$listPopular_slider = array_slice($popular_post, 0, 4);
$listNews = array_slice($news_post, 0, 6);
use App\Library\Helpers;
?>
@extends('web.news.layouts.app')

@section('content')
    <section class="c-section">
        <div class="c-title c-title__01">
            <h2>tin nổi bật</h2>
        </div>
        <div class="o-container">
            <div class="c-grid">
                <div class="c-grid__container c-grid__container--01">
                    @foreach($listPopular_slider as $key => $item)
                        <div class="c-grid__item">
                            <div class="c-card c-card__01">
                                <div class="c-card__header">
                                    <div class="c-thumbnail">
                                        <div class="c-thumbnail--ratio">
                                            <a href="/tin-tuc/{{$item['slug']}}-p-{{$item['id']}}.html" title="{{$item['title']}}">
                                            <img src="<?php echo Helpers::news_image($item['image'], ($key == 0 ? 'full' : null)) ?>" alt="{{$item['title']}}">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="c-card__body">
                                    <h4 class="c-card__title"><a title="{{$item['title']}}" href="/tin-tuc/{{$item['slug']}}-p-{{$item['id']}}.html">{{$item['title']}}</a></h4>
                                    @if($key == 0)<p class="c-card__text">{{$item['short_content']}}</p>@endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="c-section__news u-background__gradien">
        <div class="c-title c-title__02">
            <h2>tin mới nhất</h2>
        </div>
        <div class="o-container">
            <div class="c-slider__container">
                <div class="slider4item">
                    @foreach($listNews as $item)
                    <div class="c-item">
                        <div class="c-card c-card__01 c-card__01--01">
                            <div class="c-card__header">
                                <div class="c-thumbnail">
                                    <div class="c-thumbnail--ratio">
                                        <a href="/tin-tuc/{{$item['slug']}}-p-{{$item['id']}}.html" title="{{$item['title']}}">
                                        <img src="<?php echo Helpers::news_image($item['image']) ?>" alt="{{$item['title']}}">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="c-card__body">
                                <h4 class="c-card__title"><a title="{{$item['title']}}" href="/tin-tuc/{{$item['slug']}}-p-{{$item['id']}}.html">{{$item['title']}}</a></h4>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="c-section">
        <div class="c-title c-title__01">
            <h2>Sao việt</h2>
        </div>
        <div class="o-container">
            <div class="c-grid">
                <div class="c-grid__container c-grid__container--02">
                    @foreach($popular_category[2] as $item)
                        <div class="c-grid__item">
                            <div class="c-card c-card__01">
                                <div class="c-card__header">
                                    <div class="c-thumbnail">
                                        <div class="c-thumbnail--ratio">
                                            <a  title="{{$item['title']}}" href="/tin-tuc/{{$item['slug']}}-p-{{$item['id']}}.html">
                                            <img src="<?php echo Helpers::news_image($item['image'], 'full') ?>" alt="{{$item['title']}}">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="c-card__body">
                                    <h4 class="c-card__title"><a title="{{$item['title']}}" href="/tin-tuc/{{$item['slug']}}-p-{{$item['id']}}.html">{{$item['title']}}</a></h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <div class="c-border__dash"></div>
    <section class="c-section">
        <div class="c-title c-title__01">
            <h2>Sao âu mỹ</h2>
        </div>
        <div class="o-container">
            <div class="c-grid">
                <div class="c-grid__container c-grid__container--02">
                    @foreach($popular_category[4] as $item)
                        <div class="c-grid__item">
                            <div class="c-card c-card__01">
                                <div class="c-card__header">
                                    <div class="c-thumbnail">
                                        <div class="c-thumbnail--ratio">
                                            <a href="/tin-tuc/{{$item['slug']}}-p-{{$item['id']}}.html" title="{{$item['title']}}">
                                            <img src="<?php echo Helpers::news_image($item['image'], 'full') ?>" alt="{{$item['title']}}">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="c-card__body">
                                    <h4 class="c-card__title"><a title="{{$item['title']}}" href="/tin-tuc/{{$item['slug']}}-p-{{$item['id']}}.html">{{$item['title']}}</a></h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <div class="c-border__dash"></div>
    <section class="c-section">
        <div class="c-title c-title__01">
            <h2>Sao hàn</h2>
        </div>
        <div class="o-container">
            <div class="c-grid">
                <div class="c-grid__container c-grid__container--02">
                    @foreach($popular_category[3] as $item)
                        <div class="c-grid__item">
                            <div class="c-card c-card__01">
                                <div class="c-card__header">
                                    <div class="c-thumbnail">
                                        <div class="c-thumbnail--ratio">
                                            <a href="/tin-tuc/{{$item['slug']}}-p-{{$item['id']}}.html" title="{{$item['title']}}">
                                                <img src="<?php echo Helpers::news_image($item['image'], 'full') ?>" alt="{{$item['title']}}">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="c-card__body">
                                    <h4 class="c-card__title"><a title="{{$item['title']}}" href="/tin-tuc/{{$item['slug']}}-p-{{$item['id']}}.html">{{$item['title']}}</a></h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection