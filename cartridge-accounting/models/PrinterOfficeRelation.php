<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "printer_office_relation".
 *
 * @property int $id_relation_PO
 * @property int|null $printer_id
 * @property int|null $office_id
 *
 * @property Office $office
 * @property Printer $printer
 */
class PrinterOfficeRelation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'printer_office_relation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['printer_id', 'office_id'], 'integer'],
            [['office_id'], 'exist', 'skipOnError' => true, 'targetClass' => Office::class, 'targetAttribute' => ['office_id' => 'office_id']],
            [['printer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Printer::class, 'targetAttribute' => ['printer_id' => 'printer_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_relation_PO' => 'Id Relation Po',
            'printer_id' => 'Printer ID',
            'office_id' => 'Office ID',
        ];
    }

    /**
     * Gets query for [[Office]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOffice()
    {
        return $this->hasOne(Office::class, ['office_id' => 'office_id']);
    }

    /**
     * Gets query for [[Printer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrinter()
    {
        return $this->hasOne(Printer::class, ['printer_id' => 'printer_id']);
    }
}
