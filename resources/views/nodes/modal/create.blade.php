<div id="new-node-modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">


      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add new node</h4>
      </div>


      <div class="modal-body">

        <form class="new-node-form form-horizontal" method="POST">

            {{ csrf_field() }}

                <div class="selector">
                @foreach ($node_types as $node_type)
                    <div class="selector-item">
                        <img src="{{ $node_type['icon'] }}">
                        <p>{{ $node_type['name'] }}</p>
                    </div>
                @endforeach
                </div>


            <div class="form-group">
                <div class="col-sm-12">
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
        <button id="submit-new-node" type="button" class="btn btn-primary">Add Node</button>
      </div>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

