<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cartridge}}`.
 */
class m240401_192115_create_cartridge_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cartridge}}', [
            'cartridge_id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cartridge}}');
    }
}
