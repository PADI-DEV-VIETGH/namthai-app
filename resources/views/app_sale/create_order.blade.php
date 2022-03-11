<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>bike code list</title>
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
                            <h3 class="bold text-center">Tạo đơn hàng</h3>
                        </div>
                        <div class="full border-full content-detail pad-20-30 mrb-40">
                            <div class="full">
                                <div class="col-md-3 col-xs-3">
                                    <label class="control-label">Chọn Đại lý</label>
                                </div>
                                <div class="col-md-9 col-xs-9">
                                    <select class="form-select form-control js-example-basic-single text-left"
                                        aria-label="Default select example" id="distributor">
                                        <option selected="selected">Đại lý</option>
                                        <option value="1">Đại lý A</option>
                                        <option value="2">Đại lý B</option>
                                        <option value="3">Đại lý C</option>
                                    </select>
                                </div>
                            </div>
                            <div class="full">
                                <div class="col-md-3 col-xs-3">
                                    <label class="control-label">Tên sản phẩm</label>
                                </div>
                                <div class="col-md-9 col-xs-9">
                                    <input class="form-control" type="text" placeholder="Cám" />
                                </div>
                            </div>
                            <div class="full">
                                <div class="col-md-12">
                                    <label class="control-label">Loại hàng hóa</label>
                                </div>
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Mã</th>
                                                <th>Tên</th>
                                                <th class="text-center">SL </th>
                                                <th>Đơn vị</th>
                                                <th>CK</th>
                                                <th>Tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>001</td>
                                                <td>Cám</td>
                                                <td class="text-center">
                                                    <input type="text" placeholder="1000">
                                                </td>
                                                <td>bao</td>
                                                <td>5%</td>
                                                <td>10tr</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="total bold"><strong>Tổng tiền:</strong><strong>40 000 000</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="full text-center">
                                <button class="btn green pad-8-50">Gửi</button>
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

    <script>
        $(`#distributor`).select2({
            placeholder: 'Chọn đại lý',
            width: '100%',
            allowClear: true,
            language: {
                noResults: function(term) {
                    return 'Không có kết quả';
                }
            },
            ajax:{
                url: "{!! route('get.distributors') !!}",
                dataType: 'json'
            }
        });
    </script>
</body>

</html>
