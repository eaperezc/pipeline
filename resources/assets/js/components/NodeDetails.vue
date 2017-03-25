<template>

    <div class="form-horizontal hidden">

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

        <button
            class="btn btn-success"
            data-toggle="modal"
            data-target="#new-node-modal">
            Add Child
        </button>

        <button type="submit" class="btn btn-primary">Edit</button>

        <button
            type="submit"
            class="btn btn-danger">
            Delete
        </button>

    </div>

</template>

<script>
    export default {
        props: ['node']
    }
</script>
