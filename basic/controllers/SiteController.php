<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Texno;
use app\models\RegisterForm;
use app\models\User;
use app\models\Cart;
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'admin'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['admin'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function($rule, $action) {
                            return Yii::$app->user->identity->role === User::ROLE_ADMIN;
                        },
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionRegister()
    {
        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            return $this->redirect(['login']);
        }
        return $this->render('register', [
            'model' => $model,
        ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (Yii::$app->user->identity->role === User::ROLE_ADMIN) {
                return $this->redirect(['admin']);
            }
            return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionAdmin()
    {
        return $this->render('admin');
    }

    public function actionAdd()
    {
        $id = Yii::$app->request->post('id');
        $tovar = Texno::findOne($id);

        if ($tovar) {
            $cart = Yii::$app->session->get('cart', new Cart());
            $cart->addItem($tovar->attributes);
            Yii::$app->session->set('cart', $cart);
        }

        return $this->redirect(['cart/index']);
    }

    public function actionRemove($id)
    {
        $cart = Yii::$app->session->get('cart', new Cart());
        $cart->removeItem($id);
        Yii::$app->session->set('cart', $cart);

        return $this->redirect(['cart']);
    }

    public function actionUpdate()
    {
        $id = Yii::$app->request->post('id');
        $quantity = Yii::$app->request->post('quantity');

        $cart = Yii::$app->session->get('cart', new Cart());
        $cart->updateItem($id, $quantity);
        Yii::$app->session->set('cart', $cart);

        return $this->redirect(['cart']);
    }

    public function actionAddToCart()
    {
        $id = Yii::$app->request->post('id');
        $tovar = Texno::findOne($id);

        if ($tovar) {
            $cart = Yii::$app->session->get('cart', new Cart());
            $cart->addItem($tovar->attributes);
            Yii::$app->session->set('cart', $cart);
        }

        return $this->redirect(['site/cart']);
    }

    public function actionRemoveFromCart($id)
    {
        $cart = Yii::$app->session->get('cart', new Cart());
        $cart->removeItem($id);
        Yii::$app->session->set('cart', $cart);

        return $this->redirect(['site/cart']);
    }

    public function actionUpdateCart()
    {
        $id = Yii::$app->request->post('id');
        $quantity = Yii::$app->request->post('quantity');

        $cart = Yii::$app->session->get('cart', new Cart());
        $cart->updateItem($id, $quantity);
        Yii::$app->session->set('cart', $cart);

        return $this->redirect(['site/cart']);
    }

    public function actionCart()
    {
        $cart = Yii::$app->session->get('cart', new Cart());
        return $this->render('cart', ['cart' => $cart]);
    }


    /**
     * {@inheritdoc}
     */

    public function actionIndex()
    {
        $texnos = Texno::find()->all();

        return $this->render('index', [
            'texno' => $texnos,
        ]);
    }


    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
