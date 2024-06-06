<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Оформление заказа';
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="order-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($orderModel, 'customer_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($orderModel, 'customer_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($orderModel, 'customer_address')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Заказать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>