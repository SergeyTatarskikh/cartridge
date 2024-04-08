<?php

namespace app\modules\admin\controllers;

use app\models\LoginForm;
use app\models\Order;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    public function actionIndex()
    {
        $order = Order::find()->asArray()->all();
        $total_price = 0;
        foreach ($order as $item) {
            $total_price += $item['price'];
        }
        return $this->render('index', [
            'order' => $order,
            'total_price' => $total_price
        ]);
    }

    public function actionTake()
    {
        Order::deleteAll();
        return $this->redirect('index');
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
