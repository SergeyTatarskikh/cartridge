<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Office $model */

$this->title = 'Update Office: ' . $model->office_id;
$this->params['breadcrumbs'][] = ['label' => 'Offices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->office_id, 'url' => ['view', 'office_id' => $model->office_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="office-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
