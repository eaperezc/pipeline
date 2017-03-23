<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pipeline;


class PipelineController extends Controller
{

    /**
     * Show all of the pipelines for the application.
     *
     * @return Render the pipeline list view
     */
    public function index()
    {
        $pipelines = Pipeline::paginate(25);
        return view('pipeline.index', ['pipelines' => $pipelines]);
    }

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

    /**
     * This will show the diagram for the pipeline
     *
     * @param  Pipeline $pipeline The pipeline we will show
     * @return Renders the pipeline diagram
     */
    public function diagram(Pipeline $pipeline)
    {
        return view('pipeline.diagram', [ 'pipeline' => $pipeline ]);
    }

}
