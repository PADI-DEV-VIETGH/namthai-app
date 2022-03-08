<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Trang chủ</title>
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
    <div class="header-fix">
        <div class="page-header">
            <div class="container">
                <div class="page-header-inner">
                    <!-- BEGIN LOGO-->
                    <div class="cnt-user"><a href="#"><img src="/namthai/assets/images/icon.png" /></a></div>
                    <div class="information-user"><span class="title-page">Bảng điều khiển</span></div>
                    <div class="thumbnail-user"><a href="#"><img src="/namthai/assets/images/bell.png" /></a></div>
                </div>
                <!-- .top-menu-->
            </div>
        </div>
        <!-- .page-header-->
    </div>
    <div class="clearfix"></div>

    <div class="page-container">
        <!--include ../includes/header.jade-->

        <div class="page-content-wrapper">
            <div class="container">
                <div class="page-content">
                    <section class="new-home">
                        <div class="title-sec">Tin tức - Khuyến mãi</div>
                        <div class="list-news">
                            <ul class="owl-carousel new-cowl">
                                <li>
                                    <div class="thumb"><img src="/namthai/assets/images/thumb.png" /></div>
                                </li>
                                <li>
                                    <div class="thumb"><img src="/namthai/assets/images/thumb.png" /></div>
                                </li>
                                <li>
                                    <div class="thumb"><img src="/namthai/assets/images/thumb.png" /></div>
                                </li>
                            </ul>
                        </div>
                    </section>
                    <section class="list-content-home">
                        <ul class="list-item-btn">
                            <li class="item"><a href="{{ route('app_farm.create_appointment') }}">Tạo yêu cầu thăm khám</a></li>
                            <li class="item"><a href="{{ route('app_farm.list_appointment') }}">Xem danh sách thăm khám</a></li>
                        </ul>
                    </section>
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
    <script type="text/javascript" src="/namthai/assets/js/select2.min.js"></script>
    <script type="text/javascript" src="https://kit.fontawesome.com/8b9922aecc.js"></script>
    <script type="text/javascript" src="/namthai/assets/js/admin.js"></script>
    <script type="text/javascript" src="/namthai/assets/js/customer.js"></script>
</body>

</html>
