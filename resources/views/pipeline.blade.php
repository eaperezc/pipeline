<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>


        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/vis/4.18.1/vis.min.css">

        <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">

        <link rel="stylesheet" type="text/css" href="https://opensource.keycdn.com/fontawesome/4.7.0/font-awesome.min.css ">

        <style type="text/css">
            *:focus {
                outline:none !important;
            }
        </style>

        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>


    </head>
    <body>


        <nav class="navbar navbar-default navbar-fixed-top">

            <div class="navbar-header">
                <a class="navbar-brand" href="#">PipelineBulb</a>
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

                <input id="pipeline-name" type="text" value="{{ $pipeline->name }}"></input>

                <h2 style="margin-top: 100px">Nodes:</h2>

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

                        <div id="details-info" class="well">
                            <p>Please select a node to get more options and see all the details for it.</p>
                        </div>

                        <div id="details-form" class="form-horizontal hidden">

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

                            <button
                                class="btn btn-success"
                                data-toggle="modal"
                                data-target="#new-node-modal">
                                Add Child
                            </button>

                            <button type="submit" class="btn btn-primary">Edit</button>

                            <button
                                id="delete-node-button"
                                type="submit"
                                class="btn btn-danger">
                                Delete
                            </button>

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


        @include('nodes.modal.create')


        <!--
            This is the place where the magic happens, this app.js
            has all the javascript code that will take care of
            making this page as cool as it can be.
        -->
        <script src="{{ mix('js/app.js') }}"></script>


        <script type="text/javascript">
            var pipeline_id = '{{ $pipeline->id }}';


            $('.new-node-form').submit(function(e){
                e.preventDefault();
            });


            $('#submit-new-node').click(function(e){
                e.preventDefault();

                var form = $('.new-node-form');
                var form_data = form.serializeArray();
                var post_data = {};

                $.each(form_data, function() {
                    post_data[this.name] = this.value;
                });

                if (app.pipeline.selected_node_id !== null) {
                    post_data.from_node_id = app.pipeline.selected_node_id;

                    var button = $(this);
                    var auxText = button.html();

                    button
                        .addClass('disabled')
                        .html('<i class="fa fa-refresh fa-spin fa-fw"></i>' + auxText);

                    $.post({
                        url: form.attr('action'),
                        data: post_data
                    }).done(function(){
                        $('#new-node-modal').modal('hide');

                        button
                            .removeClass('disabled')
                            .html(auxText);

                        app.pipeline.loadData();

                        $('#details-info').removeClass('hidden');
                        $('#details-form').addClass('hidden');
                    });
                }
            });

            $('#delete-node-button').click(function(e){
                e.preventDefault();

                if (app.pipeline.selected_node !== null) {

                    var button = $(this);

                    swal({
                        title: "Are you sure?",
                        text: "You will not be able to undo this action!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: true
                    },
                    function(){

                        var auxText = button.html();
                        button
                            .addClass('disabled')
                            .html('<i class="fa fa-refresh fa-spin fa-fw"></i>' + auxText);

                        app.pipeline.selected_node.destroy(
                            function() {
                                $('#new-node-modal').modal('hide');

                                button
                                    .removeClass('disabled')
                                    .html(auxText);

                                app.pipeline.loadData();

                                $('#details-info').removeClass('hidden');
                                $('#details-form').addClass('hidden');


                                swal("Delete Successful", "The node was deleted!", "success");
                            },
                            function() {
                                swal("Oops...", "Something went wrong! Make sure you're not trying to delete a node that has child nodes or is the start node of the pipeline.", "error");

                                button
                                    .removeClass('disabled')
                                    .html(auxText);
                            }
                        );

                    });

                } else {
                    swal("There's no node selected", "Please select the node you want to remove from this pipeline.", "info");
                }

            });


        </script>


    </body>
</html>
