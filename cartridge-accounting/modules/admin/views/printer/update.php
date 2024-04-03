<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Printer $model */

$this->title = 'Update Printer: ' . $model->printer_id;
$this->params['breadcrumbs'][] = ['label' => 'Printers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->printer_id, 'url' => ['view', 'printer_id' => $model->printer_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="printer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
