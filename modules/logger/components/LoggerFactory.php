<?php

namespace app\modules\logger\components;

use Yii;
use app\modules\logger\models\ILogger;
use app\modules\logger\models\FileLogger;
use app\modules\logger\models\DbLogger;
use app\modules\logger\models\EmailLogger;

class LoggerFactory
{
    /**
     * Створює екземпляр логера на основі типу
     * @param string $type
     * @return ILogger
     * @throws \Exception
     */
    public static function createLogger(string $type): ILogger
    {
        switch ($type) {
            case 'file':
                return new FileLogger();
            case 'db':
                return new DbLogger();
            case 'email':
                return new EmailLogger(Yii::$app->getModule('logger')->params['adminEmail']);
            default:
                throw new \Exception("Unknown logger type: $type");
        }
    }
}
