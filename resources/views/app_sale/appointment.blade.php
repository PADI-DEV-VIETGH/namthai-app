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
        <form method="post" action="{{ route('app_sale.store_appointment') }}" id="formPrescription">
            @csrf
        <div class="page-content-wrapper page-register">
            <div class="page-content">
                <div class="main-body-content member-page">
                    <div class="member-title-table">
                        <div class="logo text-center"><img src="/namthai/assets/images/logo.png" width="100px" /></div>
                        <div class="title-page full border-bottom mrb-30">
                            <h3 class="bold text-center">Chi tiết thăm khám</h3>
                        </div>
                        <div class="full border-full content-detail pad-20-30 mrb-40">
                            <div class="full">
                                <div class="col-md-3 col-xs-3">
                                    <label class="control-label">Tên FARM :</label>
                                </div>
                                <div class="col-md-9 col-xs-9"><span>Nguyễn Văn A</span></div>
                            </div>
                            <div class="full">
                                <div class="col-md-3 col-xs-3">
                                    <label class="control-label">Địa chỉ :</label>
                                </div>
                                <div class="col-md-9 col-xs-9"><span>539 Vũ Tông Phan - Thanh Xuân</span></div>
                            </div>
                            <div class="full">
                                <div class="col-md-3 col-xs-3">
                                    <label class="control-label">Số điện thoại :</label>
                                </div>
                                <div class="col-md-9 col-xs-9"><span>012345789</span></div>
                            </div>
                            <div class="full">
                                <div class="col-md-12 col-xs-12">
                                    <label class="control-label">Trạng thái thăm khám</label>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    <select name="status" class="form-control js-example-basic-single text-left"
                                        aria-label="Default select example">
                                        <option value="1" selected="selected">Đã xác nhận</option>
                                        <option value="2">Chưa xác nhận</option>
                                    </select>
                                </div>
                            </div>
                            <div class="full">
                                <div class="col-md-12 col-xs-12">
                                    <label class="control-label">Ảnh vật nuôi</label>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    <div class="upload__boxs">
                                        <div class="upload__img-wraps"></div>
                                        <div class="upload__btn-box">
                                            <label class="upload__btn"><span> <i class="fas fa-plus"></i></span>
                                                <input id="file" name="image" class="upload__inputfiles" type="file" accept="image/*"
                                                    data-max_length="11" />
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="arrImages" id="arrImage">
                            <div class="full text-center">
                                <button type="submit" class="btn green pad-8-50">Hoàn tất</button>
                                <button type="button" id="createPrescription" class="btn green pad-8-50">Tạo đơn thuốc</button>
                            </div>
                        </div>
                        <!--.table-member-mng-->
                    </div>
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
<style>
    .upload-images_input {
        height: 200px;
        position: relative;
        margin-bottom: 70px;
    }
    .upload-images_input img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        padding-bottom: 20px !important;
    }
</style>
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
        $('#createPrescription').click(function () {
            let url = '{!! route('app_sale.prescription') !!}';
            let form_data = new FormData($('#formPrescription')[0]);
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
                    window.location.href = "{{ route('app_sale.create_prescription') }}";
                },
                error: function (error) {
                    return error;
                }
            })
        })
        function html(src) {
            return `<div class="upload-images_input">
                        <img src="${src}" class="img-bg" />
                        <div class="upload__img-close">
                    </div>
                    <div>
                        <label>Comment</label>
                        <input type="text" class="form-control" name="comment[]"  value=' ' placeholder='comment' />
                    </div>
                    `
        }
        $('#file').on('change', function () {
            let url = '{!! route('app_sale.upload_file') !!}';
            let form_data = new FormData($('#formPrescription')[0]);
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
        })
    </script>
</body>

</html>
