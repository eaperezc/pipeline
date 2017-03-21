<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pipeline;


class PipelineController extends Controller
{

    public function structure(Pipeline $pipeline)
    {
        return [
            'nodes'         => $pipeline->nodes,
            'connections'   => $pipeline->connections
        ];
    }


    public function nodes($id)
    {
        $pipeline = Pipeline::findOrFail($id);
        return (string) $pipeline->nodes;
    }

}
