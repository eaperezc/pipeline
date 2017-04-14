<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageStep extends Model
{
    protected $fillable = [
        'message_id',
        'node_id',
        'pipeline_id',
        'message_id',
        'status',
        'previous_step_id'
    ];


    public function queueNextSteps()
    {
        $node = Node::findOrFail($this->node_id);

        $nodes = $node->nextNodes();

        foreach ($nodes as $next_node) {

            $step = new self([
                'message_id'        => $this->message_id,
                'pipeline_id'       => $this->pipeline_id,
                'node_id'           => $next_node->id,
                'status'            => 'QUEUED',
                'previous_step_id'  => $this->id
            ]);
            $step->save();

        }

    }

}
