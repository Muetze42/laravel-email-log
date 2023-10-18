<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Queue Connection
    |--------------------------------------------------------------------------
    |
    | This config determines with which queue connection the packet should
    | save the email logs. Note that with a connection other than sync the
    | authenticatable model cannot be logged anymore.
    |
    */

    'queue_connection' => 'sync',

    /*
    |--------------------------------------------------------------------------
    | Log Model
    |--------------------------------------------------------------------------
    |
    | The model specified here is used to store the log data.
    | If you want to make your own customizations, such as adding the
    | SoftDelete trait, you can determine your own model here.
    |
    */

    'model' => \NormanHuth\LaravelEmailLog\Models\EmailLog::class,
];
