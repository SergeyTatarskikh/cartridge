<?php

namespace app\modules\admin\controllers;

use app\models\Cartridge;
use app\modelsCartridgeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CartridgeController implements the CRUD actions for Cartridge model.
 */
class CartridgeController extends Controller
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
     * Lists all Cartridge models.
     *
     * @return string
     */
    public function actionIndex()
    {

        $searchModel = new modelsCartridgeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cartridge model.
     * @param int $cartridge_id Cartridge ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($cartridge_id)
    {

        return $this->render('view', [
            'model' => $this->findModel($cartridge_id),
        ]);
    }

    /**
     * Creates a new Cartridge model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Cartridge();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'cartridge_id' => $model->cartridge_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Cartridge model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $cartridge_id Cartridge ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($cartridge_id)
    {
        $model = $this->findModel($cartridge_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'cartridge_id' => $model->cartridge_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Cartridge model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $cartridge_id Cartridge ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($cartridge_id)
    {
        $this->findModel($cartridge_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cartridge model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $cartridge_id Cartridge ID
     * @return Cartridge the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($cartridge_id)
    {
        if (($model = Cartridge::findOne(['cartridge_id' => $cartridge_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
