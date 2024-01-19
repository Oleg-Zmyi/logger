<?php

namespace app\Components\Logging\Loggers;

use app\Components\Logging\LoggerFactory;
use app\Components\Logging\LoggerInterface;


abstract class BaseLogger implements LoggerInterface
{
    protected string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function send(string $message): void
    {
        echo "Logged: $message. \n" . "Type: {$this->type}\n";
    }

    public function sendByLogger(string $message, string $loggerType): void 
    {
        $logger = LoggerFactory::createLogger($loggerType);
        $logger->send($message);
    }

    public function getType(): string 
    {
        return $this->type;
    }

    public function setType(string $type): void 
    {
        $this->type = $type;
    }
}
