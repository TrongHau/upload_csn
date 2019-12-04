<?php
use App\Library\Helpers;
?>
@foreach($list as $item)
    <div class="c-list__item">
        <div class="c-card c-card__02">
            <div class="c-card__header">
                <div class="c-thumbnail">
                    <div class="c-thumbnail--ratio">
                        <a title="{{$item['title']}}" href="/tin-tuc/{{$item->slug}}-p-{{$item->id}}.html">
                        <img src="<?php echo Helpers::news_image($item->image) ?>" alt="{{$item->title}}">
                        </a>
                    </div>
                </div>
            </div>
            <div class="c-card__body">
                <h4 class="c-card__title"><a title="{{$item['title']}}" href="/tin-tuc/{{$item->slug}}-p-{{$item->id}}.html">{{$item->title}}</a></h4>
                <h6 class="c-card__subtitle"><time>{{date("H:i d/m/Y", strtotime($item->date_publish))}}</time></h6>
                <p class="c-card__text"><?php echo $item->short_content ?></p>
            </div>
        </div>
    </div>
@endforeach
<div class="paging-category">
    <?php echo $list->links() ?>
</div>
