<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Printer $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="printer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'printer_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
