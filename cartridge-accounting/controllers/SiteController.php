<?php

namespace app\controllers;

use app\models\Cartridge;
use app\models\CartridgePrinterRelation;
use app\models\Office;
use app\models\OfficeUserRelation;
use app\models\Order;
use app\models\Printer;
use app\models\PrinterOfficeRelation;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

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
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            if (isset(Yii::$app->user->identity->user_id)) {
                // если пользователь авторизован но не админ
                return $this->redirect('site/accounting');
            } else {
                return $this->render('quest');
            }
        } else {
            return $this->redirect('site/accounting');
        }
    }
    public function actionAccounting() {

        $user = User::find()->where(['user_id' => Yii::$app->user->identity->user_id])->one();

        $officeUserRelation = OfficeUserRelation::find()->where(['user_id' => Yii::$app->user->identity->user_id])->one();

        $office = Office::find()->where(['office_id' => $officeUserRelation->office_id])->one();

        $printersOfficeRelation = PrinterOfficeRelation::find()->where(['office_id' => $office->office_id])->all();

        $printerIds = [];

        foreach ($printersOfficeRelation as $relation) {
            $printerIds[] = $relation->printer_id;
        }

        $printers = Printer::find()->where(['printer_id' => $printerIds])->all();

        return $this->render('accounting', [
            'user' => $user,
            'office' => $office,
            'printers' => $printers

        ]);

    }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin(): Response|string
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->render('index');
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionPrinter($printer_id)
    {

        $cartridge_printer = CartridgePrinterRelation::find()->where(['printer_id' => $printer_id])->one();
        $cartridge = Cartridge::find()->where(['cartridge_id' => $cartridge_printer->cartridge_id])->one();

        $office_printer = PrinterOfficeRelation::find()->where(['printer_id' => $printer_id])->one();
        $office = Office::find()->where(['office_id' => $office_printer->office_id])->one();

        $is_refilled = Order::find()->where(['cartridge_id' => $cartridge->cartridge_id])->one();

        return $this->render('printer', [
            'printer' => $printer_id,
            'cartridge' => $cartridge->cartridge_id,
            'price' => $cartridge->price,
            'office_id' => $office->office_id,
            'is_refilled' => $is_refilled
        ]);
    }

    public function actionOrder($office_id, $printer_id, $cartridge_id, $price)
    {
        $order = new Order();
        $order->office_id = $office_id;
        $order->cartridge_id = $cartridge_id;
        $order->printer_id = $printer_id;
        $order->price = $price;

        if(!$order->save()) {
            print_r('error'); exit;
        }

        return $this->redirect('accounting');
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
