@extends('master')
@section('title', 'App Sale')
@section('content')
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
                                            <div class="code">{{ $workingPlan['addressable']['type'] == 'farm'? "Số điện thoại: " : "Mã đại lý: " }}
                                                @if($workingPlan['addressable']['type'] == 'farm')
                                                    {{ $workingPlan['addressable']['data']['phone_number'] }}
                                                @else
                                                    {{ $workingPlan['addressable']['data']['code'] }}
                                                @endif
                                            </div>
                                            <div class="address">{{ $workingPlan['addressable']['data']['addr_detail'] }}</div>
                                            <input type="hidden" name="id" class="id_address" value="{{ $workingPlan['id'] }}">
                                            <input type="hidden" name="type" class="type" value="{{ $workingPlan['addressable']['type'] }}">
                                            <input type="hidden" name="phone_number" class="phone_number" value="{{ $workingPlan['addressable']['data']['phone_number'] }}">
                                            <input type="hidden" name="id_farm_or_distributor" class="id_farm_or_distributor" value="{{ $workingPlan['addressable']['data']['id'] }}">
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

@section('script')
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
            'id_farm_or_distributor' : $(e).find('.id_farm_or_distributor').val(),
            'image' : $(e).find('.image').attr('src'),
        };
        localStorage.setItem('dataCheckIn', JSON.stringify(array));
        if (localStorage.getItem('dataCheckIn')) {
            window.location.href = '{{ route('app_sale.check_in') }}'
        }
    }
</script>
@endsection
@endsection
