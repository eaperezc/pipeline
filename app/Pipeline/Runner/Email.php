<?php

namespace App\Pipeline\Runner;

use Mail;

/**
 * This class will send an email
 */
class Email
{
    public function run()
    {
        echo "Send an email here...\n";

        Mail::send('emails.simple', [], function ($m) {
            $m->from('bulber@example.com', 'Bulb');

            $m->to('eperez@test.com', 'Enrique')->subject("OMG you've got mail!");
        });

    }
}
