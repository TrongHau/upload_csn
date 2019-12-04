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
        <div class="login_possition register_possition d-flex flex-column justify-content-center">
            <div class="w-304 mx-auto text-center mb-5">
                <input type="text" placeholder="Tên đăng nhập" class="input_type_mobile login_button mb-3 username">
                <input type="text" placeholder="Tên hiển thị" class="input_type_mobile login_button mb-3 name">
                <input type="email" placeholder="Địa chỉ email" required="email" class="input_type_mobile login_button mb-3 email">
                <input type="password" placeholder="Mật khẩu" class="input_type_mobile login_button password mb-3">
                <input type="password" placeholder="Xác nhận lại mật khẩu" class="input_type_mobile login_button confirm_password mb-3">
                <div class="g-recaptcha captcha mb-3" data-sitekey="{{env('NOCAPTCHA_SITEKEY')}}"></div>
                <a href="javascript:void(0)" onclick="authRegister()" class="login_button google text-gray mb-3 btn-gradien">Đăng Ký</a>
                <div class="checkbox_remember">
                    <label for="remember" class="input-checkbox">
                        <input id="contact_csn" type="checkbox" id="contact_csn" checked="" name="contact_csn" name="contact_csn" class="contact_csn"><span>Tôi đã đọc và đồng ý các điều kiện<a href="#"> Thỏa thuận sử dụng</a></span>
                    </label>
                </div>
                <p style="color: white; text-align: center;" class="text-p"><a href="/login?back_url={{$_GET['back_url'] ?? url()->previous()}}" style="margin-right: 15px;color: #FF2D55;">Đăng nhập</a><span style="color: #888">|</span><a href="/password/reset?back_url={{$_GET['back_url'] ?? url()->previous()}}" style="margin-left: 15px;color: #FF2D55;">Quên mật khẩu</a></p>
            </div>
            <div class="w-304 mx-auto text-center"><a href="/auth/facebook?back_url={{$_GET['back_url'] ?? url()->previous()}}" class="login_button facebook mb-3">Đăng ký bằng Facebook</a><a href="/auth/google?back_url={{$_GET['back_url'] ?? url()->previous()}}" class="login_button google text-gray btn-gradien">Đăng ký bằng Google</a></div>
        </div>
    </div>
</main>
@endsection
@section('contentJS')
    <script>
        function authRegister() {
            resetInputLogin();
            const username = $('.register_possition').find('.username');
            const name = $('.register_possition').find('.name');
            const email = $('.register_possition').find('.email');
            const password = $('.register_possition').find('.password');
            const confirm_password = $('.register_possition').find('.confirm_password');
            const contact = $('.register_possition').find('.contact_csn');

            if(!username.val()) {
                return addErrorInput(username, 'Tên đăng nhập không được để trống');
            }
            if(!username.val()) {
                return addErrorInput(name, 'Tên hiển thị không được để trống');
            }
            if(!email.val()) {
                return addErrorInput(email, 'Email không được để trống');
            }
            if(!password.val()) {
                return addErrorInput(password, 'Nội dung này không được để trống.');
            }
            if(confirm_password.val() != password.val()) {
                return addErrorInput(confirm_password, 'Xác nhận mật khẩu không khớp.');
            }
            if(username.val().length < 4) {
                return addErrorInput(username, 'Tài khoản trên 4 ký tự.');
            }
            if(password.val().length < 6) {
                return addErrorInput(password, 'Mật khẩu phải trên 6 ký tự.');
            }
            if(!contact.is( ":checked" )) {
                return addErrorInput(contact, 'Xác nhận thỏa thuận để đăng ý tài khoản');
            }
            $.ajax({
                url: window.location.origin + '/register',
                type: "POST",
                dataType: "json",
                data: {
                    name: name.val(),
                    username: username.val(),
                    email: email.val(),
                    password: password.val(),
                    captcha: grecaptcha.getResponse()
                },
                beforeSend: function () {
                    if(loaded) return false;
                    loaded = true;
                },
                error: function (data) {
                    var errors = data.responseJSON;
                    $.each( errors.errors, function( key, value ) {
                        addErrorInput($('.register_possition').find('.' + key), value);
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