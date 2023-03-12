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
    </div>
@endsection

@push('js')
    {{-- <script src="{{ asset('assets/backend/clock/clock.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var userSellData = [];
        var userSellAmount = [];
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
