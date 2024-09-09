<?php

namespace app\modules\logger\models;

use yii;

class FileLogger extends BaseLogger
{
    /**
     * @var string
     */
    private string $filePath;

    /**
     * @param $filePath
     * @param array $config
     */
    public function __construct($filePath = '@runtime/logs/app.log', array $config = [])
    {
        $this->filePath = \Yii::getAlias($filePath);
        parent::__construct($config);
    }

    /**
     * @param $message
     * @return void
     */
    public function log($message)
    {
        file_put_contents($this->filePath, $message . PHP_EOL, FILE_APPEND);
        Yii::$app->session->addFlash('result', "Log to file: " . $message . PHP_EOL);
    }
}
