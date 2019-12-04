@include('cache.news.popular_post')
<?php
global $popular_post;
$listNews_slider = array_slice($popular_post, 0, 6);
$listNews_page = array_slice($popular_post, 6, 15);
use App\Library\Helpers;
?>
@extends('web.news.layouts.app')

@section('content')
    <section class="c-section__breadcrumb">
        <div class="o-container">
            <div class="c-breadcrumb">
                <ul>
                    <li><a href="/tin-tuc.html" title="Home"><span>Trang chủ</span></a></li>
                    <li><span>Tin Nỗi Bật</span></li>
                </ul>
            </div>
        </div>
    </section>
    <section class="c-section">
        <div class="o-container">
            <div id="c-slider__main" class="c-slider__main">
                @foreach($listNews_slider as $item)
                    <div class="c-item">
                        <div class="c-card c-card__01--type02">
                            <div class="c-card__header">
                                <div class="c-thumbnail">
                                    <div class="c-thumbnail--ratio">
                                        <a title="{{$item['title']}}" href="/tin-tuc/{{$item['slug']}}-p-{{$item['id']}}.html">
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
            <div id="c-slider__main--nav" class="c-slider__main--nav">
                @foreach($listNews_slider as $item)
                    <div class="c-item">
                        <div class="c-card">
                            <div class="c-card__header">
                                <div class="c-thumbnail">
                                    <div class="c-thumbnail--ratio"><img src="<?php echo Helpers::news_image($item['image']) ?>" alt="{{$item['title']}}"></div>
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
    </section>
    <div class="o-container">
        <div class="c-border__dash"></div>
    </div>
    <section class="c-section">
        <div class="o-container">
            <div class="c-list__container c-list__container--01">
                @foreach($listNews_page as $item)
                    <div class="c-list__item">
                        <div class="c-card c-card__02">
                            <div class="c-card__header">
                                <div class="c-thumbnail">
                                    <div class="c-thumbnail--ratio">
                                        <a title="{{$item['title']}}" href="/tin-tuc/{{$item['slug']}}-p-{{$item['id']}}.html">
                                        <img src="<?php echo Helpers::news_image($item['image']) ?>" alt="{{$item['title']}}">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="c-card__body">
                                <h4 class="c-card__title"><a title="{{$item['title']}}" href="/tin-tuc/{{$item['slug']}}-p-{{$item['id']}}.html">{{$item['title']}}</a></h4>
                                <h6 class="c-card__subtitle"><time>{{date("H:i d/m/Y", strtotime($item['date_publish']))}}</time></h6>
                                <p class="c-card__text"><?php echo $item['short_content'] ?></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@section('contentJS')
@endsection