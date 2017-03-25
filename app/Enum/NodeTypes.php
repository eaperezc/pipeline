<?php

namespace App\Enum;

/**
* A class that will handle the list of node types
* and the configuration per node type
*/
class NodeTypes
{

    private static $types = [
        [
            'name' => 'email',
            'icon' => '/images/email.png'
        ],
        [
            'name' => 'sms',
            'icon' => '/images/sms.png'
        ],
        [
            'name' => 'report',
            'icon' => '/images/report.png'
        ],
        [
            'name' => 'analytics',
            'icon' => '/images/analytics.png'
        ],

        [
            'name' => 'timer',
            'icon' => '/images/clock.png'
        ],
        [
            'name' => 'script',
            'icon' => '/images/terminal.png'
        ],
        [
            'name' => 'api',
            'icon' => '/images/cloud.png'
        ],
        [
            'name' => 'database',
            'icon' => '/images/database.png'
        ],
        [
            'name' => 'facebook',
            'icon' => '/images/facebook.png'
        ],
        [
            'name' => 'googleplus',
            'icon' => '/images/googleplus.png'
        ]
    ];


    public static function all()
    {
        return self::$types;
    }
}
