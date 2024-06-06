<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Корзина';
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php if (empty($cart->getItems())): ?>
    <p>Ваша корзина пуста</p>
<?php else: ?>
    <table>
        <thead>
        <tr>
            <th>Название</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Сумма</th>
            <th>Действие</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($cart->getItems() as $item): ?>
            <tr>
                <td><?= Html::encode($item['id']) ?></td>
                <td><?= Html::encode($item['nazvan']) ?></td>
                <td><?= Html::encode($item['cena']) ?></td>
                <td>
                    <form method="post" action="<?= Url::to(['site/update-cart']) ?>">
                        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                        <input type="hidden" name="id" value="<?= Html::encode($item['id']) ?>">
                        <input type="number" name="quantity" value="<?= Html::encode($item['quantity']) ?>" min="1">
                        <button type="submit">Изменить</button>
                    </form>
                </td>
                <td><?= Html::encode($item['cena'] * $item['quantity']) ?></td>
                <td>
                    <a href="<?= Url::to(['site/remove-from-cart', 'id' => $item['id']]) ?>">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <p>Общая сумма: <?= Html::encode($cart->getTotal()) ?></p>

    <div>
        <?php $form = ActiveForm::begin(['action' => Url::to(['site/place-order'])]); ?>
        <?= $form->field($orderForm, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($orderForm, 'phone')->textInput(['maxlength' => true]) ?>
        <?= $form->field($orderForm, 'address')->textInput(['maxlength' => true]) ?>
        <?= Html::submitButton('Оформить заказ', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end(); ?>
    </div>
<?php endif; ?>

