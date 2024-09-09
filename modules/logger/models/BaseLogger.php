<?php

namespace app\modules\logger\models;

use yii\base\Model;

abstract class BaseLogger extends Model implements ILogger
{
    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    public function log($message) {}
}
