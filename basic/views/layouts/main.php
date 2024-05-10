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
<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>



<section class="promo ">
    <div class="sect1-text container">
        <h1>Техно Антошка</h1>
        <p class="zag-text">Лучшая техника и электроника только у Антошки</p>
    </div>
    <div class="spip">
        <ul class="spis1 container">
            <li>
                <div><p>Огромный выбор техники и<br> оборудывания   у Антошки</p></div>
            </li>
            <li>
                <div><p>Самая низкая цена<br> на рынке у Антошки</p></div>
            </li>
            <li>
                <div><p>Скидки и акции каждую<br> неделю у Антошки </p></div>
            </li>
        </ul>
    </div>
</section>

<section class="fleet" id="tovar">
    <div class="sect2-he container">
        <h1>Техника Антошки</h1>
        <button>Смотреть всё</button>
    </div>
    <div class="sect2-car container">
        <ul class="car container">
            <li>
                <button class= "white w5" >Сматфоны</button>

            </li>
            <li>
                <button class=" white w1 " >Телевизоры</button>

            </li>
            <li>
                <button class=" white w4" > Техника для кухни</button>

            </li>
            <li>
                <button class=" white w2" >Техника для дома</button>

            </li>
            <li>
                <button class=" white w3" ">Аудиотехника</button>

            </li>
        </ul>
    </div>
    
</section>
<section class="stock">
     <div class="stok_main container">
         <div class="stok_text">
             <h2>При выборе у Антошки вы получите <span>выгодные предложения</span></h2>
             <p>Успейте воспользоваться нашими выгодными акциями и скидками на лучшую технику от ведущих мировых брендов! Покупайте смартфоны, ноутбуки, телевизоры, наушники и многое другое по выгодным ценам. Подарите себе и своим близким надежные технологии отличного качества! Не упустите шанс сэкономить и обновить свои гаджеты прямо сейчас. Следите за новыми акциями и получайте самые выгодные предложения только у нас! </p>
         </div>

         <div class="stok_img">
             <img src="/../web/img/unnamed.jpg">
             <h3>Блендер Polaris PHB 1476</h3>
             <div class="img_tex">
                 <p class="opis">3 в 1: измельчитель, блендер, миксер. Технология PROtect+ двойная защита двигателя обеспечивает надежность и долговечность.</p>
                 <p class="cen">3490 руб.</p>
                 <p>2792 руб.</p>
             </div>

         </div>
     </div>

</section>

<section class="sect4">
    <h1 class="container">Огромный выбор техники у Антошки</h1>
    <div class="sect4_main container">
        <div>
            <img src="/../web/img/78d51d7e00d69bcbaededa4130088f2d.jpg">
            <h3>Бытовая техника</h3>
            <p>Создавайте уют и комфорт в своем доме с помощью нашей высококачественной бытовой техники.</p>
        </div>

        <div>
            <img src="/../web/img/cf2100a0f1f84a1735e572cc2f7b7822.jpg">
            <h3>Цифровая техника</h3>
            <p>Откройте перед собой мир инновационных технологий с нашим ассортиментом цифровой техники.</p>
        </div>
    </div>
</section>
<section class="sect5">
    <h1 class="container">Причины покупать у Антошки</h1>
    <div class="resons container">
        <ul>
            <li>
                <div>
                    <img src="/../web/img/free-icon-guarantee-1261077.png">
                </div>
                <div class="s5_text">
                    <h2>Гарантия</h2>
                    <p>При покупке вы всегда получите гарантию на товар </p>
                </div>
            </li>

            <li>
                <div>
                    <img src="/../web/img/free-icon-wallet-2169854.png">
                </div>
                <div class="s5_text">
                    <h2>Оплата</h2>
                    <p>Любая и удобная форма оплаты(любые банковские карты)</p>
                </div>
            </li>

            <li>
                <div>
                    <img src="/../web/img/free-icon-time-5030436.png">
                </div>
                <div class="s5_text">
                    <h2>Скорость</h2>
                    <p>Оплата проходит быстро не более 3 минут</p>
                </div>
            </li>

            <li>
                <div>
                    <img src="/../web/img/free-icon-reviews-5185793.png">
                </div>
                <div class="s5_text">
                    <h2>Реальные отзывы</h2>
                    <p>Все отзывы модерируются и не допускаются к накрутке</p>
                </div>
            </li>

        </ul>
    </div>
</section>

<section class="questions">
    <div class="s6 container">
        <div class="s6-ph">
            <img src="/../web/img/263452345%201.png" alt="">
        </div>

        <div class="s6-text">
            <h1>Есть вопросы?</h1>
            <p>С вами свяжутся в течении 10 минут чтобы ответить на все вопросы</p>
            <b>8 800 555 35 35 </b>

            <input class="fo" type="text" placeholder="Введите имя">
            <input class="fo" type="text" placeholder="8 911 402 23 45">
            <button>Оставить запрос</button>
            <div class="x">
                <input class="gal" type="checkbox" name="a" value="1">
                <p class="galo">Отправляя форму, я соглашаюсь<br>
                    с <span>политикой обработки персональных данных</span></p>
            </div>
        </div>
    </div>
</section>

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
</body>
</html>
<?php $this->endPage() ?>
