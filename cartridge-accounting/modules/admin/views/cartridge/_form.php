<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Cartridge $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cartridge-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cartridge_id')->textInput() ?>
    <?= $form->field($model, 'price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
