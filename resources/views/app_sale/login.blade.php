@extends('master')

@section('content')
    <div class="page-container">

        <div class="page-content-wrapper page-register">
            <div class="page-content">
                <div class="main-body-content member-page">
                    <div class="member-title-table">
                        <div class="logo text-center"><img src="/namthai/assets/images/logo.png" /></div>
                        <div class="title-page full border-bottom mrb-30">
                            <h3 class="bold text-center">Đăng nhập</h3>
                        </div>
                        <form method="post" action="{{ route('app_sale.login') }}">
                            @csrf
                            @include('alert')
                            <div class="full border-full pad-20-30 mrb-40">
                                <div class="full mrb-10">
                                    <div class="col-md-12 line-30">
                                        <label class="control-label">Số điện thoại</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input class="form-control" name="phone_number" type="text" placeholder="0123456789" />
                                    </div>
                                </div>
                                <div class="full mrb-10">
                                    <div class="col-md-12 line-30">
                                        <label class="control-label">Mật khẩu</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input class="form-control" name="password" type="password" placeholder="0123456789" />
                                    </div>
                                </div>
                                <div class="full text-center">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn green pad-8-50 wdt-100">Đăng nhập</button>
                                    </div>
                                    <div class="col-md-12 text-left"><a class="text-link-otp" href="#">Quên mật khẩu ?</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--.table-member-mng-->
                    <!-- .block-1-->
                </div>
                <!-- .member-main-->
            </div>
            <!-- .page-content-->
        </div>
        <!-- .member-->
    </div>
@endsection
