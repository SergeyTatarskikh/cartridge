<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%printer_office_relation}}`.
 */
class m240401_192810_create_printer_office_relation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%printer_office_relation}}', [
            'id_relation_PO' => $this->primaryKey(),
            'printer_id' => $this->integer(),
            'office_id'  => $this->integer()
        ]);

        $this->addForeignKey(
            'fk_printer_office_relation_printer',
            '{{%printer_office_relation}}',
            'printer_id',
            '{{%printer}}',
            'printer_id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_printer_office_relation_office',
            '{{%printer_office_relation}}',
            'office_id',
            '{{%office}}',
            'office_id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%printer_office_relation}}');
    }
}
