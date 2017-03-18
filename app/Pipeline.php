<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pipeline extends Model
{
    /**
     * The nodes that the pipeline has.
     */
    public function nodes()
    {
        return $this->hasMany('App\Node');
    }

    public function connections()
    {
        return $this->hasMany('App\Connection');
    }


    public function addNode(Node $node, Node $parent_node)
    {
        try {

            // Im not using this yet, I just have it here for now
            // So I can review later if this transaction makes sense
            DB::beginTransaction();

            $node->hierarchy_level = $parent->hierarchy_level + 1;

            $node->save();

            $connection = new Connection([
                'from_node_id'  => $parent->id,
                'to_node_id'    => $node->id,
                'pipeline_id'   => $this->id
            ]);

            $connection->save();


            DB::commit();


            return $node;


        } catch (Exception $e) {

            DB::rollback();

        }

    }


}
