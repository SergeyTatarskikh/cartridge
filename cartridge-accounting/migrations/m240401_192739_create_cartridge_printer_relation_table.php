<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cartridge_printer_relation}}`.
 */
class m240401_192739_create_cartridge_printer_relation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cartridge_printer_relation}}', [
            'id_relation_CP' => $this->primaryKey(),
            'cartridge_id' => $this->integer(),
            'printer_id'  => $this->integer()
        ]);

        $this->addForeignKey(
            'fk_cartridge_printer_relation_cartridge',
            '{{%cartridge_printer_relation}}',
            'cartridge_id',
            '{{%cartridge}}',
            'cartridge_id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_cartridge_printer_relation_printer',
            '{{%cartridge_printer_relation}}',
            'printer_id',
            '{{%printer}}',
            'printer_id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cartridge_printer_relation}}');
    }
}
