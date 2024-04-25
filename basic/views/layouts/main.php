<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<!--<header id="header">-->
<!--    --><?php
//    NavBar::begin([
//        'brandLabel' => Yii::$app->name,
//        'brandUrl' => Yii::$app->homeUrl,
//        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
//    ]);
//    echo Nav::widget([
//        'options' => ['class' => 'navbar-nav'],
//        'items' => [
//            ['label' => 'Главная', 'url' => ['/site/index']],
//            ['label' => 'О нас', 'url' => ['/site/about']],
//            ['label' => 'Контакты', 'url' => ['/site/contact']],
//            Yii::$app->user->isGuest
//                ? ['label' => 'Login', 'url' => ['/site/login']]
//                : '<li class="nav-item">'
//                    . Html::beginForm(['/site/logout'])
//                    . Html::submitButton(
//                        'Logout (' . Yii::$app->user->identity->username . ')',
//                        ['class' => 'nav-link btn btn-link logout']
//                    )
//                    . Html::endForm()
//                    . '</li>'
//        ]
//    ]);
//    NavBar::end();
//    ?>
<!--</header>-->
<header class="head">
    <div class="nav-menu">
        <ul class="menu">
            <div class="logo">
                <li><h1>Техно от Антошки</h1></li>
            </div>
            <div class="menu-l">
                <li><a>Главная</a></li>
                <li><a>О нас</a></li>
                <li><a>Контакты</a></li>
            </div>
            <div class="soc">
                <li><a><img src="/../web/img/free-icon-vkontakte-4494517.png" alt=""></a></li>
                <li><a><img src="/../web/img/free-icon-whatsapp-4494494.png" alt=""></a></li>
            </div>
            <div class="tel">
                <li>8 800 555 35 35</li>
            </div>
            <div>
                <li><button class="button-head">Корзина</button></li>
            </div>
            <div class="prof">
                <li><a href="admin.php"><img src="templates/img/Group 71.png" alt=""></a></li>
                <li><img src="templates/img/Group 72.png" alt=""></li>
            </div>
        </ul>
    </div>
</header>
<!--<main id="main" class="flex-shrink-0" role="main">-->
<!--    <div class="container">-->
<!--        --><?php //if (!empty($this->params['breadcrumbs'])): ?>
<!--            --><?php //= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
<!--        --><?php //endif ?>
<!--        --><?php //= Alert::widget() ?>
<!--        --><?php //= $content ?>
<!--    </div>-->
<!--</main>-->



<section class="promo ">
    <div class="sect1-text container">
        <h1>Техно Антошка</h1>
        <p>Лучшая техника и электроника только у Антошки</p>
    </div>
    <hr size="1px">
    <div class="spip">
        <ul class="spis1 container">
            <li>
                <div class="k"><h3>1</h3></div>
                <div><p>Большой парк <br>
                        автомобилей в наличии</p></div>
            </li>
            <li>
                <div><h3>2</h3></div>
                <div><p>Доставка авто <br>
                        до вашей геолокации</p></div>
            </li>
            <li>
                <div><h3>3</h3></div>
                <div><p>Скидки постоянным <br>
                        клиентам</p></div>
            </li>
            <li>
                <div><h3>4</h3></div>
                <div><p>Любая форма <br>
                        оплаты</p></div>
            </li>
            <li>
                <div><h3>5</h3></div>
                <div><p>Выгодные цены</p></div>
            </li>
        </ul>
    </div>
</section>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
