<?php
use Jenssegers\Agent\Agent;
$Agent = new Agent();
?>
<div class="header_top">
    <nav class="navbar navbar-expand-lg navbar-dark flex-row-reverse">
        <a href="#" class="navbar-brand text-white button_search"><i aria-hidden="true" class="fa fa-search"></i></a>
        @if($Agent->isAndroidOS())
        <a href="http://chiasenhac.vn/app/csn.html" target="_blank" style="margin-left: 70px;"><img src="/imgs/csn_app.png"></a>
        @endif
        <a href="/" class="navbar-brand logo"><img src="/images/logo-header.png" alt="logo"></a>
        <button type="button" class="navbar-toggler"><span class="navbar-toggler-icon"></span></button>
    </nav>
</div>
