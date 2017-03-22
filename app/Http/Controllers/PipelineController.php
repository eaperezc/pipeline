<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pipeline;


class PipelineController extends Controller
{

    /**
     * This route will return the pipeline structure so
     * we can display the visualization on the view.
     *
     * @param  Pipeline $pipeline The pipeline object
     * @return array With the nodes and connections
     */
    public function structure(Pipeline $pipeline)
    {
        return [
            'nodes'         => $pipeline->nodes,
            'connections'   => $pipeline->connections
        ];
    }

}
