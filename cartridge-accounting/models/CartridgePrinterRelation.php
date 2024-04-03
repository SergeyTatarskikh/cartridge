<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cartridge_printer_relation".
 *
 * @property int $id_relation_CP
 * @property int|null $cartridge_id
 * @property int|null $printer_id
 *
 * @property Cartridge $cartridge
 * @property Printer $printer
 */
class CartridgePrinterRelation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cartridge_printer_relation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cartridge_id', 'printer_id'], 'integer'],
            [['cartridge_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cartridge::class, 'targetAttribute' => ['cartridge_id' => 'cartridge_id']],
            [['printer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Printer::class, 'targetAttribute' => ['printer_id' => 'printer_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_relation_CP' => 'Id Relation Cp',
            'cartridge_id' => 'Cartridge ID',
            'printer_id' => 'Printer ID',
        ];
    }

    /**
     * Gets query for [[Cartridge]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCartridge()
    {
        return $this->hasOne(Cartridge::class, ['cartridge_id' => 'cartridge_id']);
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
