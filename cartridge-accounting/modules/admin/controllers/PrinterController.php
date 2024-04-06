<?php

namespace app\modules\admin\controllers;

use app\models\Cartridge;
use app\models\CartridgePrinterRelation;
use app\models\Printer;
use app\modelsPrinterSearch;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PrinterController implements the CRUD actions for Printer model.
 */
class PrinterController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Printer models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new modelsPrinterSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Printer model.
     * @param int $printer_id Printer ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($printer_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($printer_id),
        ]);
    }

    /**
     * Creates a new Printer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Printer();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'printer_id' => $model->printer_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Printer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $printer_id Printer ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($printer_id)
    {
        $model = $this->findModel($printer_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'printer_id' => $model->printer_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Printer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $printer_id Printer ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($printer_id)
    {
        $this->findModel($printer_id)->delete();

        return $this->redirect(['index']);
    }

    public function actionAddCartridge($printer_id)
    {
        $printer = Printer::findOne($printer_id);
        $related_cartridges = [];
        $all_cartridges = Cartridge::find()->asArray()->all();

        if ($printer) {
            $related_cartridges = $printer->getCartridges();
        }

        $all_cartridges = ArrayHelper::map($all_cartridges, 'cartridge_id', 'cartridge_id');

        if (Yii::$app->request->isPost) {
            $cartridgeIDS = Yii::$app->request->post('cartridges');
            $printer->addCartridges($cartridgeIDS);
            return $this->redirect(['view', 'printer_id'=>$printer->printer_id]);
        }
        return $this->render('printer_cartridges', [
            'related_cartridges' => $related_cartridges,
            'all_cartridges' => $all_cartridges
        ]);
    }

    /**
     * Finds the Printer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $printer_id Printer ID
     * @return Printer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($printer_id)
    {
        if (($model = Printer::findOne(['printer_id' => $printer_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
