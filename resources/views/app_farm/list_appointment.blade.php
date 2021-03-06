<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Danh sách yêu cầu thăm khám</title>
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
    <!--include ../includes/header.jade-->

    <div class="page-container">
        <!--include ../includes/header.jade-->

        <div class="page-content-wrapper">
            <div class="container">
                <div class="page-content">
                    <div class="main-body-content member-page">
                        <div class="member-title-table">
                            <div class="title-page full border-bottom mrb-30">
                                <h3 class="bold text-center">Danh sách yêu cầu thăm khám</h3>
                            </div>
                            @include('alert')
                            <div class="list-thamkham">
                                <ul class="list-all-item">
                                    @foreach($appointments as $value)
                                    <li class="item">
                                        <div class="content-sale">
                                            <a href="{!! route('app_farm.show_appointment', $value['id']) !!}">
                                                <div class="infor-sale name-sale"> 
                                                    <span class="title">Sale :
                                                    </span><span class="cnt-sale">{!! $employee['full_name'] ?? 'Chưa xác định' !!}</span>
                                                </div>
                                                <div class="infor-sale name-date">
                                                    <span class="title">Ngày tạo:</span>
                                                    <span class="cnt-sale">{!! $value['created_at'] !!}</span>
                                                </div>
                                                <div class="infor-sale name-date"><span class="title">Ngày dự kiến :</span>
                                                    <span class="cnt-sale">{!! $value['expect_appointment'] !!}</span>
                                                </div>
                                            </a>
                                            <div class="infor-sale list-btn">
                                                <button class="btn btn-sms">SMS</button>
                                                <button class="btn btn-call">Call</button>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
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
