<?php

namespace app\Components\Logging\Loggers;

class EmailLogger extends BaseLogger
{
    public function send(string $message): void
    {
        echo "Logged: $message\n" . "Type: {$this->type}. \n" . "Email: " . \Yii::$app->params['email'] . "\n";
    }
}