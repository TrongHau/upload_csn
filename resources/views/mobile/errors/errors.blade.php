@extends('mobile.layouts.app')

@section('content')
    <div class="header">
        @include('mobile.layouts.header_top')
    </div>
    <main class="main main_player">
        <div class="sidebar_top">
            <div id="pills-tabContent" class="tab-content">
                <div id="pills-thongtin" role="tabpanel" aria-labelledby="pills-thongtin-tab" class="tab-pane fade active show">
                    <div class="block_thongtin">
                        <div class="swiper-container swiper2 swiper-container-horizontal swiper-container-autoheight">
                            <div class="swiper-wrapper" style="height: 747px;">
                                <div class="swiper-slide swiper-slide-active" style="width: 375px;">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="centering text-center error-container">
                                                    <div class="text-center">
                                                        @if(isset($e))
                                                            <h4 class="text-danger">{{$e->getMessage()}}</h4>
                                                        @else
                                                            <h2 class="without-margin"><span class="text-danger"><big>Trang bạn tìm không tồn tại</big></span></h2>
                                                            <h4 class="text-danger">Vui lòng liên hệ CSN để được hỗ trợ</h4>
                                                            <h4 class="text-danger">404</h4>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
