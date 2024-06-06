<?php

// views/site/thank-you.php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Спасибо за заказ!';
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>Ваш заказ был успешно оформлен. Мы свяжемся с вами в ближайшее время.</p>

<div>
    <a href="<?= Url::home() ?>" class="btn btn-primary">Вернуться на главную</a>
</div>
