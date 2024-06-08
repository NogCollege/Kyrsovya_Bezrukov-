<?php
// In views/product/view.php
/* @var $this yii\web\View */
/* @var $product app\models\Product */

use yii\helpers\Html;

$this->title = $texno->nazvan;
?>
<h1 class="container"><?= Html::encode($this->title) ?></h1>
<div class="product-view container">
    <div class="product-image">
        <img src="<?= $texno->img_url ?>" alt="<?= Html::encode($texno->nazvan) ?>" style="width:600px; border-radius: 20px;">
    </div>
    <div class="product-details">
        <p><strong>Модель:</strong> <?= Html::encode($texno->modeli) ?></p>
        <p><strong>Описание:</strong> <?= Html::encode($texno->min_opis) ?></p>
        <p><strong>Цена:</strong> <?= Html::encode($texno->cena) ?></p>
    </div>
</div>
