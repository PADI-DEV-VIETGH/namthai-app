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
                                    <div class="thumb"><img src="/namthai/assets/images/new_sale.png" /></div>
                                    <div class="text">Chương trình khuyến mãi tháng 05.2021 ...</div>
                                </li>
                                <li>
                                    <div class="thumb"><img src="/namthai/assets/images/new_sale.png" /></div>
                                    <div class="text">Chương trình khuyến mãi tháng 05.2021 ...</div>
                                </li>
                                <li>
                                    <div class="thumb"><img src="/namthai/assets/images/new_sale.png" /></div>
                                    <div class="text">Chương trình khuyến mãi tháng 05.2021 ...</div>
                                </li>
                            </ul>
                        </div>
                    </section>
                    <section class="content-sec mrb-10">
                        <div class="title-sec">Hoạt động</div>
                        <div class="list-action">
                            <ul>
                                <li>
                                    @if(isset($dataCheckIn) && $dataCheckIn)
                                        <a href="{{ route('app_sale.checkout') }}">
                                            <div class="thumb"><img src="/namthai/assets/images/check.png" /></div>
                                            <div class="text">Checkout</div>
                                        </a>
                                    @else
                                        <a href="{{ route('app_sale.list_working_plan') }}">
                                            <div class="thumb"><img src="/namthai/assets/images/check.png" /></div>
                                            <div class="text">Checkin</div>
                                        </a>
                                    @endif
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="thumb"><img src="/namthai/assets/images/history.png" /></div>
                                        <div class="text">Lịch sử chấm công</div>
                                    </a>
                                </li>
                                @if(isset($dataCheckIn['type']) && $dataCheckIn['type'] == 'distributor')
                                <li>
                                    <a href="{{ route('app_sale.product_inventory') }}">
                                        <div class="thumb"><img src="/namthai/assets/images/page.png" /></div>
                                        <div class="text">Kiểm kê hàng hóa</div>
                                    </a>
                                </li>
                                @endif
                                @if(isset($dataCheckIn['type']) && $dataCheckIn['type'] == 'farm')
                                <li>
                                    <a href="{{ route('app_sale.appointment') }}">
                                        <div class="thumb"><img src="/namthai/assets/images/don.png" /></div>
                                        <div class="text">Thăm khám</div>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </section>
                    <section class="content-sec mrb-10">
                        <div class="title-sec">Quản lý đơn</div>
                        <div class="list-action">
                            <ul>
                                <li>
                                    <a href="{{ route('app_sale.order') }}">
                                        <div class="thumb"><img src="/namthai/assets/images/don.png" /></div>
                                        <div class="text">Đơn đặt hàng</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('app_sale.prescription') }}">
                                        <div class="thumb"><img src="/namthai/assets/images/don.png" /></div>
                                        <div class="text">Đơn thuốc</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </section>
                    <section class="content-sec">
                        <div class="title-sec">Tra cứu thông tin</div>
                        <div class="list-action">
                            <ul>
                                <li>
                                    <a href="#">
                                        <div class="thumb"><img src="/namthai/assets/images/check.png" /></div>
                                        <div class="text">Danh sách đại lý</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="thumb"><img src="/namthai/assets/images/history.png" /></div>
                                        <div class="text">Danh sách farm</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="thumb"><img src="/namthai/assets/images/page.png" /></div>
                                        <div class="text">Kế hoạch chấm công</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
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
    <script type="text/javascript" src="https://kit.fontawesome.com/8b9922aecc.js"></script>
    <script type="text/javascript" src="/namthai/assets/js/select2.min.js"></script>
    <script type="text/javascript" src="/namthai/assets/js/admin.js"></script>
    <script type="text/javascript" src="/namthai/assets/js/customer.js"></script>
</body>

</html>
