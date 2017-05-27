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
    protected $fillable = [ 'name', 'user_id' ];

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
     * The owner of the pipeline
     * @return App\User
     */
    public function user()
    {
        return $this->belongsTo('App\User');
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
            // Begin transaction
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

        // Catch any exception
        } catch (Exception $e) {
            // Rollback any db changes
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
            // Init transaction
            DB::beginTransaction();

            // Validate start node
            if ($node->type == 'start') {
                throw new \Exception('The start node cannot be deleted');
            }

            // Delete all connection to the node
            Connection::where('to_node_id', $node->id)->delete();

            // Then delete the node
            $node->delete();

            DB::commit();

            // return a success value
            return [ 'success' => true ];

        // Catch any Exception
        } catch (Exception $e) {
            // Rollback any db changes
            DB::rollback();

            // return a failure message
            return [ 'success' => false ];
        }
    }

    /**
     * Creates the new pipeline with the data that is filled
     * in this object, and starts the first "start" node
     *
     * @return bool If the operation was successful
     */
    public function create()
    {
        try {
            // Init transaction
            DB::beginTransaction();

            $this->save();

            $start_node = new Node([
                'name' => str_random(10),
                'type' => 'start',
                'pipeline_id' => $this->id
            ]);

            $start_node->hierarchy_level = 1;
            $start_node->save();

            DB::commit();

            // return a success value
            return true;

        // Catch any Exception
        } catch (Exception $e) {
            // Rollback any db changes
            DB::rollback();

            // return a failure message
            return false;
        }
    }

    /**
     * All the messages related to this pipeline
     * @return Collection List of messages
     */
    public function messages()
    {
        return $this->hasMany('App\Message');
    }
}
