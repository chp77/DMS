<?php

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that gets used when writing
    | messages to the logs. The name specified in this option should match
    | one of the channels defined in the "channels" configuration array.
    |
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Deprecations Log Channel
    |--------------------------------------------------------------------------
    |
    | This option controls the log channel that should be used to log warnings
    | regarding deprecated PHP and library features. This allows you to get
    | your application ready for upcoming major versions of dependencies.
    |
    */

    'deprecations' => env('LOG_DEPRECATIONS_CHANNEL', 'null'),

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog",
    |                    "custom", "stack"
    |
    */

    'channels' => [

        'stack' => [
            'driver' => 'stack',
            'channels' => ['single'],
            'ignore_exceptions' => false,
        ],

        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => 14,
        ],

        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => 'Laravel Log',
            'emoji' => ':boom:',
            'level' => env('LOG_LEVEL', 'critical'),
        ],

        'papertrail' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => SyslogUdpHandler::class,
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),
                'port' => env('PAPERTRAIL_PORT'),
            ],
        ],

        'stderr' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'with' => [
                'stream' => 'php://stderr',
            ],
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'null' => [
            'driver' => 'monolog',
            'handler' => NullHandler::class,
        ],

        'emergency' => [
            'path' => storage_path('logs/laravel.log'),
        ],

        'commandlog' => [
            'driver' => 'daily',
            'path' => storage_path('logs/command.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => 365, // one year
        ],

        'devicelog' => [
            'driver' => 'daily',
            'path' => storage_path('logs/device.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => 365, // one year
        ],

        'systemlog' => [
            'driver' => 'daily',
            'path' => storage_path('logs/system.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => 365, // one year
        ],

        'actionlog' => [
            'driver' => 'daily',
            'path' => storage_path('logs/action.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => 365, // one year
        ],

        // log the file based on the organization ID or user ID
        'organizationLog' => [
            'driver' => 'custom',
            'via' => App\Logging\CreateOrganizationLogFile::class,
            'level' => 'info',
            'days' => 365,
        ],

        'userlog' => [
            'driver' => 'custom',
            'via' => App\Logging\CreateUserLogFile::class,
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => 365, // one year
        ],

        'emaillog' => [
            'driver' => 'daily',
            'path' => storage_path('logs/email.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => 365, // one year
        ],

        'apilog' => [
            'driver' => 'daily',
            'path' => storage_path('logs/api.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => 365, // one year
        ],

        'webhooklog' => [
            'driver' => 'daily',
            'path' => storage_path('logs/webhook.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => 365, // one year
        ],
    ],

];
