<template>
    <div class="panel panel-default">
        <div class="panel-body">

                <h3>Node Details</h3>
                <div class="form-horizontal" v-if="node">

                    <div style="text-align:center">
                        <img :src="node.icon" style="margin-bottom: 15px">
                    </div>

                    <div class="form-group">

                        <label class="col-xs-2 control-label">Name</label>
                        <div class="col-xs-10">
                            <p class="form-control-static">{{ node.name }}</p>
                        </div>

                        <label class="col-xs-2 control-label">Type</label>
                        <div class="col-xs-10">
                            <p id="node-type" class="form-control-static">{{ node.type }}</p>
                        </div>

                    </div>

                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-success"
                                data-toggle="modal"
                                data-target="#new-node-modal">
                            <i class="fa fa-plus"></i> Add Child
                        </label>
                        <label class="btn btn-primary">
                            <i class="fa fa-pencil"></i> Setup
                        </label>
                        <label class="btn btn-danger"
                                @click="this.deleteNode">
                            <i class="fa fa-trash"></i> Delete
                        </label>
                    </div>

                </div>

                <div id="details-info" class="well" v-else>
                    <p>Please select a node to get more options and see all the details for it.</p>
                </div>
            </div>
        </div>

</template>

<script>
    export default {
        props: ['node'],
        methods: {
            deleteNode() {

                if (app.pipeline.selected_node !== null) {

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

                        app.pipeline.selected_node.destroy(
                            function() {
                                app.pipeline.loadData();
                                diagram.node = null;
                                swal("Delete Successful", "The node was deleted!", "success");
                            },
                            function() {
                                swal("Oops...", "Something went wrong! Make sure you're not trying to delete a node that has child nodes or is the start node of the pipeline.", "error");
                            }
                        );
                    });

                } else {
                    swal("There's no node selected", "Please select the node you want to remove from this pipeline.", "info");
                }
            }
        }
    }
</script>
