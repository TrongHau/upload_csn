@extends('web.layouts.app')

@section('content')
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
@endsection
