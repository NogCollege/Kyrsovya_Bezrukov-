<?php
use yii\helpers\Html;

$this->title = 'Каталог';
?>
<div class="katalog container">
    <ul class="katal">
        <?php foreach ($rows as $item): ?>
            <li class="cartoc vis <?= $item->cateauto ?>">
                <div class="img-kat">
                    <img src="templates/img/photots/<?= $item->id ?>-<?= $item->nazvan ?>/main.jpg" alt="">
                </div>
                <h4><?= $item->cena ?>, <?= $item->min_opis ?></h4>
                <div class="text-s2">
                    <p><img src="templates/img/Vector (8).png" alt=""><?= $item->modeli ?>, <?= $item->garantia ?></p>
                    <p class="pa"><img src="templates/img/Vector (9).png" alt=""><?= $item->potrebenergi ?></p>
                </div>
                <hr size="1px">
                <div class="cen">
                    <a href="fulcat.php?id=<?= $item->id ?>"><?= Html::button('Забронировать') ?></a>
                    <p>от <span><?= $item->mid ?> руб/сут.</span></p>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>