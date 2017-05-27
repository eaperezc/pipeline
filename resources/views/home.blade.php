@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="title">Welcome to your Dashboard</h2>
    <hr>

    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Messages</div>
                <div class="panel-body text-center">
                    <span style="font-size: 25px">32423.324</span>
                 </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Overhead</div>
                <div class="panel-body text-center">
                    <span style="font-size: 25px">High</span>
                 </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Pipelines</div>
                <div class="panel-body text-center">
                    <span style="font-size: 25px">35</span>
                 </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body" style="height: 400px">
            <canvas id="dashboard"></canvas>
        </div>
    </div>
</div>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>

<script type="text/javascript">

    var ctx = document.getElementById('dashboard').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                label: "Activity",
                //backgroundColor: 'rgb(255, 99, 132)',
                borderColor: '#F39C12',
                data: [0, 10, 30, 12, 20, 30, 40],
            }]
        },

        // Configuration options go here
        options: { maintainAspectRatio: false }
    });

</script>

@endsection
