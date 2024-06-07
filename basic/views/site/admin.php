<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

$this->title = 'Admin Panel';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="admin-panel">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Manage Products', ['admin/index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Manage Orders', ['site/manage-orders'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php if ($action === 'admin'): ?>
        <p>
            <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                'nazvan',
                'cena',
                'min_opis',
                'max_opis',
                'img_url',
                'categoria',
                'podcateg',
                'potrebenergi',
                'modeli',
                'garantia',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                    'buttons' => [
                        'update' => function ($url, $model, $key) {
                            return Html::a('Update', ['updatee', 'id' => $model->id]);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('Delete', ['delete', 'id' => $model->id], [
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>
    <?php elseif ($action === 'create' || $action === 'updatee'): ?>
        <div class="texno-form">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'nazvan')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'cena')->textInput() ?>
            <?= $form->field($model, 'potrebenergi')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'modeli')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'garantia')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'max_opis')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'min_opis')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'img_url')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'categoria')->dropDownList([
                'Смартфоны' => 'Смартфоны',
                'Телевизоры' => 'Телевизоры',
                'Холодильники' => 'Холодильники',
                'Стеральные машины' => 'Стеральные машины',
                'Ноутбуки'=>'Ноутбуки',
            ], ['prompt' => 'Select Category']) ?>
            <?= $form->field($model, 'podcateg')->dropDownList([
                'IOS' => 'IOS',
                'Android' => 'Android',
                'LED' => 'LED',
                'OLED' => 'OLED',
                'Двухкамерные холодильники' => 'Двухкамерные холодильники',
                'Однокамерные холодильники' => 'Однокамерные холодильники',
                'Вертикальная загрузка' => 'Вертикальная загрузка',
                'Фронтальная загрузка' => 'Фронтальная загрузка',
                'Обычные ноутбуки' => 'Обычные ноутбуки',
                'Геймерские ноутбуки' => 'Геймерские ноутбуки',
            ], ['prompt' => 'Select Subcategory']) ?>


            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Updatee', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    <?php endif; ?>
</div>
