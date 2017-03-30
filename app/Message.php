<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [ 'node_type', 'pipeline_id', 'lifespan' ];
}
