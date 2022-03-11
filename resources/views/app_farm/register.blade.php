@extends('master')
@section('content')
    <div class="page-container">
        <form action="{{ route('app_farm.post.register') }}" method="post">
            @csrf
            <div class="page-content-wrapper page-register">
                <div class="page-content">
                    <div class="main-body-content member-page">
                        <div class="member-title-table">
                            <div class="logo text-center"><img src="/namthai/assets/images/logo.png" /></div>
                            <div class="title-page full border-bottom mrb-30">
                                <h3 class="bold text-center">Đăng ký tài khoản</h3>
                            </div>
                            @include('alert')
                            <div class="full border-full pad-20-30 mrb-40">
                                <div class="full mrb-10">
                                    <div class="col-md-3 line-30">
                                        <label class="control-label">Tên trang trại</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" name="full_name" type="text" placeholder="Tên trang trại" value="{{ old('full_name') }}"/>
                                    </div>
                                </div>
                                <div class="full mrb-10">
                                    <div class="col-md-3 line-30">
                                        <label class="control-label">Ngày sinh</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control datetimepicker" name="dob" type="text" placeholder="dd/mm/yyyy" value="{{ old('dob') }}"/>
                                    </div>
                                </div>
                                <div class="full mrb-10">
                                    <div class="col-md-3">
                                        <label class="control-label">Giới tính</label>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" id="inlineCheckbox1" type="checkbox" name="gender" value="1"/>
                                            <label class="form-check-label" for="inlineCheckbox1">Nam</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" id="inlineCheckbox2" type="checkbox" name="gender" value="2"/>
                                            <label class="form-check-label" for="inlineCheckbox2">Nữ</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="full mrb-10">
                                    <div class="col-md-3 line-30">
                                        <label class="control-label">Số điện thoại</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="number" placeholder="0123456789" name="phone_number" value="{{ old('phone_number') }}"/>
                                    </div>
                                </div>
                                <div class="full mrb-10">
                                    <div class="col-md-12 line-30">
                                        <label class="control-label">Địa chỉ</label>
                                    </div>
                                    <div class="col-md-12 mrb-10">
                                        <select id="province_id" name="province_id" class="form-select" aria-label="Default select example">
                                        </select>
                                    </div>
                                    <div class="col-md-12 mrb-10">
                                        <select id="district_id" name="district_id" class="form-select" aria-label="Default select example">
                                        </select>
                                    </div>
                                    <div class="col-md-12 mrb-10">
                                        <select id="ward_id" name="ward_id" class="form-select" aria-label="Default select example">
                                        </select>
                                    </div>
                                    <div class="col-md-12 mrb-10">
                                        <input class="form-control" name="address_detail" type="text" placeholder="Địa chỉ" value="{{ old('address_detail') }}"/>
                                    </div>
                                </div>
                                <div class="full mrb-10">
                                    <div class="col-md-12 line-30">
                                        <label>Mật Khẩu</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input class="form-control" type="password" placeholder="****" name="password"/>
                                    </div>
                                </div>
                                <div class="full mrb-10">
                                    <div class="col-md-12 line-30">
                                        <label>Xác nhận mật khẩu</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input class="form-control" type="password" placeholder="****" name="comfirm_password"/>
                                    </div>
                                </div>
                                <div class="full text-center">
                                    <button class="btn green pad-8-50">Đăng ký</button>
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