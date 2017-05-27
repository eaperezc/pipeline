<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pipeline;
use App\Message;

class MessageController extends Controller
{
    public function index(Pipeline $pipeline)
    {
        return view('messages.index', [
            'pipeline' => $pipeline,
            'messages' => $pipeline->messages()->paginate(25)
        ]);
    }

    public function view(Pipeline $pipeline, Message $message)
    {
        # code...
    }
}
