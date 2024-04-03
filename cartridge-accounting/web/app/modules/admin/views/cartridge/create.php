<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Cartridge $model */

$this->title = 'Create Cartridge';
$this->params['breadcrumbs'][] = ['label' => 'Cartridges', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cartridge-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
