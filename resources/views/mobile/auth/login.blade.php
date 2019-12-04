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
                <input type="text" placeholder="Tên đăng nhập hoặc email" class="input_type_mobile login_button mb-3 email">
                <input type="password" placeholder="Mật khẩu" class="input_type_mobile login_button password mb-3">
                <a href="javascript:void(0)" onclick="authLogin()" class="login_button google text-gray mb-3 btn-gradien">Đăng Nhập</a>
                <div class="checkbox_remember">
                    <div class="row">
                        <div class="col-6 text-right">
                            <label for="remember" class="input-checkbox">
                                <input id="remember" type="checkbox" checked="" id="remember" name="remember"><span>Nhớ mật khẩu</span>
                            </label>
                        </div>
                        <div class="col-6 text-left"><a href="/password/reset?back_url={{$_GET['back_url'] ?? url()->previous()}}">Quên mật khẩu?</a></div>
                    </div>
                </div><br>
                <p style="width: 100%" class="text-p"> </p>
                <p style="color: white; text-align: center;display: flow-root;width: 100%" class="text-p">Bạn chưa có tài khoản? <a href="/register?back_url={{$_GET['back_url'] ?? url()->previous()}}" style="margin-right: 15px;color: #FF2D55;display: flow-root;">Đăng ký</a></p>
            </div>
            <div class="w-304 mx-auto text-center">
                <a href="/auth/facebook?back_url={{$_GET['back_url'] ?? url()->previous()}}" class="login_button facebook mb-3">Facebook</a>
                <a href="/auth/google?back_url={{$_GET['back_url'] ?? url()->previous()}}" class="login_button google text-gray btn-gradien">Google</a>
            </div>
        </div>
    </div>
</main>
@endsection
@section('contentJS')
    <script>
        function authLogin() {
            resetInputLogin();
            const email = $('.login_possition').find('.email');
            const password = $('.login_possition').find('.password');
            if(!email.val()) {
                return addErrorInput(email, 'Email không được để trống.');
            }
            if(!password.val()) {
                return addErrorInput(password, 'Mật khẩu không được để trống.');
            }
            if(email.val().length < 4) {
                return addErrorInput(email, 'Tài khoản trên 4 ký tự.');
            }
            if(password.val().length < 6) {
                return addErrorInput(password, 'Mật khẩu phải trên 6 ký tự.');
            }
            $.ajax({
                url: window.location.origin + '/login',
                type: "POST",
                dataType: "json",
                data: {
                    email: email.val(),
                    password: password.val(),
                    remember: ($('#remember').is( ":checked" ) ? true : '')
                },
                beforeSend: function () {
                    if(loaded) return false;
                    loaded = true;
                },
                error: function (data) {
                    var errors = data.responseJSON;
                    $.each( errors.errors, function( key, value ) {
                        addErrorInput($('.login_possition').find('.' + key), value);
                    });
                },
                success: function(response) {
                    window.location.href = '<?php echo $_GET['back_url'] ?? '/' ?>';
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