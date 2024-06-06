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
        return $this->render('cart', ['cart' => $cart]);
    }


    public function actionCheckout()
    {
        $request = Yii::$app->request;

        if ($request->isPost) {
            $name = $request->post('name');
            $phone = $request->post('phone');
            $address = $request->post('address');
            $cart = Yii::$app->cart;
            $userId = Yii::$app->user->id;

            // Save order to database
            $order = new Order();
            $order->user_id = $userId;
            $order->name = $name;
            $order->phone = $phone;
            $order->address = $address;
            $order->total = $cart->getTotal();
            $order->created_at = date('Y-m-d H:i:s');

            if ($order->save()) {
                Yii::info("Order saved successfully with ID: {$order->id}");

                foreach ($cart->getItems() as $item) {
                    Yii::info("Processing cart item: " . print_r($item, true));

                    if (isset($item['id']) && isset($item['nazvan']) && isset($item['cena']) && isset($item['quantity'])) {
                        $orderItem = new OrderItem();
                        $orderItem->order_id = $order->id;
                        $orderItem->product_id = $item['id'];
                        $orderItem->product_name = $item['nazvan'];
                        $orderItem->price = $item['cena'];
                        $orderItem->quantity = $item['quantity'];

                        if ($orderItem->save()) {
                            Yii::info("Order item saved successfully: " . print_r($orderItem->attributes, true));
                        } else {
                            Yii::error("Failed to save order item: " . print_r($orderItem->errors, true));
                        }
                    } else {
                        Yii::error("Invalid cart item structure: " . print_r($item, true));
                    }
                }

                // Clear the cart
                $cart->clear();

                // Redirect to a confirmation page
                return $this->redirect(['site/order-confirmation']);
            } else {
                Yii::$app->session->setFlash('error', 'Произошла ошибка при оформлении заказа.');
                Yii::error("Failed to save order: " . print_r($order->errors, true));
            }
        }

        return $this->redirect(['site/cart']);
    }

    public function actionOrderConfirmation()
    {
        return $this->render('order-confirmation');
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
