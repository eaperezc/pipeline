<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Node Model Class
 *
 * This model will be the one that we will use to manage a node
 * of the pipeline so most of the cases if not all of them,
 * the operations will be done by the Pipeline Model
 */
class Node extends Model
{
    protected $fillable = [ 'name', 'type', 'pipeline_id' ];

    /**
     * @return \App\Pipeline the pipeline of the node
     */
    public function pipeline()
    {
        return $this->belongsTo('App\Pipeline');
    }


    /**
     * Gets the nodes that will follow this node on
     * the specific pipeline.
     *
     * @return Collection  A collection of all child nodes
     */
    public function nextNodes()
    {
        return Node::join('connections', 'connections.to_node_id', '=', 'nodes.id')
                    ->where('connections.from_node_id', $this->id)
                    ->get(['nodes.*']);
    }
}
