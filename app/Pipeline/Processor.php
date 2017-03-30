<?php

namespace App\Pipeline;

use App\Message;
use App\Node;

/**
 * Class that runs the Node that is requested
 */
class Processor
{
    private $node;
    private $message;

    /**
     * Entry point for the processor where the whole
     * process for every node message is defined.
     *
     * @return void
     */
    public function process()
    {
        // First we check if we need to run something
        if ($this->prepare()) {
            // get the runner and run it
            $runner = $this->getNodeRunner();
            $runner->run();

            // finishing touches
            $this->finish();
        }
    }

    /**
     * In here we prepare the values for the processor, specially
     * we get the node and the message that will be executed.
     *
     * @return boolean  true if all is good, false if there nothing to do
     */
    private function prepare()
    {
        // Get a queued message
        $this->message = Message::where('status', 'QUEUED')->first();

        // No pending messages
        if (!$this->message) {
            return false;
        }
        $this->message->status = 'RUNNING';
        $this->message->save();

        // get the node to execute
        $this->node = Node::find($this->message->node_id);
        return true;
    }

    /**
     * Finishing touches. Anything from updating the message to
     * prepare new nodes for the next part of the process.
     *
     * @return void
     */
    private function finish()
    {
        $this->message->status = 'COMPLETED';
        $this->message->save();
    }

    /**
     * This will get the runner that we need to execute.
     *
     * @return \App\Pipeline\Runner\Abstract instance
     */
    private function getNodeRunner()
    {
        $factory = new \App\Pipeline\RunnerFactory;
        return $factory->getRunner($this->node->type);
    }
}
