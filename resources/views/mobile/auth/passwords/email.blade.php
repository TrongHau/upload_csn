<?php
use App\Library\Helpers;
// global variable file /case
?>
@extends('mobile.layouts.app')
@section('content')
<div class="header">
    @include('mobile.layouts.header_top')
</div>
<main class="main main-no-swiper main-account">
    <div class="block_login">
        <div class="login_possition d-flex flex-column justify-content-center">
            <div class="w-304 mx-auto text-center mb-5">
                <input type="text" placeholder="Địa chỉ email" class="input_type_mobile login_button mb-3 email">
                <a href="javascript:void(0)" onclick="authLogin()" class="login_button google text-gray btn-gradien">Lấy Lại Mật Khẩu</a><br><a href="/login?back_url={{$_GET['back_url'] ?? url()->previous()}}" style="margin-right: 15px;color: #FF2D55;">Đăng nhập</a><span style="color: #888">|</span><a href="/register?back_url={{$_GET['back_url'] ?? url()->previous()}}" style="margin-left: 15px;color: #FF2D55;">Đăng ký</a>
            </div>
            <div class="w-304 mx-auto text-center"><a href="/auth/facebook?back_url={{$_GET['back_url'] ?? url()->previous()}}" class="login_button facebook mb-3">Đăng nhập bằng Facebook</a><a href="/auth/google?back_url={{$_GET['back_url'] ?? url()->previous()}}" class="login_button google text-gray btn-gradien">Đăng nhập bằng Google</a></div>
        </div>
    </div>
</main>
@endsection
@section('contentJS')
    <script>
        function authLogin() {
            resetInputLogin();
            const email = $('.login_possition').find('.email');
            if(!email.val()) {
                return addErrorInput(email, 'Email không được để trống');
            }
            $.ajax({
                url: window.location.origin + '/password/email',
                type: "POST",
                dataType: "json",
                data: {
                    email: email.val(),
                },
                beforeSend: function () {
                    if(loaded) return false;
                    loaded = true;
                },
                error: function (data) {
                    var errors = data.responseJSON;
                    $.each(errors.errors, function( key, value ) {
                        addErrorInput($('.login_possition').find('.' + key), value);
                    });
                },
                success: function(response) {
                    var status = response.status.email;
                    email.before('<div class="alert alert-success">' + status + ' </div>');
                }
            });
        }
        function resetInputLogin() {
            $('.login_possition').find('.input-help-block').remove();
            $('.login_possition').find('.alert').remove();
            $('.login_possition').find('input').removeClass('input-has-error');
        }
        function addErrorInput(tag, content) {
            tag.focus();
            tag.addClass('input-has-error');
            tag.before('<span class="input-help-block"><strong>' + content + '</strong></span>');
        }
    </script>
@endsection