@extends('layouts.app')

@section('content')
<div class="container-home">
    <div class="card-home w-60">
    <canvas id="myChart" width="400" ></canvas>

    </div>
    <div class="card-home w-40">
        
    </div>
</div>
@endsection
@section('script')
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    var months = [];
    $.ajax({
        method : 'GET',
        url : '/chart',
        success : (data) => {
            const myChart = new Chart(ctx, {
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
    
    </script>
    
@endsection