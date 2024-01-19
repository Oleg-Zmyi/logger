<?php

use app\Components\Logging\Loggers\DBLogger;
use app\Components\Logging\Loggers\EmailLogger;
use app\Components\Logging\Loggers\FileLogger;

return [
        'default_logger_type' => 'email',
        'email' => 'admin@gmail.com',
        'logger_types' => [
            'file' => [
                'driver' => FileLogger::class,
            ],
            'db' => [
                'driver' => DBLogger::class,
            ],
            'email' => [
                'driver' => EmailLogger::class,
            ]
        ]
    ];