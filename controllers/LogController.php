<?php

namespace app\controllers;

use app\modules\logger\components\LoggerFactory;
use yii\web\Controller;

class LogController extends Controller
{
    /**
     * Sends a log message to the default logger (file).
     */
    public function actionLog()
    {
        $logger = LoggerFactory::createLogger('file');
        $logger->log("This is a log message to the default file logger.");
        var_dump("This is a log message to the default file logger.");
    }

    /**
     * Sends a log message to a special logger.
     * @param string $type
     */
    public function actionLogTo($type)
    {
        try {
            $logger = LoggerFactory::createLogger($type);
            $logger->log("This is a log message to the {$type} logger.");
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Sends a log message to all loggers (file, db, email).
     */
    public function actionLogToAll()
    {
        $loggers = ['file', 'db', 'email'];
        foreach ($loggers as $type) {
            $logger = LoggerFactory::createLogger($type);
            $logger->log("This is a log message to the {$type} logger.");
        }
    }
}
