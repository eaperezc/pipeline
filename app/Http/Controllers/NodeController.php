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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @version -1 deprecated and only for testing
     */
    public function create($ancestor_node_id)
    {
        $from_node = Node::findOrFail($ancestor_node_id);
        return view('nodes.create', [ 'from_node' => $from_node ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $node = DB::transaction(function () use ($request) {

            $parent = Node::findOrFail($request->input('from_node_id'));

            $node = new Node($request->all());
            $node->hierarchy_level = $parent->hierarchy_level + 1;

            $node->save();

            $connection = new Connection([
                'from_node_id' => $parent->id,
                'to_node_id' => $node->id,
                'pipeline_id' => $node->pipeline_id
            ]);

            $connection->save();

            return $node;

        });

        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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
