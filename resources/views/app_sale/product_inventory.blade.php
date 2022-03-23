@extends('master')
@section('title', 'App Sale')
@section('content')
    <div class="page-container">
        <!--include ../includes/header.jade-->
        <div class="page-content-wrapper page-register">
            <div class="page-content">
                <div class="main-body-content member-page">
                    <div class="member-title-table">
                        <div class="title-page full border-bottom mrb-30">
                            <h3 class="bold text-center">Kiểm kê hàng hóa</h3>
                        </div>
                        <form method="post" action="{{ route('app_sale.updateProductInventory') }}">
                            @csrf
                            <div class="border-full content-detail pad-20-30 mrb-40">
                                <div class="full">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="input-search">
                                            <input name="search" id="keyword" type="search" placeholder="Search"/>
                                            <img src="https://stg.namthai.paditech.org/assets/img/loader.svg"
                                                 class="image-loading">
                                            <div id="sugget-result">
                                                <table class="table">
                                                    <tr>
                                                        <td>Mã sản phẩm</td>
                                                        <td>Tên sản phẩm</td>
                                                        <td>Số lô</td>
                                                        <td>Số lượng</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="full">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="content-table">
                                            <table class="table list-product-inventory">
                                                <thead>
                                                <tr>
                                                    <th>Mã SP</th>
                                                    <th>Tên SP</th>
                                                    <th>Số lô</th>
                                                    <th>Số lượng</th>
                                                    <th>Comment</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="distributor_from" id="idDistributor"/>
                                <div class="full text-center">
                                    <button type="submit" class="btn green pad-8-50">Cập nhật</button>
                                </div>
                            </div>
                        </form>
                        <!--.table-member-mng-->
                    </div>
                    <!-- .block-1-->
                </div>
                <!-- .member-main-->
            </div>
            <!-- .page-content-->
        </div>
        <!-- .member-->
    </div>
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
            top: 0;
            display: none;
        }

    </style>

@section('script')
    <script>
        let timeout = null;
        let dataCheckIn = localStorage.getItem('dataCheckIn');
        let idDistributor = JSON.parse(dataCheckIn).id_farm_or_distributor;
        $('#idDistributor').val(idDistributor);
        $(`#keyword`).on('keyup', function () {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                let keyword = $(this).val();

                $.ajax({
                    url: "{!! route('app_sale.search_product_inventory') !!}",
                    method: 'get',
                    dataType: 'json',
                    data: {
                        'keyword': keyword,
                        'distributor_id': idDistributor,
                        'except': JSON.parse(localStorage.getItem('arrDistributor'))
                    },
                    beforeSend: function () {
                        $('#sugget-result .table tbody').html(
                            '<tr><td>Mã SP</td><td>Tên SP</td><td>Số lô</td><td>Số lượng</td></tr>');
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
        localStorage.removeItem('arrDistributor');
        $('body').on('click', '#sugget-result tr', function () {
            let dataDistributor = [];
            if (localStorage.getItem('arrDistributor') && JSON.parse(localStorage.getItem('arrDistributor'))) {
                dataDistributor = JSON.parse(localStorage.getItem('arrDistributor'));
            }
            let codeProduct = $(this).attr('data-code-product');
            let name = $(this).attr('data-name');
            let code = $(this).attr('data-code');
            let quantity = $(this).attr('data-total-quantity');
            let distributorId = $(this).attr('data-distributor');
            if (distributorId) {
                dataDistributor.push(parseInt(distributorId));

                localStorage.setItem('arrDistributor', JSON.stringify(dataDistributor));
            }
            let html = `
                <tr>
                    <td>${codeProduct}</td>
                    <td>${name}</td>
                    <td>${code}</td>
                    <td class="text-center">
                        <input name="quantity[${distributorId}]" type="text" value="${quantity}" placeholder="1000" style="width: 80px;">
                    </td>
                    <td>
                        <input name="reason[${distributorId}]" type="text" placeholder="Nhập lý do" style="width: 120px;">
                    </td>
                </tr>
            `;
            $('.list-product-inventory tbody').append(html);
            $('#sugget-result').hide();
        });
    </script>
@endsection
@endsection
