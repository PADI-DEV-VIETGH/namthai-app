<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'App Farm')</title>
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
    <link href="/assets/css/wipro.css" rel="stylesheet">
    <style>
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #555;
            line-height: 38px;
            font-size: 14px;
        }
        .content-detail .full .select2-selection span {
            line-height: 30px;
            height: 30px;
        }
    </style>
</head>
<body class="page-header-fixed page-quick-sidebar-over-content">

    @yield('content')
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
                timepicker:false,
                format: 'd/m/Y'
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            let province_id = 'province_id';
            let district_id = 'district_id';
            let ward_id = 'ward_id';

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
                        params['province_id'] = $('select[name="province_id"]').val();
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
                        params['district_id'] = $('select[name="district_id"]').val();
                        return params;
                    }
                }
            });

            $(`#animals`).select2({
                placeholder: 'Chọn loại vật nuôi',
                width: '100%',
                allowClear: true,
                language: {
                    noResults: function(term) {
                        return 'Không có kết quả';
                    }
                },
                ajax:{
                    url: "{!! route('get.animals') !!}",
                    dataType: 'json'
                }
            });
        });
    </script>
    @yield('script')
</body>
</html>
