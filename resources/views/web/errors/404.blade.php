@extends('web.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="centering text-center error-container">
                    <div class="text-center">
                        <h2 class="without-margin"><span class="text-danger"><big><?php echo $message ?? 'Trang bạn tìm không tồn tại' ?></big></span></h2>
                        <h4 class="text-danger">Vui lòng liên hệ CSN để được hỗ trợ</h4>
                        <h4 class="text-danger">404</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection