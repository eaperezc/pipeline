<div id="new-node-modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">


      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add new node</h4>
      </div>


      <div class="modal-body">

        <form class="new-node-form form-horizontal" action="/nodes/store" method="POST">

            {{ csrf_field() }}

            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" placeholder="New node name">
                </div>
            </div>
            <input type="hidden" name="type" value="empty" />
            <input type="hidden" name="pipeline_id" value="{{ $pipeline->id }}" />
            <input type="hidden" name="from_node_id" value="">

        </form>

      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="submit-new-node" type="button" class="btn btn-primary">Save changes</button>
      </div>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
