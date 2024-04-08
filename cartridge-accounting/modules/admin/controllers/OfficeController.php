<?php

namespace app\modules\admin\controllers;

use app\models\Cartridge;
use app\models\Office;
use app\models\OfficeSearch;
use app\models\Printer;
use app\models\User;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OfficeController implements the CRUD actions for Office model.
 */
class OfficeController extends Controller
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
     * Lists all Office models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OfficeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Office model.
     * @param int $office_id Office ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($office_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($office_id),
        ]);
    }

    /**
     * Creates a new Office model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Office();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'office_id' => $model->office_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Office model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $office_id Office ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($office_id)
    {
        $model = $this->findModel($office_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'office_id' => $model->office_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Office model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $office_id Office ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($office_id)
    {
        $this->findModel($office_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Office model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $office_id Office ID
     * @return Office the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($office_id)
    {
        if (($model = Office::findOne(['office_id' => $office_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAddPrinter($office_id)
    {
        $office = Office::findOne($office_id);
        $related_printers = [];
        $all_printers = Printer::find()->asArray()->all();

        if ($office) {
            $related_printers = $office->getPrinters();
        }

        $all_printers = ArrayHelper::map($all_printers, 'printer_id', 'printer_id');

        if (Yii::$app->request->isPost) {
            $printerIDS = Yii::$app->request->post('printers');
            $office->addPrinters($printerIDS);
            return $this->redirect(['view', 'office_id'=>$office->office_id]);
        }
        return $this->render('office_printers', [
            'related_printers' => $related_printers,
            'all_printers' => $all_printers
        ]);
    }

    public function actionAddUser($office_id)
    {
        $office = Office::findOne($office_id);
        $related_users = [];
        $all_users = User::find()->asArray()->all();

        if ($office) {
            $related_users = $office->getUsers();
        }

        $all_users = ArrayHelper::map($all_users, 'user_id', 'firstname');

        if (Yii::$app->request->isPost) {
            $userIDS = Yii::$app->request->post('users');
            $office->addUsers($userIDS);
            return $this->redirect(['view', 'office_id'=>$office->office_id]);
        }
        return $this->render('office_users', [
            'related_users' => $related_users,
            'all_users' => $all_users
        ]);
    }
}
