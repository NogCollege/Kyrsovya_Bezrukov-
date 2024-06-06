<?php
// views/site/profile.php

// views/site/profile.php

use yii\helpers\Html;

$this->title = 'Мой профиль';
?>

<h1><?= Html::encode($this->title) ?></h1>

<h2>Мои заказы</h2>

<?php if (empty($orders)): ?>
    <p>У вас нет заказов.</p>
<?php else: ?>
    <table>
        <thead>
        <tr>
            <th>ID Заказа</th>
            <th>Дата</th>
            <th>Сумма</th>
            <th>Статус</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= Html::encode($order->id) ?></td>
                <td><?= Html::encode(date('d-m-Y H:i', $order->created_at)) ?></td>
                <td><?= Html::encode($order->total) ?></td>
                <td><?= Html::encode($order->status) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

