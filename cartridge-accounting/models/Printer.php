<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "printer".
 *
 * @property int $printer_id
 *
 * @property CartridgePrinterRelation[] $cartridgePrinterRelations
 * @property PrinterOfficeRelation[] $printerOfficeRelations
 */
class Printer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'printer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'printer_id' => 'Printer ID',
        ];
    }

    /**
     * Gets query for [[CartridgePrinterRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCartridgePrinterRelations()
    {
        return $this->hasMany(CartridgePrinterRelation::class, ['printer_id' => 'printer_id']);
    }

    /**
     * Gets query for [[PrinterOfficeRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrinterOfficeRelations()
    {
        return $this->hasMany(PrinterOfficeRelation::class, ['printer_id' => 'printer_id']);
    }
}
