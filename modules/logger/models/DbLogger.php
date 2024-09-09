<?php

namespace app\modules\logger\models;

use yii;

class DbLogger extends BaseLogger
{
    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    /**
     * @param $message
     * @return void
     */
    public function log($message)
    {
        // Імітація запису в базу даних
        Yii::$app->session->addFlash('result', 'Log to database: ' . $message . PHP_EOL);

        // Реальний запис в БД (якщо є таблиця 'log')
        /*
        Yii::$app->db->createCommand()->insert('log', [
            'message' => $message,
            'created_at' => date('Y-m-d H:i:s'),
        ])->execute();
        */
    }
}
