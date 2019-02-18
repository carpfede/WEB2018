@extends('layouts.app')

@section('content')
<div class="container">
    <canvas id="myChart"></canvas>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

<script>
    this.getData();
    function getData(){
        axios.get('/getDataChart')
            .then(response => {
                _createChart(response.data.projects,response.data.subtasks);
            })
            .catch(function () {
            });
    };
    
    function _createChart(projects, tasksArray) {
        var ctx = document.getElementById("myChart");

        console.log(projects,tasksArray);
        let tasks = [];
        let labels = ['Hacer','En Progreso','Resuelta','Testing','Cancelada'];
        
        console.log('tt');
        labels.forEach(i => {
            const length = tasksArray.filter(o => {return o.status === i.replace(/\s/g, ''); }).length;
            console.log(length);
            
            tasks.push(length);
        });

        console.log(tasks);
        

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Tareas por projecto',
                    data: tasks,
                    backgroundColor: [
                        'rgb(174, 171, 255)',
                        'rgb(36, 171, 255)',
                        'rgb(68, 182, 0)',
                        'rgb(117, 211, 255)',
                        'rgb(230, 35, 22)'
                    ],
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
    }

// var myChart2 = new Chart(ctx, {
//     type: 'bar',
//     data: {
//         labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
//         datasets: [{
//             label: '# of Votes',
//             data: [12, 19, 3, 5, 2, 3],
//             backgroundColor: [
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(255, 206, 86, 0.2)',
//                 'rgba(75, 192, 192, 0.2)',
//                 'rgba(153, 102, 255, 0.2)',
//                 'rgba(255, 159, 64, 0.2)'
//             ],
//             borderColor: [
//                 'rgba(255,99,132,1)',
//                 'rgba(54, 162, 235, 1)',
//                 'rgba(255, 206, 86, 1)',
//                 'rgba(75, 192, 192, 1)',
//                 'rgba(153, 102, 255, 1)',
//                 'rgba(255, 159, 64, 1)'
//             ],
//             borderWidth: 1
//         }]
//     },
//     options: {
//         scales: {
//             yAxes: [{
//                 ticks: {
//                     beginAtZero:true
//                 }
//             }]
//         }
//     }
// });
</script>
@endsection
