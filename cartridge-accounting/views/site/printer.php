<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">
        Номер принтера: <?php print_r($printer); ?><br>
        Номер картриджа: <?php print_r($cartridge); ?><br>
        Цена заправки: <?php print_r($price); ?><br>
        <?php if (!$is_refilled) {?>
            <a href="<?= Yii::$app->urlManager->createUrl(['site/order',
                'printer_id' => $printer,
                'office_id' => $office_id,
                'price' => $price,
                'cartridge_id' => $cartridge,
            ])
            ?>">

        Отправить заявку на заправку
        </a>
        <?php } else { ?>
            <p>Заявка на заправку отправлена</p>
        <?php } ?>
        <a href="addorder"></a>
    </div>
</div>

