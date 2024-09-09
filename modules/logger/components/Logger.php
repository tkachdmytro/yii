<?php

namespace app\modules\logger\components;

class Logger implements LoggerInterface
{
    private $logger;
    private string $defaultType;

    /**
     * @param string $defaultType
     * @throws \Exception
     */
    public function __construct(string $defaultType)
    {
        $this->defaultType = $defaultType;
        $this->logger = LoggerFactory::createLogger($this->defaultType);
    }

    /**
     * @param string $message
     * @return void
     */
    public function send(string $message): void
    {
        $this->logger->log($message);
    }

    /**
     * @param string $message
     * @param string $loggerType
     * @return void
     * @throws \Exception
     */
    public function sendByLogger(string $message, string $loggerType): void
    {
        $logger = LoggerFactory::createLogger($loggerType);
        $logger->log($message);
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->logger->getType();
    }

    /**
     * @param string $type
     * @return void
     * @throws \Exception
     */
    public function setType(string $type): void
    {
        $this->logger = LoggerFactory::createLogger($type);
    }
}
