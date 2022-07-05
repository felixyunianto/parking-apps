@extends('layouts.app')

@section('content')
<div class="container-home">
    <div class="card-home w-50 " style="padding : 20px">
        <canvas id="chart-monthly" width="300" ></canvas>

    </div>
    <div class="card-home w-50">
        <canvas id="chart-weekly" width="300" ></canvas>
    </div>
</div>
@endsection
@section('script')
<script>
    const ctxMonthly = document.getElementById('chart-monthly').getContext('2d');
    const ctxWeekly = document.getElementById('chart-weekly').getContext('2d');
    var months = [];
    $.ajax({
        method : 'GET',
        url : '/chart-monthly',
        success : (data) => {
            const myChart = new Chart(ctxMonthly, {
                type: 'line',
                data: {
                    labels: Object.keys(data.data),
                    datasets: [{
                        label: '# Parkir / bulan',
                        data: Object.values(data.data),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    })

    $.ajax({
        method : 'GET',
        url : '/chart-weekly',
        success : (data) => {
            const myChart = new Chart(ctxWeekly, {
                type: 'line',
                data: {
                    labels: Object.keys(data.data),
                    datasets: [{
                        label: '# Parkir / minggu',
                        data: Object.values(data.data),
                        backgroundColor: [
                            'rgba(0, 128, 255, 0.2)',
                        ],
                        borderColor: [
                            'rgba(0, 128, 255, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    })
    
    </script>
    
@endsection