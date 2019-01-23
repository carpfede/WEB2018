@extends('layouts.app')

@section('content')
<div class="container">
    <canvas id="myChart"></canvas>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

<script>
    var ctx = document.getElementById("myChart").getContext('2d');

    var labels = new Array();
    var tasks = new Array();

    console.log({{cache()->get('projects')}});
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Tareas por projecto',
                data: tasks,
                borderWidth: 1
            }]
            },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>
@endsection
