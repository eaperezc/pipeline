<h1>New node</h1>

<form action="/nodes/store" method="POST">

    {{ csrf_field() }}

    <input type="test" name="name" />
    <input type="hidden" name="type" value="empty" />
    <input type="hidden" name="pipeline_id" value="{{ $from_node->pipeline->id }}" />
    <input type="hidden" name="from_node_id" value="{{ $from_node->id }}">

    <input type="submit" value="Save">

</form>
