@extends('layouts.app')

@section('content')

<div class="wrapper">

    <div id="network-wrapper" class="col-xs-9">

        <input id="pipeline-name" type="text" value="{{ $pipeline->name }}"></input>
        <div id="pipeline-diagram" style="height: 85vh"></div>

    </div>

    <div class="col-xs-3">

        <div class="panel" style="background-color:transparent; box-shadow: none">
            <div class="panel-body" style="padding:0;">

                <div class="btn-group pull-right" data-toggle="buttons">
                    <label class="btn btn-default disabled">
                        Status:
                        @if ($pipeline->status)
                        <i style="color:green" class="fa fa-circle" aria-hidden="true"></i>
                        @else
                        <i style="color:red" class="fa fa-circle" aria-hidden="true"></i>
                        @endif
                    </label>
                    <label class="btn btn-default">
                        <i class="fa fa-heart"></i>
                    </label>
                    <label class="btn btn-default">
                        <i class="fa fa-cog"></i> Settings
                    </label>
                    <label class="btn btn-default">
                        <i class="fa fa-power-off"></i> Turn Off
                    </label>
                </div>


            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">

                <h3>Node Details</h3>

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

@endsection



@section('scripts')

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

        if (app.pipeline.selected_node !== null) {

            var button = $(this);
            var auxText = button.html();


            var nodeType = $('.selector-item.selected p').text();
            if (nodeType == "") {
                return;
            }

            button
                .addClass('disabled')
                .html('<i class="fa fa-refresh fa-spin fa-fw"></i>' + auxText);

            app.pipeline.addNode({
                name: post_data['name'],
                type: nodeType
            });

            $('.selector-item.selected').removeClass('selected')
                            .siblings().removeClass('selected');

            $('#new-node-modal').modal('hide');

            button
                .removeClass('disabled')
                .html(auxText);

            $('#details-info').removeClass('hidden');
            $('#details-form').addClass('hidden');
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

    // for the new node selector
    $('.selector-item').click(function(e) {
        $(this).addClass('selected').siblings().removeClass('selected');
    });

    $('.dropdown-toggle').dropdown();

</script>

@endsection
