<?php

namespace app\Components\Logging;

use Yii;

class LoggerFactory
{
    public static function createLogger(string $type = null): LoggerInterface
    {
        $availableLoggerTypes = Yii::$app->params['logger_types'];
        $defaultLoggerType = Yii::$app->params['default_logger_type'];

        $loggerType = $type && key_exists($type, $availableLoggerTypes)
            ? $type : $defaultLoggerType;

        $loggerClass = $availableLoggerTypes[$loggerType]['driver'];

        return new $loggerClass($loggerType);
    }
}