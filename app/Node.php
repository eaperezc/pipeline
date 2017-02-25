<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    protected $fillable = [ 'name', 'type', 'pipeline_id' ];


    public function pipeline()
    {
        return $this->belongsTo('App\Pipeline');
    }


}
