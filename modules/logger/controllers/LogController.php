<?php

namespace app\modules\logger\controllers;

use app\modules\logger\components\LoggerFactory;
use yii;
use yii\web\Controller;

class LogController extends Controller
{
    /**
     * Renders the form and processes the log message.
     */
    public function actionIndex()
    {
        $message = "TEST";
        $type = Yii::$app->getModule('logger')->params['loggerType'];
        try {
            $logger = LoggerFactory::createLogger($type);
            $logger->log($message);
            Yii::$app->session->setFlash('success', 'Message logged successfully.');
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->render('index');
    }

    /**
     * Renders the form and processes the log message.
     */
    public function actionForm()
    {
        $model = new \yii\base\DynamicModel(['message', 'loggerType']);
        $model->addRule(['message', 'loggerType'], 'required');
        $model->addRule('loggerType', 'in', ['range' => ['file', 'db', 'email']]);

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                try {
                    $logger = LoggerFactory::createLogger($model->loggerType);
                    $logger->log($model->message);
                    Yii::$app->session->setFlash('success', 'Message logged successfully.');
                } catch (\Exception $e) {
                    Yii::$app->session->setFlash('error', $e->getMessage());
                }

                return $this->render('index');
            }
        }

        return $this->render('log-form', [
            'model' => $model,
        ]);
    }

    /**
     * Sends a log message to the default logger (file).
     */
    public function actionLog()
    {
        $this->log();

        return $this->render('index');
    }

    /**
     * Sends a log message to a special logger.
     * @param string $type
     */
    public function actionLogTo($type)
    {
        $this->logTo($type);

        return $this->render('index');
    }

    /**
     * Sends a log message to all loggers (file, db, email).
     */
    public function actionLogToAll()
    {
        $this->logToAll();

        return $this->render('index');
    }

    /**
    • Sends a log message to the default logger.
     */
    public function log()
    {
        $logger = LoggerFactory::createLogger('file');
        $logger->log("This is a log message to the default file logger.");
    }

    /**
    • Sends a log message to a special logger.
     *
    • @param string $type
     */
    public function logTo(string $type)
    {
        try {
            $logger = LoggerFactory::createLogger($type);
            $logger->log("This is a log message to the {$type} logger.");
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
    • Sends a log message to all loggers.
     */
    public function logToAll()
    {
        $loggers = ['file', 'db', 'email'];
        foreach ($loggers as $type) {
            $logger = LoggerFactory::createLogger($type);
            $logger->log("This is a log message to the {$type} logger.");
        }
    }
}
