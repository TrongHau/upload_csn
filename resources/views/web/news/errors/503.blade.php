@extends('web.layouts.app')
@section('content')
  <div class="container">
    <div class="content">
      <div class="title">503</div>
      <div class="quote">It's not you, it's me.</div>
      <div class="explanation">
        <br>
        <small>
            <?php
            $default_error_message = "The server is overloaded or down for maintenance. Please try again later.";
            ?>
          {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
        </small>
      </div>
    </div>
  </div>
@endsection

