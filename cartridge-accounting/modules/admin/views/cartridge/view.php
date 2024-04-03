<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Cartridge $model */

$this->title = $model->cartridge_id;
$this->params['breadcrumbs'][] = ['label' => 'Cartridges', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cartridge-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'cartridge_id' => $model->cartridge_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'cartridge_id' => $model->cartridge_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cartridge_id',
        ],
    ]) ?>

</div>
