@extends('layouts.app')

@section('content')

<div id="pipeline-diagram-app" class="wrapper">

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
                        <i class="fa fa-cog"></i>
                    </label>
                    <label class="btn btn-default">
                        <i class="fa fa-power-off"></i> Turn Off
                    </label>
                </div>


            </div>
        </div>


        <node-details :node="node"></node-details>

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
        }
    });


    // for the new node selector
    $('.selector-item').click(function(e) {
        $(this).addClass('selected').siblings().removeClass('selected');
    });

    $('.dropdown-toggle').dropdown();

</script>

<script src="{{ mix('js/diagram.js') }}"></script>

@endsection
