<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Farm Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Vendor CSS (GLOBAL MANDATORY STYLES)-->
    <link rel="stylesheet" type="text/css" href="/namthai/assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/namthai/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/namthai/assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" type="text/css" href="/namthai/assets/css/owl.carousel.min.css">
    <!-- Select2 css-->
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{!! asset('assets/css/jquery.datetimepicker.min.css') !!}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
        rel="stylesheet">


    <!-- Theme CSS-->
    <link rel="stylesheet" type="text/css" href="/namthai/assets/css/custom.css">
    <link rel="stylesheet" type="text/css" href="/namthai/assets/css/admin.css">
    <style>
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #555;
            line-height: 38px;
            font-size: 14px;
        }
    </style>
</head>

<body class="page-header-fixed page-quick-sidebar-over-content">

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
                            <div class="full border-full pad-20-30 mrb-40">
                                <div class="full mrb-10">
                                    <div class="col-md-3 line-30">
                                        <label class="control-label">Họ tên</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" placeholder="Nguyễn Văn A" />
                                    </div>
                                </div>
                                <div class="full mrb-10">
                                    <div class="col-md-3 line-30">
                                        <label class="control-label">Ngày sinh</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" placeholder="dd/mm/yyyy" />
                                    </div>
                                </div>
                                <div class="full mrb-10">
                                    <div class="col-md-3">
                                        <label class="control-label">Giới tính</label>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" id="inlineCheckbox1" type="checkbox" />
                                            <label class="form-check-label" for="inlineCheckbox1">Nam</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" id="inlineCheckbox1" type="checkbox" />
                                            <label class="form-check-label" for="inlineCheckbox1">Nữ</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="full mrb-10">
                                    <div class="col-md-3 line-30">
                                        <label class="control-label">Số điện thoại</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" placeholder="0123456789" />
                                    </div>
                                </div>
                                <div class="full mrb-10">
                                    <div class="col-md-12 line-30">
                                        <label class="control-label">Địa chỉ</label>
                                    </div>
                                    <div class="col-md-12 mrb-10">
                                        <select id="province" name="province" class="form-select" aria-label="Default select example">
                                        </select>
                                    </div>
                                    <div class="col-md-12 mrb-10">
                                        <select id="district" name="district" class="form-select" aria-label="Default select example">
                                        </select>
                                    </div>
                                    <div class="col-md-12 mrb-10">
                                        <select id="ward" name="ward" class="form-select" aria-label="Default select example">
                                        </select>
                                    </div>
                                    <div class="col-md-12 mrb-10">
                                        <input class="form-control" name="address" type="text" placeholder="Địa chỉ" />
                                    </div>
                                </div>
                                <div class="full mrb-10">
                                    <div class="col-md-12 line-30">
                                        <label>Mật Khẩu</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input class="form-control" type="password" placeholder="****" />
                                    </div>
                                </div>
                                <div class="full mrb-10">
                                    <div class="col-md-12 line-30">
                                        <label>Xác nhận mật khẩu</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input class="form-control" type="password" placeholder="****" />
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
    <!--.page-container-->

    <!-- Vendor jQuery (CORE PLUGINS - METRONIC)-->
    <script type="text/javascript" src="/namthai/assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="/namthai/assets/js/bootstrap.min.js"> </script>
    <script type="text/javascript" src="/namthai/assets/js/owl.carousel.min.js"></script>

    <!-- Theme Script-->
    <script type="text/javascript" src="https://kit.fontawesome.com/8b9922aecc.js"></script>
    <script type="text/javascript" src="/namthai/assets/js/admin.js"></script>
    <script type="text/javascript" src="/namthai/assets/js/customer.js"></script>

    <!-- Select2 js-->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="{!! asset('assets/js/jquery.datetimepicker.full.min.js') !!}"></script>
    <script>
        $(document).ready(function () {
            $.datetimepicker.setLocale('vi');
            $('.datetimepicker').datetimepicker({
                format: 'd/m/Y',
                minDate: new Date()
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            let province_id = 'province';
            let district_id = 'district';
            let ward_id = 'ward';
            $(`#${province_id}`).select2({
                placeholder: 'Chọn Tỉnh/Thành Phố',
                width: '100%',
                allowClear: true,
                language: {
                    noResults: function(term) {
                        return 'Không có kết quả';
                    }
                },
                ajax:{
                    url: "{!! route('get.provinces') !!}",
                    dataType: 'json'
                }
            });
            $(`#${district_id}`).select2({
                placeholder: 'Chọn Quận/Huyện',
                width: '100%',
                allowClear: true,
                language: {
                    noResults: function(term) {
                        return 'Không có kết quả';
                    }
                },
                ajax:{
                    url: "{!! route('get.districts') !!}",
                    dataType: 'json',
                    data: function (params) {
                        params['province_id'] = $('select[name="province"]').val();
                        return params;
                    }
                }
            });
            $(`#${ward_id}`).select2({
                placeholder: 'Chọn Xã/Phường',
                width: '100%',
                allowClear: true,
                language: {
                    noResults: function(term) {
                        return 'Không có kết quả';
                    }
                },
                ajax:{
                    url: "{!! route('get.wards') !!}",
                    dataType: 'json',
                    data: function (params) {
                        params['district_id'] = $('select[name="district"]').val();
                        return params;
                    }
                }
            });

            $(`#${province_id}`).on('change', function(){
                $(`#${district_id}`).trigger('change');
                $(`#${ward_id}`).trigger('change');
            });

            $(`#${district_id}`).on('change', function(){
                $(`#${ward_id}`).trigger('change');
            });
        });
    </script>
</body>

</html>
