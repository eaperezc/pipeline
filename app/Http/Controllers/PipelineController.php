<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Pipeline;
use App\Enum\NodeTypes;

class PipelineController extends Controller
{

    /**
     * Show all of the pipelines for the application.
     *
     * @return Render the pipeline list view
     */
    public function index()
    {
        $pipelines = Pipeline::where('user_id', Auth::id())->paginate(25);
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
        $node_types = NodeTypes::all();
        return view('pipeline.diagram', [
            'pipeline' => $pipeline,
            'node_types' => $node_types
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Pipeline     $pipeline   Pipeline object
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pipeline = new Pipeline([
            'name' => str_random(10),
            'user_id' => Auth::id()
        ]);

        $pipeline->create();

        return redirect('/pipeline/' . $pipeline->id);
    }

    /**
     * Changes the name of the pipeline. This is a request
     * that is called when the user is changing the name on the
     * diagram page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Pipeline     $pipeline   Pipeline object
     * @return \Illuminate\Http\Response
     */
    public function changeName(Request $request, Pipeline $pipeline)
    {
        $this->validate($request, [
            'name' => 'required|max:100'
        ]);

        // Save the new name
        $pipeline->name = $request->input('name');
        $pipeline->save();
        return [ 'success' => true ];
    }
}
