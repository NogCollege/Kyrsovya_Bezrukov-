<?php
/* @var $this yii\web\View */
/* @var $texnos app\models\Texno[] */
/* @var $query string */

use yii\helpers\Html;

$this->title = 'Результаты поиска: ' . Html::encode($query);
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php if (empty($texnos)): ?>
    <p>По вашему запросу ничего не найдено.</p>
<?php else: ?>
    <div class="product-list">
        <?php foreach ($texnos as $texno): ?>
            <div class="product-item">
                <h2><?= Html::a(Html::encode($texno->nazvan), ['texno/view', 'id' => $texno->id]) ?></h2>
                <p>Описание: <?= Html::encode($texno->min_opis) ?></p>
                <p>Цена: <?= Html::encode($texno->cena) ?> руб.</p>
                <?= Html::beginForm(['cart/add', 'id' => $texno->id], 'post') ?>
                <?= Html::submitButton('Добавить в корзину', ['class' => 'btn btn-primary']) ?>
                <?= Html::endForm() ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
