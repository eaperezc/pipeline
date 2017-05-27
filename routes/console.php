<?php

use Illuminate\Foundation\Inspiring;

use App\Message;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');





// Remove this soon this is only for dev purposses to initialize a
// message on the pipeline 1 (the one we seed on the migrations)
Artisan::command('bulb:message', function () {

    $msg = new Message([
        'lifespan' => 3,
        'pipeline_id' => 1
    ]);
    $msg->save();

    $this->comment('Running new message in pipeline');
    $msg->runPipeline();


})->describe('[DEV] This starts a message on pipeline 1');
