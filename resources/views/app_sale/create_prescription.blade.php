@extends('master')

@section('content')
    <div class="page-container">

        <div class="page-content-wrapper page-register">
            <div class="page-content">
                <div class="main-body-content member-page">
                    <div class="member-title-table">
                        <form action="{{ route('app_sale.store_prescription') }}" method="post" >
                            @csrf
                            <div class="logo text-center"><img src="/namthai/assets/images/logo.png" width="100px" /></div>
                            <div class="title-page full border-bottom mrb-30">
                                <h3 class="bold text-center">Tạo đơn thuốc</h3>
                            </div>
                            <div class="full border-full content-detail pad-20-30 mrb-40">
                                <div class="full">
                                    <div class="col-md-3 col-xs-3">
                                        <label class="control-label">Tên FARM :</label>
                                    </div>
                                    <div class="col-md-9 col-xs-9"><span>{{ $dataCheckIn['name_farm'] }}</span></div>
                                </div>
                                <div class="full">
                                    <div class="col-md-3 col-xs-3">
                                        <label class="control-label">Địa chỉ :</label>
                                    </div>
                                    <div class="col-md-9 col-xs-9"><span>{{ $dataCheckIn['address'] }}</span></div>
                                </div>
                                <div class="full">
                                    <div class="col-md-3 col-xs-3">
                                        <label class="control-label">Số điện thoại :</label>
                                    </div>
                                    <div class="col-md-9 col-xs-9"><span>{{ $dataCheckIn['phone_number'] }}</span></div>
                                </div>
                                <div class="full">
                                    <div class="col-md-3 col-xs-3">
                                        <label class="control-label">Thông tin Sale :</label>
                                    </div>
                                    <div class="col-md-9 col-xs-9"><span>{{ $dataLogin['full_name'] }}</span></div>
                                </div>
                                <div class="full mrb-10">
                                    <div class="col-md-12 line-30">
                                        <label class="control-label">Chọn đại lý</label>

                                        <select class="form-select form-control js-example-basic-single text-left"
                                                aria-label="Default select example" id="distributor" name="distributor_id">
                                        </select>
                                    </div>
                                </div>
                                <div class="full mrb-10">
                                    <div class="col-md-12 line-30">
                                        <label class="control-label">Loại vật nuôi</label>
                                        <select class="form-control js-example-basic-single text-left" id="selectAnimals" name="animals[]" multiple="multiple"></select>
                                    </div>
                                </div>
                                <div class="full mrb-10">
                                    <div class="col-md-3"><span>Trọng lượng: </span></div>
                                    <div class="col-md-3">
                                        <input name="weight" class="form-control" type="text" placeholder="0.4kg" />
                                    </div>
                                    <div class="col-md-2"><span>Số lượng: </span></div>
                                    <div class="col-md-3">
                                        <input name="quantity" class="form-control" type="text" placeholder="1000" />
                                    </div>
                                </div>
                                <div class="full mrb-10">
                                    <div class="col-md-12 line-30">
                                        <label class="control-label">Loại thức ăn</label>
                                    </div>
                                    <div class="col-md-12">
                                        <textarea name="food" class="form-control form-control" rows="3"
                                            placeholder="Cám,..."></textarea>
                                    </div>
                                </div>
                                <div class="full mrb-10">
                                    <div class="col-md-12 line-30">
                                        <label class="control-label">Triệu chứng</label>
                                    </div>
                                    <div class="col-md-12">
                                        <textarea name="symptom" class="form-control form-control" rows="3" placeholder=" "></textarea>
                                    </div>
                                </div>
                                <div class="full mrb-10">
                                    <div class="col-md-12 line-30">
                                        <label class="control-label">Bệnh tích</label>
                                    </div>
                                    <div class="col-md-12">
                                        <textarea name="sickness" class="form-control form-control" rows="3" placeholder=""></textarea>
                                    </div>
                                </div>
                                <div class="full mrb-10">
                                    <div class="col-md-12 line-30">
                                        <label class="control-label">Tiểu sử bệnh và dùng thuốc</label>
                                    </div>
                                    <div class="col-md-12">
                                        <textarea name="prehistoric" class="form-control form-control" rows="3" placeholder=""></textarea>
                                    </div>
                                </div>
                                <div class="full mrb-10">
                                    <div class="col-md-12 line-30">
                                        <label class="control-label">Chuẩn đoán</label>
                                    </div>
                                    <div class="col-md-12">
                                        <textarea name="diagnostic" class="form-control form-control" rows="3" placeholder=""></textarea>
                                    </div>
                                </div>
                                <div class="full mrb-10">
                                    <div class="col-md-12 line-30">
                                        <label class="control-label">Phác đồ điều trị</label>
                                    </div>
                                    <!-- .col-md-6.text-right-->
                                    <!--   button.btn Thêm thuốc-->
                                    <div class="col-md-12">
                                        <div class="input-search text-right" style="margin: 10px 0;">
                                            <input style="width: 50%;" name="search" id="keyword" type="search" placeholder="Search" />
                                        </div>
                                        <img src="https://stg.namthai.paditech.org/assets/img/loader.svg"
                                             class="image-loading">
                                        <div id="sugget-result">
                                            <table class="table">
                                                <tr>
                                                    <td>Mã sản phẩm</td>
                                                    <td>Tên sản phẩm</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <table class="table list-product-variant">
                                            <thead>
                                                <tr>
                                                    <th>Mã sản phẩm</th>
                                                    <th>Tên sản phẩm</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="full mrb-10">
                                    <div class="col-md-12 line-30">
                                        <label class="control-label">Ghi chú</label>
                                    </div>
                                    <div class="col-md-12">
                                        <textarea name="note" class="form-control form-control" rows="3" placeholder=""></textarea>
                                    </div>
                                </div>
                                <div class="full text-center">
                                    <button type="submit" class="btn green pad-8-50">Tạo đơn thuốc</button>
                                </div>
                            </div>

                            <input type="hidden" name="examination_id" value="" id="examination">
                        </form>
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
    <style>
        #sugget-result {
            width: calc(100% - 180px);
            float: right;
            position: absolute;
            right: 15px;
            background: #fff;
            top: 48px;
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
            top: 6px;
            display: none;
        }

    </style>
    @section('script')
        <script>
            $(`#distributor`).select2({
                placeholder: 'Chọn đại lý',
                width: '100%',
                allowClear: true,
                language: {
                    noResults: function (term) {
                        return 'Không có kết quả';
                    }
                },
                ajax: {
                    url: "{!! route('get.distributors') !!}",
                    dataType: 'json'
                }
            });
            $('#examination').val(localStorage.getItem('idFarm'));
            $(`#selectAnimals`).select2({
                placeholder: 'Chọn loại vật nuôi',
                width: '100%',
                allowClear: true,
                language: {
                    noResults: function(term) {
                        return 'Không có kết quả';
                    }
                },
                ajax:{
                    url: "{!! route('app_sale.get_animals') !!}",
                    dataType: 'json'
                }
            });
            let timeout = null;
            $(`#keyword`).on('keyup', function () {
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
                        beforeSend: function () {
                            $('#sugget-result .table tbody').html(
                                '<tr><td>Mã SP</td><td>Tên SP</td></tr>');
                            $('#sugget-result').hide();
                            $('.image-loading').show();
                        },
                        success: function (data) {
                            $('#sugget-result .table tbody').append(data.html);
                            $('#sugget-result').show();
                            $('.image-loading').hide();
                        },
                        error: function () {
                            $('.image-loading').hide();
                        }
                    });
                }, 1000);
            });
            $('body').on('click', '#sugget-result tr', function () {
                let code = $(this).attr('data-code');
                let name = $(this).attr('data-name');
                let id = $(this).attr('data-product-variant');
                let html = `
                <tr>
                    <td>${code}</td>
                    <td>${name}</td>
                    <td class="text-center">
                        <input name="product_variant_id[]" value="${id}" type="hidden">
                    </td>
                </tr>
            `;
                $('.list-product-variant tbody').append(html);
                $('#sugget-result').hide();
            });
        </script>
    @endsection
@endsection
