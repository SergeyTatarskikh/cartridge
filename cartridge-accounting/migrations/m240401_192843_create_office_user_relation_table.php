<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%office_user_relation}}`.
 */
class m240401_192843_create_office_user_relation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%office_user_relation}}', [
            'id_relation_OU' => $this->primaryKey(),
            'office_id' => $this->integer(),
            'user_id'  => $this->integer()
        ]);

        $this->addForeignKey(
            'fk_office_user_relation_office',
            '{{%office_user_relation}}',
            'office_id',
            '{{%office}}',
            'office_id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_office_user_relation_user',
            '{{%office_user_relation}}',
            'user_id',
            '{{%user}}',
            'user_id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%office_user_relation}}');
    }
}
