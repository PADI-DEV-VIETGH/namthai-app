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
<div class="header-fix">
    <div class="page-header">
        <div class="container">
            <div class="page-header-inner header-back">
                <!-- BEGIN LOGO-->
                <div class="cnt-back"><a href="#"><img src="/namthai/assets/images/back.png"/></a></div>
                <div class="information-user"><span class="title-page">Checkin</span></div>
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
                <form action="{{ route('app_sale.store_check_in') }}" id="storeCheckIn" method="post">
                    @csrf
                    <section class="content-map">
                        <div class="title-sec">Địa điểm làm việc</div>
                        <div class="cnt-map-check">
                            <div class="cnt-left">
                                <h4 class="title-cnt"></h4>
                                <div class="date"></div>
                                <div class="code"></div>
                                <div class="address"></div>
                                <input type="hidden" name="idAddress" value="" id="idAddress"/>
                            </div>
                            <div class="cnt-img-map"><img class="imageAddress" src="" alt=""/></div>
                        </div>
                    </section>
                    <section class="content-sec mrb-10">
                        <div class="title-sec">Chụp ảnh Selfie</div>
                        <div class="list-action">
                            <div class="upload__box">
                                <div class="upload__img-wrap_selfie" id="uploadSelfie"></div>
                                <div class="upload__btn-box">
                                    <label class="upload__btn"><span> <i class="fas fa-plus"></i></span>
                                        <input class="upload__inputfile" type="file" id="selfie" name="selfie"
                                               accept="image/*"/>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="title-sec">Ảnh nơi thăm khám (tối đa 12 ảnh)</div>
                        <div class="list-action">
                            <div class="upload__boxs">
                                <div class="upload__img-wraps"></div>
                                <div class="upload__btn-box">
                                    <label class="upload__btn"><span> <i class="fas fa-plus"></i></span>
                                        <input name="image" id="file" accept="image/*" class="upload__inputfiles"
                                               type="file" data-max_length="12"/>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="latLng" id="latLng"/>
                        <input type="hidden" name="arrImages" id="arrImage">
                        <input type="hidden" name="imageSelfie" id="imageSelfie">
                        <input type="hidden" name="idAddress" class="id_address"/>
                        <input type="hidden" name="type" class="typeFarmOrDistributor"/>
                        <input type="hidden" name="nameFarm" class="title"/>
                        <input type="hidden" name="address" class="addressFarm"/>
                        <input type="hidden" name="phone_number" class="phone_number"/>
                        <div class="title-sec">Tra cứu Vị trí</div>
                        <div class="list-action mrb-20">
                            <div id="map" style="height: 500px; width: 100%;"></div>
                        </div>
                        <button type="submit" class="btn green pad-8-50 wdt-100">Chấm công</button>
                    </section>
                </form>
                <!-- .block-1-->
            </div>
            <!-- .member-main-->
        </div>
        <!-- .page-content-->
    </div>
    <!-- .member-->
</div>
<style>
    .upload-images_selfie_input {
        height: 200px;
        position: relative;
        width: 200px;
    }

    .upload-images_selfie_input img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        padding-bottom: 20px !important;
    }

    .upload-images_input {
        height: 200px;
        position: relative;
        width: 200px;
    }

    .upload-images_input img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        padding-bottom: 20px !important;
    }
</style>
<!--.page-container-->
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPjQoCIJAW88qJrqBOxpd-HEXAoTTRlQk&callback=initMap&v=weekly"
        async
></script>
<!-- Vendor jQuery (CORE PLUGINS - METRONIC)-->
<script type="text/javascript" src="/namthai/assets/js/jquery.min.js"></script>
<script type="text/javascript" src="/namthai/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/namthai/assets/js/owl.carousel.min.js"></script>

<!-- Theme Script-->
<script type="text/javascript" src="https://kit.fontawesome.com/8b9922aecc.js"></script>
<script type="text/javascript" src="/namthai/assets/js/select2.min.js"></script>
<script type="text/javascript" src="/namthai/assets/js/admin.js"></script>
<script type="text/javascript" src="/namthai/assets/js/customer.js"></script>
<script>
    let dataCheckIn = localStorage.getItem('dataCheckIn');
    let objCheckIn = JSON.parse(dataCheckIn);
    $('.title-cnt').html(objCheckIn.title);
    $('.title').val(objCheckIn.title);
    $('.addressFarm').val(objCheckIn.address);
    $('.date').html(objCheckIn.date);
    $('.code').html(objCheckIn.code);
    $('.address').html(objCheckIn.address);
    $('.id_address').val(parseInt(objCheckIn.id));
    $('.typeFarmOrDistributor').val(objCheckIn.type);
    $('.phone_number').val(objCheckIn.phone_number);
    $('.imageAddress').attr('src', objCheckIn.image);

    function initMap() {
        const myLatlng = {lat: 21.030653, lng: 105.847130};
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 12,
            center: myLatlng,
        });
        // Create the initial InfoWindow.
        let infoWindow = new google.maps.InfoWindow({
            content: "Click the map to get Lat/Lng!",
            position: myLatlng,
        });

        infoWindow.open(map);
        // Configure the click listener.
        map.addListener("click", (mapsMouseEvent) => {
            // Close the current InfoWindow.
            infoWindow.close();
            // Create a new InfoWindow.
            infoWindow = new google.maps.InfoWindow({
                position: mapsMouseEvent.latLng,
            });
            infoWindow.setContent(
                JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
            );
            $('#latLng').val(JSON.stringify(mapsMouseEvent.latLng.toJSON()));
            infoWindow.open(map);
        });
    }

    function html(src) {
        return `<div class="upload-images_input">
                        <img src="${src}" class="img-bg" />
                        <div class="abc-close">
                    </div>
                    `
    }

    function htmlSelfie(src) {
        return `<div class="upload-images_selfie_input">
                        <img src="${src}" class="img-bg-selfie" />
                        <div class="abc-close">
                    </div>
                    `
    }

    $('#file').on('change', function () {
        if ($('.upload__img-wraps').find('.upload-images_input').length > 11) {
            return false;
        }
        let url = '{!! route('app_sale.upload_file') !!}';
        let form_data = new FormData($('#storeCheckIn')[0]);
        form_data.append('_token', '{{ csrf_token() }}');
        $.ajax({
            url: url,
            method: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: 'json',
            success: function (data) {
                if (data.status === 200) {
                    $('.upload__img-wraps').append(html(data.data.image_url));
                    let arrayImage = [];
                    $('.img-bg').each(function () {
                        arrayImage.push($(this).attr('src'));
                    })
                    $('#arrImage').val(arrayImage);
                }
            },
            error: function (error) {
                return error;
            }
        })
    });
    $('#selfie').on('change', function () {
        let url = '{!! route('app_sale.upload_file_selfie') !!}';
        let form_data = new FormData($('#storeCheckIn')[0]);

        form_data.append('_token', '{{ csrf_token() }}');
        $.ajax({
            url: url,
            method: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: 'json',
            success: function (data) {
                if (data.status === 200) {
                    if ($('#uploadSelfie').children().length > 0) {
                        $('#uploadSelfie').find('.img-bg-selfie').attr('src', data.data.image_url);
                    } else {
                        $('#uploadSelfie').append(htmlSelfie(data.data.image_url));
                    }
                    $('#imageSelfie').val($('.img-bg-selfie').attr('src'));
                }
            },
            error: function (error) {
                return error;
            }
        })
    });
</script>
</body>

</html>
