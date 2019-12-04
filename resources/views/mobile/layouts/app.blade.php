<!DOCTYPE html>
<html>
@include('mobile.layouts.header')
<body>
<!--  Yo verify campaign 16/8/2019 -->
<script type="text/javascript" async defer src="//ss.yomedia.vn/js/1/230/ads.js"></script>

@yield('content')
@include('mobile.layouts.footer')
@yield('contentJS')

@hasSection('in_home')
@endif

</body>
<?php
//global $timeStart;
//echo '<center>'.number_format((microtime(true) - $timeStart), 2).'</center>';
?>
</html>
