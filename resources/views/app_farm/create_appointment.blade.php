@extends('master')
@section('content')
    <style>
        .content-detail .full .select2-selection{
            line-height: 50px;
            height: 45px;
            border-radius: 4px;
            border: 1px solid #b8b8d4;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #e0e2f7;
            border: 1px solid #e0e2f7;
            color: #1d212f;
        }
    </style>
    <div class="page-container">
        <form action="{!! route('app_farm.post.create_appointment') !!}" method="post">
            @csrf
            <div class="page-content-wrapper page-register">
                <div class="page-content">
                    <div class="main-body-content member-page">
                        <div class="member-title-table">
                            <div class="logo text-center"><img src="/namthai/assets/images/logo.png" width="100px" /></div>
                            <div class="title-page full border-bottom mrb-30">
                                <h3 class="bold text-center">Tạo yêu cầu thăm khám</h3>
                            </div>
                            @include('alert')
                            <div class="full border-full content-detail pad-20-30 mrb-40">
                                <div class="full">
                                    <div class="col-md-3 col-xs-3">
                                        <label class="control-label">Họ tên</label>
                                    </div>
                                    <div class="col-md-9 col-xs-9"><span>{{ $farm['full_name']??'' }}</span></div>
                                </div>
                                <div class="full">
                                    <div class="col-md-3 col-xs-3">
                                        <label class="control-label">Số điện thoại</label>
                                    </div>
                                    <div class="col-md-9 col-xs-9"><span>{{ $farm['phone_number']??'' }}</span></div>
                                </div>
                                <div class="full mrb-10">
                                    <div class="col-md-12 line-30">
                                        <label class="control-label">Loại vật nuôi thăm khám</label>
                                    </div>
                                    <div class="col-md-12 col-xs-12">
                                        <select class="form-control js-example-basic-single text-left" id="animals" name="animals[]" multiple="multiple"></select>
                                    </div>
                                </div>
                                <div class="full mrb-10">
                                    <div class="col-md-12 line-30">
                                        <label class="control-label">Triệu chứng</label>
                                    </div>
                                    <div class="col-md-12">
                                        <textarea class="form-control form-control" rows="3"
                                            placeholder="Cúm gà, Tiêu chảy,..." name="symptom"></textarea>
                                    </div>
                                </div>
                                {{-- <div class="full">
                                    <div class="col-md-12 line-30">
                                        <label class="control-label">Ảnh vật nuôi</label>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="upload__box">
                                            <div class="upload__btn-box">
                                                <label class="upload__btn"><span> <i class="fas fa-plus"></i></span>
                                                    <input class="upload__inputfile" type="file" multiple="" accept="image/*"/>
                                                </label>
                                            </div>
                                            <div class="upload__img-wrap"></div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="full mrb-10">
                                    <div class="col-md-12 line-30">
                                        <label class="control-label">Ghi chú</label>
                                    </div>
                                    <div class="col-md-12">
                                        <textarea class="form-control form-control" rows="3" placeholder="" name="note"></textarea>
                                    </div>
                                </div>
                                <div class="full mrb-10">
                                    <div class="col-md-12 line-30">
                                        <label class="control-label">Ngày muốn khám</label>
                                    </div>
                                    <div class="col-md-12 mrb-10">
                                        <input class="form-control datetimepicker" name="expect_appointment" type="text" value="{{ old('date') }}" name="date" placeholder="dd/mm/yyyy" />
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