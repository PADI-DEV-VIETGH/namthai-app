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
    <link rel="stylesheet" type="text/css" href="/namthai/assets/css/custom.css">
    <link rel="stylesheet" type="text/css" href="/namthai/assets/css/admin.css">

</head>

<body class="page-header-fixed page-quick-sidebar-over-content">
    <div class="page-container">
        <!--include ../includes/header.jade-->

        <div class="page-content-wrapper">
            <div class="container">
                <div class="page-content">
                    <div class="title-page full border-bottom mrb-30">
                        <h3 class="bold text-center">Danh sách kế hoạch làm việc</h3>
                    </div>
                    <section class="content-map">
                        <div class="time-line">
                            <div class="date">
                                <span>{{ \Carbon\Carbon::now()->startOfWeek()->format('d/m/Y') }}</span> -
                                <span>{{ \Carbon\Carbon::now()->endOfWeek()->format('d/m/Y') }}</span>
                            </div>
                        </div>
                        @if (!empty($listWorkingPlan))
                            @foreach($listWorkingPlan as $workingPlan)
                                <a href="#" onclick="redirectCheckIn(this)">
                                    <div class="cnt-map-check mrb-20">
                                        <div class="cnt-left" style="color: #212121;">
                                            <h4 class="title-cnt">{{ $workingPlan['addressable']['data']['name'] }}</h4>
                                            <div class="date">{{ $workingPlan['day_of_week']. ' ngày ' . Carbon\Carbon::createFromFormat('Y-m-d', $workingPlan['date'])->format('d/m/Y') }}</div>
                                            <div class="code">{{ $workingPlan['addressable']['type'] == 'farm'? "Mã farm: " : "Mã đại lý: " }}{{ $workingPlan['addressable']['data']['code'] }}</div>
                                            <div class="address">{{ $workingPlan['addressable']['data']['addr_detail'] }}</div>
                                            <input type="hidden" name="id" class="id_address" value="{{ $workingPlan['id'] }}">
                                            <input type="hidden" name="type" class="type" value="{{ $workingPlan['addressable']['type'] }}">
                                            <input type="hidden" name="phone_number" class="phone_number" value="{{ $workingPlan['addressable']['data']['phone_number'] }}">
                                        </div>
                                        <div class="cnt-img-map"><img class="image" src="{{ $workingPlan['addressable']['data']['image'] ? $workingPlan['addressable']['data']['image'] : '/namthai/assets/images/map.png' }}" alt="" /></div>
                                    </div>
                                </a>
                            @endforeach
                        @endif
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
    <script type="text/javascript" src="/namthai/assets/js/admin.js"></script>
    <script type="text/javascript" src="/namthai/assets/js/customer.js"></script>
<script>
    function redirectCheckIn(e) {
        let array = {
            'title' : $(e).find('.title-cnt').text(),
            'date' : $(e).find('.date').text(),
            'code' : $(e).find('.code').text(),
            'address' : $(e).find('.address').text(),
            'id' : $(e).find('.id_address').val(),
            'type' : $(e).find('.type').val(),
            'phone_number' : $(e).find('.phone_number').val(),
            'image' : $(e).find('.image').attr('src'),
        };
        localStorage.setItem('dataCheckIn', JSON.stringify(array));
        if (localStorage.getItem('dataCheckIn')) {
            window.location.href = '{{ route('app_sale.check_in') }}'
        }
    }
</script>
</body>

</html>
