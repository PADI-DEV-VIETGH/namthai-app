<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Chi tiết thăm khám</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Vendor CSS (GLOBAL MANDATORY STYLES)-->
    <link rel="stylesheet" type="text/css" href="/namthai/assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/namthai/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/namthai/assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" type="text/css" href="/namthai/assets/css/owl.carousel.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
        rel="stylesheet">


    <!-- Theme CSS-->
    <link rel="stylesheet" type="text/css" href="/namthai/assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/namthai/assets/css/custom.css">
    <link rel="stylesheet" type="text/css" href="/namthai/assets/css/admin.css">

</head>

<body class="page-header-fixed page-quick-sidebar-over-content">

    <div class="page-container">

        <div class="page-content-wrapper page-register">
            <div class="page-content">
                <div class="main-body-content member-page">
                    <div class="member-title-table">
                        <div class="logo text-center"><img src="/namthai/assets/images/logo.png" width="100px" /></div>
                        <div class="title-page full border-bottom mrb-30">
                            <h3 class="bold text-center">Chi tiết thăm khám</h3>
                        </div>
                        <div class="full border-full content-detail pad-20-30 mrb-40">
                            <div class="full">
                                <div class="col-md-3 col-xs-3">
                                    <label class="control-label">Tên FARM :</label>
                                </div>
                                <div class="col-md-9 col-xs-9"><span>{{ $farm['full_name']??'' }}</span></div>
                            </div>
                            <div class="full">
                                <div class="col-md-3 col-xs-3">
                                    <label class="control-label">Số điện thoại :</label>
                                </div>
                                <div class="col-md-9 col-xs-9"><span>{{ $farm['phone_number']??'' }}</span></div>
                            </div>
                            <div class="full">
                                <div class="col-md-3 col-xs-3">
                                    <label class="control-label">Thông tin Sale :</label>
                                </div>
                                <div class="col-md-9 col-xs-9"><span>{{ $employee['full_name']??'' }}</span></div>
                            </div>
                            <div class="full">
                                <div class="col-md-12 col-xs-12 list-btn-sms">
                                    <button class="mrr-10 btn btn-sms">SMS</button>
                                    <button class="mrl-10 btn btn-call">Call</button>
                                </div>
                            </div>
                            {{-- <div class="full">
                                <div class="col-md-3 col-xs-3">
                                    <label class="control-label">Ngày tạo :</label>
                                </div>
                                <div class="col-md-9 col-xs-9"><span>{{ $appointment['created_at']??'' }}</span></div>
                            </div>
                            <div class="full">
                                <div class="col-md-4 col-xs-4">
                                    <label class="control-label">Ngày dự kiến tới :</label>
                                </div>
                                <div class="col-md-8 col-xs-8"><span>{{ $appointment['expect_appointment']??'' }}</span></div>
                            </div> --}}
                            <div class="full mrb-10">
                                <div class="col-md-12 line-30">
                                    <label class="control-label">Loại vật nuôi thăm khám</label>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    <div class="content-box">{{ $appointment['animals_text'] }}</div>
                                </div>
                            </div>
                            <div class="full mrb-10">
                                <div class="col-md-12 line-30">
                                    <label class="control-label">Triệu chứng</label>
                                    <div class="content-box">{{ $appointment['symptom'] }}</div>
                                </div>
                            </div>
                            <div class="full">
                                <div class="col-md-12 line-30">
                                    <label class="control-label">Ảnh vật nuôi</label>
                                    <div class="list-images">
                                        @foreach($appointment['list_image'] as $value)
                                        <span><img src="{{ $value }}" /></span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="full mrb-10">
                                <div class="col-md-12 line-30">
                                    <label class="control-label">Ghi chú</label>
                                    <div class="content-box"><span>{{ $appointment['note'] }}</span></div>
                                </div>
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

    <!-- Vendor jQuery (CORE PLUGINS - METRONIC)-->
    <script type="text/javascript" src="/namthai/assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="/namthai/assets/js/bootstrap.min.js"> </script>
    <script type="text/javascript" src="/namthai/assets/js/owl.carousel.min.js"></script>

    <!-- Theme Script-->
    <script type="text/javascript" src="https://kit.fontawesome.com/8b9922aecc.js"></script>
    <script type="text/javascript" src="/namthai/assets/js/select2.min.js"></script>
    <script type="text/javascript" src="/namthai/assets/js/admin.js"></script>
    <script type="text/javascript" src="/namthai/assets/js/customer.js"></script>
</body>

</html>
