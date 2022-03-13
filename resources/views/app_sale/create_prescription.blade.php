@extends('master')

@section('content')
    <div class="page-container">

        <div class="page-content-wrapper page-register">
            <div class="page-content">
                <div class="main-body-content member-page">
                    <div class="member-title-table">
                        <div class="logo text-center"><img src="/namthai/assets/images/logo.png" width="100px" /></div>
                        <div class="title-page full border-bottom mrb-30">
                            <h3 class="bold text-center">Tạo đơn thuốc</h3>
                        </div>
                        <div class="full border-full content-detail pad-20-30 mrb-40">
                            <div class="full">
                                <div class="col-md-3 col-xs-3">
                                    <label class="control-label">Tên FARM :</label>
                                </div>
                                <div class="col-md-9 col-xs-9"><span>Nguyễn Văn A</span></div>
                            </div>
                            <div class="full">
                                <div class="col-md-3 col-xs-3">
                                    <label class="control-label">Địa chỉ :</label>
                                </div>
                                <div class="col-md-9 col-xs-9"><span>539 Vũ Tông Phan - Thanh Xuân</span></div>
                            </div>
                            <div class="full">
                                <div class="col-md-3 col-xs-3">
                                    <label class="control-label">Số điện thoại :</label>
                                </div>
                                <div class="col-md-9 col-xs-9"><span>012345789</span></div>
                            </div>
                            <div class="full">
                                <div class="col-md-3 col-xs-3">
                                    <label class="control-label">Mã đơn thuốc :</label>
                                </div>
                                <div class="col-md-9 col-xs-9"><span>001</span></div>
                            </div>
                            <div class="full">
                                <div class="col-md-3 col-xs-3">
                                    <label class="control-label">Thông tin Sale :</label>
                                </div>
                                <div class="col-md-9 col-xs-9"><span>Sale_A</span></div>
                            </div>
                            <div class="full">
                                <div class="col-md-3 col-xs-3">
                                    <label class="control-label">Ngày tạo :</label>
                                </div>
                                <div class="col-md-9 col-xs-9"><span>01/03/2022</span></div>
                            </div>
                            <div class="full mrb-10">
                                <div class="col-md-12 line-30">
                                    <label class="control-label">Loại vật nuôi</label>
                                    <select class="form-control js-example-basic-single text-left" id="animals" name="animals[]" multiple="multiple"></select>
                                </div>

                            </div>
                            <div class="full mrb-10">
                                <div class="col-md-3"><span>Trọng lượng: </span></div>
                                <div class="col-md-3">
                                    <input class="form-control" type="text" placeholder="0.4kg" />
                                </div>
                                <div class="col-md-2"><span>Số lượng: </span></div>
                                <div class="col-md-3">
                                    <input class="form-control" type="text" placeholder="1000" />
                                </div>
                            </div>
                            <div class="full mrb-10">
                                <div class="col-md-12 line-30">
                                    <label class="control-label">Loại thức ăn</label>
                                </div>
                                <div class="col-md-12">
                                    <textarea class="form-control form-control" rows="3"
                                        placeholder="Cám,..."></textarea>
                                </div>
                            </div>
                            <div class="full mrb-10">
                                <div class="col-md-12 line-30">
                                    <label class="control-label">Triệu chứng</label>
                                </div>
                                <div class="col-md-12">
                                    <textarea class="form-control form-control" rows="3" placeholder=" "></textarea>
                                </div>
                            </div>
                            <div class="full mrb-10">
                                <div class="col-md-12 line-30">
                                    <label class="control-label">Bệnh tích</label>
                                </div>
                                <div class="col-md-12">
                                    <textarea class="form-control form-control" rows="3" placeholder=""></textarea>
                                </div>
                            </div>
                            <div class="full mrb-10">
                                <div class="col-md-12 line-30">
                                    <label class="control-label">Tiểu sử bệnh và dùng thuốc</label>
                                </div>
                                <div class="col-md-12">
                                    <textarea class="form-control form-control" rows="3" placeholder=""></textarea>
                                </div>
                            </div>
                            <div class="full mrb-10">
                                <div class="col-md-12 line-30">
                                    <label class="control-label">Chuẩn đoán</label>
                                </div>
                                <div class="col-md-12">
                                    <textarea class="form-control form-control" rows="3" placeholder=""></textarea>
                                </div>
                            </div>
                            <div class="full mrb-10">
                                <div class="col-md-12 line-30">
                                    <label class="control-label">Phác đồ điều trị</label>
                                </div>
                                <!-- .col-md-6.text-right-->
                                <!--   button.btn Thêm thuốc-->
                                <div class="col-md-12">
                                    <div class="input-search text-right" style="margin: 10px 0;">
                                        <input style="width: 50%;" name="Search" type="search" placeholder="Search" />
                                    </div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Tên thuốc</th>
                                                <th>Liều dùng</th>
                                                <th>Cách dùng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>ABC</td>
                                                <td>Ngày 2V</td>
                                                <td>Trộn thức ăn </td>
                                            </tr>
                                            <tr>
                                                <td>ABC</td>
                                                <td>Ngày 2V</td>
                                                <td>Trộn thức ăn </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="full mrb-10">
                                <div class="col-md-12 line-30">
                                    <label class="control-label">Ghi chú</label>
                                </div>
                                <div class="col-md-12">
                                    <textarea class="form-control form-control" rows="3" placeholder=""></textarea>
                                </div>
                            </div>
                            <div class="full text-center">
                                <button class="btn green pad-8-50">Tạo đơn thuốc</button>
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
        <!-- .member-->
    </div>
    <!--.page-container-->
@endsection
