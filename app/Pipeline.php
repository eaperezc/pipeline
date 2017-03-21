<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Node;
use App\Connection;

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



    public function addNode(Node $node, Node $parent)
    {
        try {

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



    public function removeNode(Node $node)
    {
        try {

            DB::beginTransaction();

            // Delete all connection to the node
            Connection::where('to_node_id', $node->id)->delete();

            // Then delete the node
            $node->delete();

            DB::commit();

            // return a success value
            return [ 'success' => true ];


        } catch (Exception $e) {

            DB::rollback();

            // return a failure message
            return [ 'success' => false ];
        }
    }


}
