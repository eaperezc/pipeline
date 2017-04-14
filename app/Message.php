<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Message extends Model
{
    protected $fillable = [ 'lifespan' ];

    /**
     * This will start the pipeline flow for this message.
     * Initialy the idea is that the "start" node is included
     * so the processors and runners take care of doind the
     * rest of the flow.
     *
     * @param  int      $pipeline_id    The Pipeline id
     * @return void
     */
    public function runPipeline($pipeline_id)
    {
        $pipeline = Pipeline::findOrFail($pipeline_id);

        // The first node of the pipeline is always the
        // start node (or it should always be)
        $node = $pipeline->nodes()->first();

        $step = new MessageStep([
            'message_id' => $this->id,
            'pipeline_id' => $pipeline->id,
            'node_id' => $node->id,
            'status' => 'QUEUED',
            'previous_step_id' => null
        ]);

        $step->save();
    }

}
