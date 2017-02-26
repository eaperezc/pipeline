<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pipeline;


class PipelineController extends Controller
{

    public function structure($id)
    {
        $pipeline = Pipeline::findOrFail($id);
        $nodes = $pipeline->nodes;
        $connections = $pipeline->connections;

        return [
            'nodes'         => $nodes,
            'connections'   => $connections
        ];

    }


    public function nodes($id)
    {
        $pipeline = Pipeline::findOrFail($id);
        return (string) $pipeline->nodes;
    }


}
