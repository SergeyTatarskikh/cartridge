<?php

use app\models\Printer;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\PrinterSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Printers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="printer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Printer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'printer_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Printer $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'printer_id' => $model->printer_id]);
                 }
            ],
        ],
    ]); ?>


</div>
