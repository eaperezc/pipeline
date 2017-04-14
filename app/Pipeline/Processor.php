<?php

namespace App\Pipeline;

use App\Message;
use App\MessageStep;
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
        try {

            // First we check if we need to run something
            if ($this->prepare()) {
                // get the runner and run it
                $runner = $this->getNodeRunner();
                $runner->run();

                // finishing touches
                $this->finish();
            }

        } catch(\Exception $e) {

            // Here we will save the step as an error step
            // and also throw the exception so the kernel
            // takes care of showing it on the console
            $this->step->status = 'ERROR';
            $this->step->result = $e->getMessage();
            $this->step->save();

            throw $e;

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
        $this->step = MessageStep::where('status', 'QUEUED')->first();

        // No pending messages
        if (!$this->step) {
            return false;
        }
        $this->step->status = 'RUNNING';
        $this->step->save();

        // get the node to execute
        $this->node = Node::find($this->step->node_id);
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
        $this->step->status = 'COMPLETED';
        $this->step->save();

        // Now that this step is done, we need to check if
        // we have more nodes to run and queue them
        $this->step->queueNextSteps();
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
