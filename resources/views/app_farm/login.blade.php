<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Farm login</title>
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
        <form action="{{ route('app_farm.login') }}" method="post">
            @csrf
            <div class="page-content-wrapper page-register">
                <div class="page-content">
                    <div class="main-body-content member-page">
                        <div class="member-title-table">
                            <div class="logo text-center"><img src="/namthai/assets/images/logo.png" /></div>
                            <div class="title-page full border-bottom mrb-30">
                                <h3 class="bold text-center">Đăng nhập</h3>
                            </div>
                            <div class="full border-full pad-20-30 mrb-40">
                                <div class="full mrb-10">
                                    <div class="col-md-12 line-30">
                                        <label class="control-label">Số điện thoại</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text" placeholder="0123456789" name="phone_number"/>
                                    </div>
                                </div>
                                <div class="full mrb-10">
                                    <div class="col-md-12 line-30">
                                        <label class="control-label">Mật khẩu</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input class="form-control" type="password" placeholder="0123456789" name="password"/>
                                    </div>
                                    <div class="col-md-12 text-right"><a class="text-link-otp" href="#">Quên mật khẩu ?</a>
                                    </div>
                                </div>
                                <div class="full text-center">
                                    <button class="btn green pad-8-50">Đăng nhập</button>
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
    <script type="text/javascript" src="/namthai/assets/js/select2.min.js"></script>
    <script type="text/javascript" src="/namthai/assets/js/admin.js"></script>
    <script type="text/javascript" src="/namthai/assets/js/customer.js"></script>
</body>

</html>
