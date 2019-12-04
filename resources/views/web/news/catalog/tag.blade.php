@include('cache.news.popular_category')
<?php
global $popular_category;
use App\Library\Helpers;
?>
@extends('web.news.layouts.app')

@section('content')
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
                    'tag': '<?php echo $tag ?>',
                    'tab': 'ajax_page'
                },
                beforeSend: function () {
                    if(loaded) return false;
                    loaded = true;
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