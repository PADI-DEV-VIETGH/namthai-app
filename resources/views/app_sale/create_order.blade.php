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
    <style>
        #sugget-result {
            width: calc(100% - 180px);
            float: right;
            position: absolute;
            right: 15px;
            background: #fff;
            top: 35px;
            z-index: 10;
            border: 1px solid #ddd;
            border-top: 0;
            display: none;
        }

        #sugget-result table {
            margin-bottom: 0;
        }

        #sugget-result tr {
            cursor: pointer;
        }

        #sugget-result td {
            font-size: 14px;
        }

        .image-loading {
            position: absolute;
            right: 10px;
            width: 40px;
            top: -2px;
            display: none;
        }

    </style>
</head>

<body class="page-header-fixed page-quick-sidebar-over-content">

    <div class="page-container">
        <form action="{!! route('app_sale.post.create_order') !!}" method="post" id="formOrder">
            @csrf
            <div class="page-content-wrapper page-register">
                <div class="page-content">
                    <div class="main-body-content member-page">
                        <div class="member-title-table">
                            <div class="logo text-center"><img src="/namthai/assets/images/logo.png" width="100px" />
                            </div>
                            <div class="title-page full border-bottom mrb-30">
                                <h3 class="bold text-center">Tạo đơn hàng</h3>
                            </div>
                            @include('alert')
                            <div class="full border-full content-detail pad-20-30 mrb-40">
                                <div class="full">
                                    <div class="col-md-3 col-xs-3">
                                        <label class="control-label">Chọn Đại lý</label>
                                    </div>
                                    <div class="col-md-9 col-xs-9">
                                        <select class="form-select form-control js-example-basic-single text-left"
                                            aria-label="Default select example" id="distributor" name="distributor_id">
                                        </select>
                                    </div>
                                </div>
                                <div class="full" style="position: relative">
                                    <div class="col-md-3 col-xs-3">
                                        <label class="control-label">Tên sản phẩm</label>
                                    </div>
                                    <div class="col-md-9 col-xs-9">
                                        <input class="form-control" type="text" placeholder="Cám" id="keyword"
                                            style="color: #505050;font-size: 16px;" />
                                    </div>
                                    <img src="https://stg.namthai.paditech.org/assets/img/loader.svg"
                                        class="image-loading">
                                    <div id="sugget-result">
                                        <table class="table">
                                            <tr>
                                                <td>Mã SP</td>
                                                <td>Tên SP</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="full">
                                    <div class="col-md-12">
                                        <label class="control-label">Loại hàng hóa</label>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table list-product-variant">
                                            <thead>
                                                <tr>
                                                    <th>Mã</th>
                                                    <th>Tên</th>
                                                    <th class="text-center">SL </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
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
        </form>
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
            ajax: {
                url: "{!! route('get.distributors') !!}",
                dataType: 'json'
            }
        });
        let timeout = null;
        $(`#keyword`).on('keyup', function() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                let keyword = $(this).val();
                $.ajax({
                    url: "{!! route('search.products') !!}",
                    method: 'get',
                    dataType: 'json',
                    data: {
                        'keyword': keyword
                    },
                    beforeSend: function() {
                        $('#sugget-result .table tbody').html(
                            '<tr><td>Mã SP</td><td>Tên SP</td></tr>');
                        $('#sugget-result').hide();
                        $('.image-loading').show();
                    },
                    success: function(data) {
                        $('#sugget-result .table tbody').append(data.html);
                        $('#sugget-result').show();
                        $('.image-loading').hide();
                    },
                    error: function() {
                        $('.image-loading').hide();
                    }
                });
            }, 1000);
        });
        $('body').on('click', '#sugget-result tr', function() {
            let code = $(this).attr('data-code');
            let name = $(this).attr('data-name');
            let id = $(this).attr('data-id');
            let html = `
                <tr>
                    <td>${code}</td>
                    <td>${name}</td>
                    <td class="text-center">
                        <input name="quantity[]" type="text" placeholder="1000" style="width: 80px;">
                        <input name="product_variant_id[]" value="${id}" type="hidden">
                    </td>
                </tr>
            `;
            $('.list-product-variant tbody').append(html);
            $('#sugget-result').hide();
        });
    </script>
</body>

</html>
