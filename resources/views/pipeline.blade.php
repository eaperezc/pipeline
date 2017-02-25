<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>


        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/vis/4.18.1/vis.min.css">

    </head>
    <body>

    <h1>{{ $pipeline->name }}</h1>


    <h2>Nodes:</h2>

        @forelse ($pipeline->nodes as $node)
            <li>{{ $node->name }} <a href="/nodes/create/{{ $node->id }}">Add node</a></li>
        @empty
            <p>No nodes</p>
        @endforelse


    <div id="mynetwork" style="height: 400px"></div>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vis/4.18.1/vis.min.js"></script>


<script type="text/javascript">
    // create an array with nodes
    var nodes = new vis.DataSet([
        {id: 1, label: 'Start', level: 1, image: '/images/sign-check.png' },
        {id: 2, label: 'Prepare Data', level: 2 },
        {id: 3, label: 'Cleanup', level: 2, image: '/images/sign-check.png' },
        {id: 4, label: 'Node With Error', level: 3,  image: '/images/sign-error.png'},
        {id: 5, label: 'Log Error Information', level: 3 }
    ]);

    // create an array with edges
    var edges = new vis.DataSet([
        {from: 1, to: 3 },
        {from: 1, to: 2 },
        {from: 2, to: 4 },
        {from: 2, to: 5 },
        {from: 3, to: 4 }
    ]);

    // create a network
    var container = document.getElementById('mynetwork');

    // provide the data in the vis format
    var data = {
        nodes: nodes,
        edges: edges
    };
    var options = {
        'nodes': {
            shape: 'image',
            image: '/images/terminal.png'
        },
        "edges": {
            arrows: 'to',
            color: '#aaa',
            "smooth": {
                "type": "continuous",
                "forceDirection": "none"
            }
        },
        "physics": {
            "enabled": false
        },
        layout: {
            hierarchical: {
                direction: 'LR'
            }
        }
    };

    // initialize your network!
    var network = new vis.Network(container, data, options);
</script>



    </body>
</html>
