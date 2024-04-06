<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<style>
    .form-control label {
        display: block;
        margin-left: 10px;
    }

</style>

<div class="printer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::checkboxList('printers', $related_printers, $all_printers, ['class'=>'form-control', 'multiple'=>true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>