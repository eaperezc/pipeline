<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>


        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/vis/4.18.1/vis.min.css">

        <style type="text/css">
            *:focus {
                outline:none !important;
            }
        </style>

        <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">


    </head>
    <body>


        <nav class="navbar navbar-default navbar-fixed-top">

            <div class="navbar-header">
                <a class="navbar-brand" href="#">Brand</a>
            </div>


            <div class="container-fluid">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Pipeline <span class="sr-only">(current)</span></a></li>
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                    </li>
                </ul>
            </div>
        </nav>

<div class="wrapper">

    <div class="col-xs-2" style="margin-top: 60px">

        <h1>{{ $pipeline->name }}</h1>


        <h2>Nodes:</h2>

        <ul class="list-group">

            @forelse ($pipeline->nodes as $node)
                <li class="list-group-item">{{ $node->name }} <a href="/nodes/create/{{ $node->id }}">Add node</a></li>
            @empty
                <p>No nodes</p>
            @endforelse

        </ul>

    </div>



    <div id="network-wrapper" class="col-xs-7">

        <div id="mynetwork" style="height: 100vh"></div>

    </div>

    <div id="node-detail-panel" class="col-xs-3" style="margin-top: 80px">
        <div class="panel panel-default">
            <div class="panel-body">

                <h3>Details</h3>

                <div class="well">
                    <p>Please select a node to show all available options.</p>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">

                <h3>Help</h3>

                <div class="well">
                    <p>If you have any questions please read the documentation. Although there's no documentation because this is not a real app yet, so... sorry.</p>
                </div>
            </div>
        </div>

    </div>

</div>



<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vis/4.18.1/vis.min.js"></script>


<script type="text/javascript">


$( document ).ready(function() {

    // create a network
    var container = document.getElementById('mynetwork');

    // create an array with nodes
    /*var nodes = new vis.DataSet([
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
    ]);*/


    // provide the data in the vis format
    /*var data = {
        nodes: nodes,
        edges: edges
    };*/

    var options = {
        nodes: {
            shape: 'image',
            image: '/images/terminal.png'
        },
        edges: {
            arrows: 'to',
            color: '#aaa',
            smooth: {
                type: 'continuous',
                forceDirection: 'none'
            }
        },
        physics: {
            enabled: false
        },
        layout: {
            hierarchical: {
                direction: 'LR'
            }
        }
    };

    $.ajax({
        url: '/pipeline/{{ $pipeline->id }}'
    }).done(function(resp) {

        var auxNodes = [];
        for (i = 0; i < resp.nodes.length; i++) {
            auxNodes.push({
                id: resp.nodes[i].id,
                label: resp.nodes[i].name,
                level: resp.nodes[i].hierarchy_level
            });
        }

        var auxConnections = [];
        for (i = 0; i < resp.connections.length; i++) {
            auxConnections.push({
                from: resp.connections[i].from_node_id,
                to: resp.connections[i].to_node_id
            });
        }


        var nodes = new vis.DataSet(auxNodes);
        var edges = new vis.DataSet(auxConnections);

        var data = {
            nodes: nodes,
            edges: edges
        };

        // initialize your network!
        var network = new vis.Network(container, data, options);

        network.on('oncontext', function(e) {
            e.event.preventDefault();
            node = network.getNodeAt(e.pointer.DOM);

            if (node) {
                network.selectNodes([ node ]);

                window.location = "/nodes/create/" + node;
            }

        });


    });



});

</script>


<script src="{{ mix('js/app.js') }}"></script>

    </body>
</html>
