<!DOCTYPE html>
<html>
@include('web.news.layouts.header')
<body class="c-page__index">
@include('web.news.layouts.wapper')
<main>
    @yield('content')
</main>
@include('web.news.layouts.footer')
@yield('contentJS')
</body>
</html>