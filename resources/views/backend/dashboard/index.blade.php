@extends('backend.layout.app')


@section('content')
    <div class="row clearfix g-4">
        <div class="col-3 p-2">
            <div class="card overflow-hidde d-flex align-items-center justify-content-center"
            style="background-image: linear-gradient(to top,#0ba3a3  0%,#0ba379 100%)!important">
                <div class="card-body">
                    <div class="text-center text-white" >
                        <h2><span class="count-number">{{$todayCountOrder}}</span> <span class="slight"> </span></h2>
                        <div class="lifeord">Today's Delivered Order</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 p-2">
            <div class="card overflow-hidde d-flex align-items-center justify-content-center"
            style="background-image: linear-gradient(to top,#0ba360 0%,#0ba360  100%)!important">
                <div class="card-body">
                    <div class="text-center text-white" >
                        <h2><span class="count-number">{{$todayOrder}}</span> <span class="slight">৳ </span></h2>
                        <div class="lifeord">Today's Sell </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 p-2">
            <div class="card overflow-hidde d-flex align-items-center justify-content-center"
            style="background: linear-gradient(to left,#ff784a,#ff926d)!important">
                <div class="card-body">
                    <div class="text-center text-white" >
                        <h2><span class="count-number">{{$todayPendingOrder}}</span> <span class="slight"> </span></h2>
                        <div class="lifeord">Today's Pending Order</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 p-2">
            <div class="card overflow-hidde d-flex align-items-center justify-content-center"
            style="background-image: linear-gradient(to top,#00c76f 0%,#46bf55 100%)!important">
                <div class="card-body">
                    <div class="text-center text-white" >
                        <h2><span class="count-number">{{$totalSell}}</span> <span class="slight">৳ </span></h2>
                        <div class="lifeord">Total Sell</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 p-2">
            <div class="card overflow-hidde d-flex align-items-center justify-content-center"
            style="background-image: linear-gradient(to left,#8845f5,#aa7af8)!important">
                <div class="card-body">
                    <div class="text-center text-white" >
                        <h2><span class="count-number">{{$totalVat}}</span> <span class="slight"> ৳</span></h2>
                        <div class="lifeord">Total Vat</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 p-2">
            <div class="card overflow-hidde d-flex align-items-center justify-content-center"
            style="background: linear-gradient(to left,#1f6bff,#528dff)!important">
                <div class="card-body">
                    <div class="text-center text-white" >
                        <h2><span class="count-number">0</span> <span class="slight">  ৳</span></h2>
                        <div class="lifeord">Today's Expense</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 p-2">
            <div class="card overflow-hidde d-flex align-items-center justify-content-center"
            style="background: linear-gradient(to top,#fc0,#ff3b30)!important">
                <div class="card-body">
                    <div class="text-center text-white" >
                        <h2><span class="count-number">0</span> <span class="slight"> ৳ </span></h2>
                        <div class="lifeord">Total Expense</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="col-3 p-2">
            @include('backend._partials.clockdate')
        </div> --}}
    </div>
    <br><hr>
    <div class="row clearfix">
        <div class="col-6">
            <div class="card">
                <div class="card-header text-center text-white"
                style="
                    background: #ff5925;
                    font-weight: bold;
                    font-size: 14px;
                "
                >Weekly Sell Report</div>
                <canvas id="weeklySell"></canvas>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header text-center text-white"
                style="
                    background: #8d4df6;
                    font-weight: bold;
                    font-size: 14px;
                "
                >Today's Sellman Wise Sell Report</div>
                <canvas id="userSell"></canvas>
            </div>
        </div>
        {{-- <div class="col-lg-6 col-md-6">
            @include('backend._partials.todo')
        </div> --}}
    </div>
    @php

    @endphp
@endsection

@push('js')
    {{-- <script src="{{ asset('assets/backend/clock/clock.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var userSellData =[];
        var userSellAmount =[];
        $(document).ready(function() {
            let weaklyData = jQuery.parseJSON('{!! json_encode($userSell) !!}');
            console.log(weaklyData);
            weaklyData.forEach(element => {
                userSellData.push(element.name);
                userSellAmount.push(Math.round(element.total_sell));
            });
            // console.log(userSellData,userSellAmount);

        const userSell = document.getElementById('userSell');
        new Chart(userSell, {
            type: 'bar',
            data: {
                labels: userSellData,
                datasets: [{
                    data: userSellAmount,
                    borderWidth: 2,
                    backgroundColor: 'orange',
                }]
            },
            options: {
                animations: {
                    tension: {
                        duration: 1000,
                        easing: 'linear',
                        from: 1,
                        to: 0,
                        loop: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        });
        const weeklySell = document.getElementById('weeklySell');
        new Chart(weeklySell, {
            type: 'line',
            data: {

                labels: jQuery.parseJSON('{!! json_encode($weaklyData['days']) !!}'),
                datasets: [{
                    label: '# of Votes',
                    data: jQuery.parseJSON('{!! json_encode($weaklyData['sell']) !!}'),
                    borderWidth: 2
                }]
            },
            options: {
                animations: {
                    tension: {
                        duration: 1000,
                        easing: 'linear',
                        from: 1,
                        to: 0,
                        loop: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

    </script>

@endpush
