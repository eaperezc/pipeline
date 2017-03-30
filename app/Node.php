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
}
