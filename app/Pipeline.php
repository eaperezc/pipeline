<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Node;
use App\Connection;

/**
 * Pipeline Model Class
 *
 * This class will be the one responsible for all the Pipeline
 * manipulation, so creating nodes, connections, and any type
 * of management that is required by the user on the pipeline
 */
class Pipeline extends Model
{
    /**
     * The nodes that the pipeline has.
     */
    public function nodes()
    {
        return $this->hasMany('App\Node');
    }

    /**
     * The connections that the pipeline has.
     */
    public function connections()
    {
        return $this->hasMany('App\Connection');
    }


    /**
     * Adds a new node to the pipeline. The parent node will
     * be the node where the new node will be connected
     * from so this will also create the Connection.
     *
     * @param Node $node    The New node to create
     * @param Node $parent  The ancestor node
     */
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


    /**
     * Method that will remove the node and all it's connections
     * from the pipeline. Only nodes that don't have any mode
     * connections out (meaning no child nodes) won't have
     * any problem being deleted but any other will.
     *
     * @param  Node $node   The node to be deleted
     * @return array        Success of failure boolean
     */
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
