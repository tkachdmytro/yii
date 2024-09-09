<?php

namespace app\modules\logger\models;

use Yii;

class EmailLogger extends BaseLogger
{
    private string $email;

    /**
     * @param string $email
     * @param array $config
     */
    public function __construct(string $email, array $config = [])
    {
        $this->email = $email;
        parent::__construct($config);
    }

    public function log($message)
    {
        // Імітація відправки повідомлення електронною поштою
        Yii::$app->session->addFlash('result', 'Send email to ' . $this->email . ': ' . $message . PHP_EOL);

        // Реальне надсилання листа
        /*
        Yii::$app->mailer->compose()
            ->setTo($this->email)
            ->setSubject('Log Message')
            ->setTextBody($message)
            ->send();
        */
    }
}
