<?php

use app\models\Cartridge;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\CartridgeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Cartridges';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cartridge-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cartridge', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'price',

            'cartridge_id',
            [
                'class' => ActionColumn::className(),

                'urlCreator' => function ($action, Cartridge $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'cartridge_id' => $model->cartridge_id]);
                 }
            ],


        ],
    ]); ?>


</div>
