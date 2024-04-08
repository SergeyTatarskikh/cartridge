<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    th {
        background-color: #f2f2f2;
    }
</style>
<?php if (!empty($order)) {?>
<h1>Заказы</h1>
<table>
    <tr>
        <th>Принтер</th>
        <th>Картридж</th>
        <th>Офис</th>
        <th>Цена заправки</th>
    </tr>
    <?php foreach ($order as $item) { ?>
        <tr>
            <td><?php echo $item['printer_id']; ?></td>
            <td><?php echo $item['cartridge_id']; ?></td>
            <td><?php echo $item['office_id']; ?></td>
            <td><?php echo $item['price']; ?></td>
        </tr>
    <?php } ?>
</table>
<h2>Общая стоимость: <?php echo $total_price; ?> </h2>

    <a href="<?= Yii::$app->urlManager->createUrl('admin/default/take') ?>">Принять заказ</a>
<?php }  else { ?>
    <h1>Нет заказов</h1>
<?php }?>
