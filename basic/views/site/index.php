<?php

/** @var yii\web\View $this */
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Интернет магазин';
?>




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

    <?php
    $pdo = new PDO('mysql:host=localhost;dbname=tovarin', 'root', '');

    // Получение данных о товарах из базы
    $statement = $pdo->query('SELECT * FROM TEXNO');
    $texnos = $statement->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <div class="katalog container">
        <ul class="katal">
            <?php foreach ($texnos as $texno): ?>
                <li class="vis-biba">
                    <div class="img-kat">
                        <img style="border-radius: 20px; height: 350px;" class="fotografia" src="<?= $texno['img_url'] ?> ">
                    </div>
                    <h4><?= $texno['nazvan'] ?></h4>
                    <div class="text-s2">
                        <p class="pa"><img src="" alt="">Модель: <?= $texno['modeli'] ?></p>
                    </div>
                    <div class="op">
                        <p class="opisan"><?= $texno['min_opis'] ?></p>
                    </div>
                    <div class="cen">
                        <p class="ce">Цена: <?= $texno['cena'] ?></p>
                        <form method="post" action="<?= Url::to(['site/add-to-cart']) ?>">
                            <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                            <input type="hidden" name="id" value="<?= $texno['id'] ?>">
                            <input type="hidden" name="nazvan" value="<?= $texno['nazvan'] ?>">
                            <input type="hidden" name="cena" value="<?= $texno['cena'] ?>">
                            <button type="submit">заказать</button>
                            <a href="<?= Url::to(['site/view', 'id' => $texno['id']]) ?>" class="btn btn-info">Подробнее</a>
                        </form>

                    </div>
                </li>
            <?php endforeach; ?>
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

