
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
                    <div class="block block_album block_profile_playlist">
                      <div class="row row-sm" id="album">
                        <div class="container">
                          <div class="content">
                            <div class="title">400</div>
                            <div class="quote">Bad request.</div>
                            <div class="explanation">
                              <br>
                              <small>
                                  <?php
                                  $default_error_message = "Please return to <a href='".url('')."'>our homepage</a>.";
                                  ?>
                                {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
                              </small>
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
    </div>
  </main>
@endsection