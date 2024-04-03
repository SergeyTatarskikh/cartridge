<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Printer $model */

$this->title = 'Create Printer';
$this->params['breadcrumbs'][] = ['label' => 'Printers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="printer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
