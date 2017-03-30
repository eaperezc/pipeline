<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Pipeline;
use App\Node;
use App\Connection;

class NodeController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Pipeline     $pipeline   Pipeline object
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pipeline $pipeline)
    {
        $parent = Node::findOrFail($request->input('from_node_id'));
        $node = new Node($request->all());

        return $pipeline->addNode($node, $parent);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request  The request object
     * @param  \App\Node                $node     The node to update
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Node $node)
    {
        $node->fill($request->all);
        $node->save();
        return $node;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Pipeline     $pipeline   Pipeline object
     * @param  Node         $pipeline   Selected Node object
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pipeline $pipeline, Node $node)
    {
        return $pipeline->removeNode($node);
    }
}
