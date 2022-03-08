@extends('master')
@section('content')
    <div class="page-container">
        <form action="{{ route('app_farm.post.otp') }}" method="post">
            @csrf
            <div class="page-content-wrapper page-register">
                <div class="page-content">
                    <div class="main-body-content member-page">
                        <div class="member-title-table">
                            <div class="logo text-center"><img src="/namthai/assets/images/logo.png" /></div>
                            <div class="title-page full border-bottom mrb-30">
                                <h3 class="bold text-center">Nhập mã OTP</h3>
                            </div>
                            @include('alert')
                            <div class="full border-full pad-20-30 mrb-40">
                                <div class="full mrb-10">
                                    <div class="col-md-12 line-30">
                                        <label class="control-label">Nhập mã OTP</label>
                                    </div>
                                    <div class="col-md-12"><span class="text-note">Mã OTP đã được gửi tới
                                            Zalo của bạn:</span>
                                        <input class="form-control" type="text" placeholder="000000" name="otp_code" value="{!! old('otp_code') !!}"/>
                                    </div>
                                    <div class="col-md-12 text-right"><a class="text-link-otp" href="{!! route('app_farm.resend.otp') !!}">Lấy lại mã OTP
                                            ?</a></div>
                                </div>
                                <div class="full text-center">
                                    <button class="btn green pad-8-50">Hoàn tất</button>
                                </div>
                            </div>
                        </div>
                        <!--.table-member-mng-->
                        <!-- .block-1-->
                    </div>
                    <!-- .member-main-->
                </div>
                <!-- .page-content-->
            </div>
        </form>
        <!-- .member-->
    </div>
@endsection