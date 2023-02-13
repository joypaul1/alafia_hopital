@extends('backend.layout.app')


@section('content')


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
