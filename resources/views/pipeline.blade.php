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

            <div class="col-xs-3" style="margin-top: 80px">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <h3>Details</h3>

                        <form class="form-horizontal">

                            <div class="form-group">

                                <label class="col-xs-2 control-label">Name</label>
                                <div class="col-xs-10">
                                    <p id="node-name" class="form-control-static">The Node</p>
                                </div>

                                <label class="col-xs-2 control-label">Type</label>
                                <div class="col-xs-10">
                                    <p id="node-type" class="form-control-static">Script</p>
                                </div>

                            </div>


                            <button type="submit" class="btn btn-success">Add Child</button>
                            <button type="submit" class="btn btn-primary">Edit</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
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



        <script type="text/javascript">
            var pipeline_id = '{{ $pipeline->id }}';
        </script>


        <script src="{{ mix('js/app.js') }}"></script>

    </body>
</html>
