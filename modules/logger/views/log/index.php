<?php

/** @var yii\web\View $this */

$this->title = 'Log';

$result = Yii::$app->session->getFlash('result');
?>
<div id="message">
    <?= implode('<br \>', $result); ?>
</div>
