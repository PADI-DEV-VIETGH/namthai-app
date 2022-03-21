<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>App Sale</title>
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
                            <h3 class="bold text-center">Danh sách đơn thuốc</h3>
                        </div>
                        <div class="list-thamkham">
                            <ul class="list-all-item">
                                @if(!empty($listPrescriptions))
                                    @foreach($listPrescriptions as $prescription)
                                        <li class="item">
                                            <div class="content-sale">
                                                <a href="#">
                                                    <div class="infor-sale name-sale">
                                                        <span class="title">
                                                            Tên farm:
                                                        </span>
                                                        <span class="cnt-sale">{{ $prescription['farm_name'] }}</span>
                                                    </div>
                                                    <div class="infor-sale">
                                                        <span class="title">
                                                            Địa chỉ:
                                                        </span>
                                                        <span class="cnt-sale">{{ $prescription['farm_address'] }}</span>
                                                    </div>
                                                    <div class="infor-sale">
                                                        <span class="title">
                                                            Số điện thoại:
                                                        </span>
                                                        <span class="cnt-sale">{{ $prescription['farm_phone'] }}</span>
                                                    </div>
                                                    <div class="infor-sale">
                                                        <span class="title">
                                                            Mã đơn thuốc:
                                                        </span>
                                                        <span class="cnt-sale">{{ $prescription['code'] }}</span>
                                                    </div>
                                                    <div class="infor-sale">
                                                        <span class="title">
                                                            Người tạo:
                                                        </span>
                                                        <span class="cnt-sale">{{ $prescription['created_by']['full_name'] }}</span>
                                                    </div>
                                                    <div class="infor-sale">
                                                        <span class="title">
                                                            Ngày tạo:
                                                        </span>
                                                        <span class="cnt-sale">{{ $prescription['created_at'] }}</span>
                                                    </div>
                                                    <div class="infor-sale">
                                                        <span class="title">
                                                            Trạng thái:
                                                        </span>
                                                        <span class="cnt-sale">{{ $prescription['status'] }}</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
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
<script type="text/javascript" src="/namthai/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/namthai/assets/js/owl.carousel.min.js"></script>

<!-- Theme Script-->
<script type="text/javascript" src="https://kit.fontawesome.com/8b9922aecc.js"></script>
<script type="text/javascript" src="/namthai/assets/js/admin.js"></script>
<script type="text/javascript" src="/namthai/assets/js/customer.js"></script>
</body>

</html>
