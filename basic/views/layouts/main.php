<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

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
<script src="/../web/jquery-3.7.1.min.js"></script>
<?php $this->beginBody() ?>
<header class="head">
    <div class="nav-menu">
        <ul class="menu">
            <div class="logo">
                <li><h1>Техно от Антошки</h1></li>
            </div>
            <div class="menu-l"
            <li><a>Главная</a></li>
            <li><a>Товары</a></li>
            <li><a>Контакты</a></li>
            <li><?= Html::a('Логин',  ['/site/login']) ?></li>
            <li><?= Html::a('Выйти', ['/site/logout'], ['data-method' => 'post']) ?></li>
            <?php if (!Yii::$app->user->isGuest): ?>
                <a href="<?= Url::to(['site/profile']) ?>">Мой профиль</a>
            <?php endif; ?>


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
        <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->hasRole('admin')): ?>
            <li><?= Html::a('Админ', ['/site/admin']) ?></li>
        <?php endif; ?>
        <li><img src="templates/img/Group 72.png" alt=""></li>
    </div>
    </ul>
    </div>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div>
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer>
    <div class="fot container">
        <div class="fot_cont">
            <h1>Контакты</h1>
            <a href="">Адрес магазинов</a>
            <p>8 800 555 35 35</p>
            <button>Задать вопросы</button>
        </div>
        <div class="fot_ul">
            <ul class="fot_spisok">
                <li class="glav">
                    <a  href="#tovar">Товары</a>
                    <a href="">Акции</a>
                    <a href="">Гарантия</a>
                    <a href="">Информация</a>

                </li>
                <li>
                    <a href="">Услуги</a>
                    <a href="">Обзоры</a>
                    <a href="">Сервесные центры</a>
                    <a href="">Подарочные карты</a>
                </li>
                <li>
                    <a href="">Партнёрская программа</a>
                    <a href="">Политика компании</a>
                    <a href="">Документы</a>
                    <a href="">Пресс-центр</a>
                </li>
            </ul>
        </div>
    </div>
    <hr class="hr container">
    <div class="adress container">
        <div>
            <a href=""><img src="/../web/img/free-icon-whatsapp-4494494.png"></a>
            <a href=""><img src="/../web/img/free-icon-vkontakte-4494517.png"></a>
        </div>
        <div>
            <p>Московская область, г. Ногинск, Молодежная ул., д. 1</p>
            <p>© Техно у Антошки, 2024</p>
        </div>
    </div>
</footer>


<?php $this->endBody() ?>
<script>
    console.log($);
</script>
</body>
</html>
<?php $this->endPage() ?>
