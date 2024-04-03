<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Cartridge $model */

$this->title = 'Update Cartridge: ' . $model->cartridge_id;
$this->params['breadcrumbs'][] = ['label' => 'Cartridges', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cartridge_id, 'url' => ['view', 'cartridge_id' => $model->cartridge_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cartridge-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
