<?php

namespace App\Pipeline;

/**
 * A factory for all the node runners of the app
 */
class RunnerFactory
{
    /**
     * Method that will instantiate a runner depending on the
     * type. This type is actually a node type.
     *
     * @param string $type  The node type
     * @return \App\Pipeline\Runner\* instance
     */
    public function getRunner($type)
    {
        $runner = null;

        switch ($type) {
            case 'start':
                $runner = new \App\Pipeline\Runner\Start;
                break;
            case 'email':
                $runner = new \App\Pipeline\Runner\Email;
                break;
            default:
                throw new \Exception("Runner for node type {$type} is not available.");
                break;
        }
        return $runner;
    }
}
