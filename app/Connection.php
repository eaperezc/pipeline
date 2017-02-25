<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    protected $fillable = [ 'from_node_id', 'to_node_id' ];
}
