<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">
        <p><strong>Имя:</strong> <?php print_r($user->name); ?></p>
        <p><strong>Фамилия:</strong> <?php print_r($user->firstname); ?></p>
        <p><strong>Офис:</strong>  <?php print_r($office->office_id); ?></p>
        <p><strong>Доступные принтеры:</strong></p>
        <ul>
            <?php foreach ($printers as $printer) { ?>
                <li>
                    Номер принтера -
                    <a href="<?= Yii::$app->urlManager->createUrl(['site/printer', 'printer_id' => $printer->printer_id]) ?>">
                        <?php print_r($printer->printer_id); ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>


