@extends('web.layouts.app')
@section('content')
  <div class="container">
    <div class="content">
      <div class="title">500</div>
      <div class="quote">It's not you, it's me.</div>
      <div class="explanation">
        <br>
        <small>
            <?php
            $default_error_message = "An internal server error has occurred. If the error persists please contact the development team.";
            ?>
          {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
        </small>
      </div>
    </div>
  </div>
@endsection

