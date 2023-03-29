@extends('backend.layout.app')
@push('css')
    <style>
        /** The Magic **/
        .btn-breadcrumb .btn:not(:last-child):after {
            content: " ";
            display: block;
            width: 0;
            height: 0;
            border-top: 17px solid transparent;
            border-bottom: 17px solid transparent;
            border-left: 10px solid white;
            position: absolute;
            top: 50%;
            margin-top: -17px;
            left: 100%;
            z-index: 3;
        }

        .btn-breadcrumb .btn:not(:last-child):before {
            content: " ";
            display: block;
            width: 0;
            height: 0;
            border-top: 17px solid transparent;
            border-bottom: 17px solid transparent;
            border-left: 10px solid rgb(173, 173, 173);
            position: absolute;
            top: 50%;
            margin-top: -17px;
            margin-left: 1px;
            left: 100%;
            z-index: 3;
        }

        /** The Spacing **/
        .btn-breadcrumb .btn {
            padding: 6px 12px 6px 24px;
        }

        .btn-breadcrumb .btn:first-child {
            padding: 6px 6px 6px 10px;
        }

        .btn-breadcrumb .btn:last-child {
            padding: 6px 18px 6px 24px;
        }



        /** Primary button **/
        .btn-breadcrumb .btn.btn-primary:not(:last-child):after {
            border-left: 10px solid #007bff;
        }

        .btn-breadcrumb .btn.btn-primary:not(:last-child):before {
            border-left: 10px solid #357ebd;
        }

        .btn-breadcrumb .btn.btn-primary:hover:not(:last-child):after {
            border-left: 10px solid #0069d9;
        }

        .btn-breadcrumb .btn.btn-primary:hover:not(:last-child):before {
            border-left: 10px solid #007bff;
        }
    </style>
@endpush


@section('content')
    <div class="row clearfix">
        <div class="col-lg-3 col-md-6">
            <div class="card top_counter">
                <div class="body">
                    <div class="icon text-info"><i class="fa fa-user"></i> </div>
                    <div class="content">
                        <div class="text">Today's Patients</div>
                        <h5 class="number">14</h5>
                    </div>
                    <hr>
                    <div class="icon text-warning"><i class="fa fa-users"></i> </div>
                    <div class="content">
                        <div class="text">Total Patients</div>
                        <h5 class="number">640</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card top_counter">
                <div class="body">
                    <div class="icon text-warning"><i class="fa fa-tags"></i> </div>
                    <div class="content">
                        <div class="text">Today's Income</div>
                        <h5 class="number">৳ 42,500</h5>
                    </div>
                    <hr>
                    <div class="icon"><i class="fa fa-university"></i> </div>
                    <div class="content">
                        <div class="text">This Month Total Income</div>
                        <h5 class="number">৳ 5,564,558</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card top_counter">
                <div class="body">
                    <div class="icon text-danger"><i class="fa fa-credit-card"></i> </div>
                    <div class="content">
                        <div class="text">Today's Expense</div>
                        <h5 class="number">৳ 30,205</h5>
                    </div>
                    <hr>
                    <div class="icon text-danger">
                        <i class="fa fa-money"></i>
                    </div>
                    <div class="content">
                        <div class="text">Total Expense This Month</div>
                        <h5 class="number">৳ 1,350,325</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card top_counter">
                <div class="body">
                    <div class="icon"><i class="fa fa-map-pin"></i> </div>
                    <div class="content">
                        <div class="text">Total Dialysis Patient's</div>
                        <h5 class="number">369</h5>
                    </div>
                    <hr>
                    <div class="icon text-success"><i class="fa fa-smile-o"></i> </div>
                    <div class="content">
                        <div class="text">Happy Clients</div>
                        <h5 class="number">528</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row clearfix my-4">
        <div class="col-6">
            <div class="card">
                <div class="card-header text-center text-white"
                    style="
                    background: #ff5925;
                    font-weight: bold;
                    font-size: 14px;
                ">
                    Weekly Appointment Report</div>
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
                ">
                    Weekly Dailyses Report</div>
                <canvas id="userSell"></canvas>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header text-center text-white"
                    style="
                    background: #8d4df6;
                    font-weight: bold;
                    font-size: 14px;
                ">
                    Monthly Sell Report</div>
                <canvas id="monthlySell"></canvas>
            </div>
        </div>

    </div> --}}
    {{-- <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="header">
                    <h2>University Survey</h2>
                    <ul class="header-dropdown">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false"></a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another Action</a></li>
                                <li><a href="javascript:void(0);">Something else</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="row text-center">
                        <div class="col-sm-3 col-6">
                            <h4 class="margin-0">$231</h4>
                            <p class="text-muted margin-0"> Today's</p>
                        </div>
                        <div class="col-sm-3 col-6">
                            <h4 class="margin-0">$1,254</h4>
                            <p class="text-muted margin-0">This Week's</p>
                        </div>
                        <div class="col-sm-3 col-6">
                            <h4 class="margin-0">$3,298</h4>
                            <p class="text-muted margin-0">This Month's</p>
                        </div>
                        <div class="col-sm-3 col-6">
                            <h4 class="margin-0">$9,208</h4>
                            <p class="text-muted margin-0">This Year's</p>
                        </div>
                    </div>
                    <div id="m_bar_chart" class="graph m-t-20"></div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div class="row clearfix">
        <div class="col-12">
            <div class="card">
                <div class="body">
                    <h4>Quick Link</h4>
                    <div class="btn-group btn-breadcrumb ml-0">
                        <a href="/" class="btn btn-primary ml-0"><i class="fa fa-home"></i></a>
                        <a href="appointment" class="btn btn-primary ml-0">Doctor Appointment</a>
                        <a href="dialysis-appointment" class="btn btn-primary ml-0">Dialyses Appointment</a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@push('js')
    {{-- <script src="{{ asset('assets/backend/clock/clock.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var userSellData = [];
        var userSellAmount = [];
        var monthlySellData = [];
        var monthlySellAmount = [];
        $(document).ready(function() {
            // weaklyData
            let weaklyData = jQuery.parseJSON('{!! json_encode($userSell) !!}');
            weaklyData.forEach(element => {
                userSellData.push(element.name);
                userSellAmount.push(Math.round(element.total_sell));
            });

            // monthlyData
            let monthlyData = jQuery.parseJSON('{!! json_encode($monthData) !!}');
            $.each(monthlyData, function(key, value) {
                monthlySellData.push(key);
                monthlySellAmount.push(Math.round(value));

            });

            // userSell
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

            // monthlySell
            const monthlySell = document.getElementById('monthlySell');
            new Chart(monthlySell, {
                type: 'bar',
                data: {
                    labels: monthlySellData,
                    datasets: [{
                        data: monthlySellAmount,
                        borderWidth: 2,
                        backgroundColor: 'green',
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
            //weeklysell
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

        });
    </script>
@endpush
