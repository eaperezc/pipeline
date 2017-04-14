<?php

namespace App\Pipeline\Runner;

/**
 * This class will initialize the pipeline nodes for
 * the message
 */
class Start
{
    public function run()
    {
        // This is not doing anything more than running the first time
        // and letting the processor to generate the followint nodes
    }
}
