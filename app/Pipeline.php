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
}
