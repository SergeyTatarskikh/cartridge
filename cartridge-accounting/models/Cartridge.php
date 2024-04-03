<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cartridge".
 *
 * @property int $cartridge_id
 *
 * @property CartridgePrinterRelation[] $cartridgePrinterRelations
 */
class Cartridge extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cartridge';
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
            'cartridge_id' => 'Cartridge ID',
        ];
    }

    /**
     * Gets query for [[CartridgePrinterRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCartridgePrinterRelations()
    {
        return $this->hasMany(CartridgePrinterRelation::class, ['cartridge_id' => 'cartridge_id']);
    }
}
