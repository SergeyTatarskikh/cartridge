<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Printer $model */

$this->title = $model->printer_id;
$this->params['breadcrumbs'][] = ['label' => 'Printers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="printer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'printer_id' => $model->printer_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Добавить картридж', ['add-cartridge', 'printer_id' => $model->printer_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'printer_id' => $model->printer_id], [
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
            'printer_id',
        ],
    ]) ?>

</div>
