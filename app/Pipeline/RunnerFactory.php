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
            case 'email':
                $runner = new \App\Pipeline\Runner\Email;
                break;
        }
        return $runner;
    }
}
