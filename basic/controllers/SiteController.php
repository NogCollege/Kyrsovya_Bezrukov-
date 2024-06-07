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
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\models\Order;
use app\models\OrderForm;
use app\models\OrderItem;
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
        $dataProvider = new ActiveDataProvider([
            'query' => Texno::find(),
        ]);

        return $this->render('admin', [
            'dataProvider' => $dataProvider,
            'action' => 'admin',
        ]);
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
        $cart = Yii::$app->session->get('cart', []);
        $orderForm = new OrderForm();
        return $this->render('cart', ['cart' => $cart, 'orderForm' => $orderForm]);
    }


    public function actionPlaceOrder()
    {
        $model = new OrderForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $order = new Order();
            $order->user_id = Yii::$app->user->id;
            $order->name = $model->name;
            $order->phone = $model->phone;
            $order->address = $model->address;
            $order->items = json_encode(Yii::$app->cart->getItems());
            $order->total = Yii::$app->cart->getTotal();
            $order->status = Order::STATUS_PENDING; // Set the default status
            $order->created_at = time();

            if ($order->save()) {
                Yii::$app->cart->clear();
                return $this->redirect(['site/thank-you']);
            }
        }

        return $this->render('checkout', [
            'model' => $model,
        ]);
    }

    public function actionThankYou()
    {
        return $this->render('thank-you');
    }

    public function actionProfile()
    {
        $userId = Yii::$app->user->id;
        $orders = Order::find()->where(['user_id' => $userId])->orderBy(['created_at' => SORT_DESC])->all();

        return $this->render('profile', [
            'orders' => $orders,
        ]);
    }

    public function actionManageOrders()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find()->orderBy(['created_at' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('manage-orders', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdateOrderStatus()
    {
        if (Yii::$app->request->isPost) {
            $orderId = Yii::$app->request->post('orderId');
            $status = Yii::$app->request->post('status');
            $order = Order::findOne($orderId);

            if ($order && in_array($status, [
                    Order::STATUS_PENDING,
                    Order::STATUS_IN_PROGRESS,
                    Order::STATUS_REJECTED,
                    Order::STATUS_COMPLETED,
                ])) {
                $order->status = $status;
                if ($order->save()) {
                    Yii::$app->session->setFlash('success', 'Статус заказа обновлён.');
                } else {
                    Yii::$app->session->setFlash('error', 'Не удалось обновить статус заказа.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Некорректный заказ или статус.');
            }
        }

        return $this->redirect(['site/manage-orders']);
    }

    // In ProductController.php
    public function actionView($id)
    {
        $texno = Texno::findOne($id); // Assuming your model is Product
        return $this->render('view', [
            'texno' => $texno,
        ]);
    }





    public function actionCreate()
    {
        $model = new Texno();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('admin', [
            'model' => $model,
            'action' => 'create',
        ]);
    }

    public function actionUpdatee($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('admin', [
            'model' => $model,
            'action' => 'updatee',
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Texno::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
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
