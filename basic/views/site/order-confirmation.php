<?php

use yii\helpers\Html;

$this->title = 'Order Confirmation';
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>Ваш заказ успешно оформлен. Спасибо за покупку!</p>
<p>Мы свяжемся с вами по указанным контактным данным для подтверждения заказа и дальнейшей доставки.</p>

<a href="<?= Yii::$app->homeUrl ?>" class="btn btn-primary">Вернуться на главную</a>
