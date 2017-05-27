<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pipeline;
use App\Message;

class MessageController extends Controller
{

    /**
     * This action displays the list of messages sent to
     * this particular pipeline.
     *
     * @param  Pipeline     $pipeline   Pipeline object
     * @return Renders the pipeline messages list
     */
    public function index(Pipeline $pipeline)
    {
        return view('messages.index', [
            'pipeline' => $pipeline,
            'messages' => $pipeline->messages()->paginate(25)
        ]);
    }

}
