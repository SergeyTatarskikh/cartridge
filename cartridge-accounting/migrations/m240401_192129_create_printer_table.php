<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%printer}}`.
 */
class m240401_192129_create_printer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%printer}}', [
            'printer_id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%printer}}');
    }
}
