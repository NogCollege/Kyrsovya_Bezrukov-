<?php
// views/admin/manage-orders.php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\Order;

$this->title = 'Manage Orders';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="admin-manage-orders">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'user_id',
            'name',
            'phone',
            'address',
            'total',
            'created_at:datetime',
            'status',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update-status}',
                'buttons' => [
                    'update-status' => function ($url, $model, $key) {
                        return Html::a('Update Status', '#', [
                            'onclick' => 'showUpdateStatusModal(' . $model->id . ', "' . $model->status . '")',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>

    <!-- Modal for updating order status -->
    <div id="updateStatusModal" style="display:none;">
        <div>
            <h2>Update Order Status</h2>
            <?php $form = ActiveForm::begin(['action' => Url::to(['site/update-order-status'])]); ?>
            <?= Html::hiddenInput('orderId', '', ['id' => 'orderId']) ?>
            <?= Html::dropDownList('status', null, [
                Order::STATUS_PENDING => 'Pending',
                Order::STATUS_IN_PROGRESS => 'Принять в работу',
                Order::STATUS_REJECTED => 'Отклонить',
                Order::STATUS_COMPLETED => 'Завершить',
            ], ['id' => 'orderStatus']) ?>
            <div class="form-group">
                <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <script>
        function showUpdateStatusModal(orderId, currentStatus) {
            document.getElementById('orderId').value = orderId;
            document.getElementById('orderStatus').value = currentStatus;
            document.getElementById('updateStatusModal').style.display = 'block';
        }
    </script>
</div>
