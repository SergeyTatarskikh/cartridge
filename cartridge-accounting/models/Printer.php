<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

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
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getCartridges()
    {
        $cartridges = $this->hasMany(CartridgePrinterRelation::class, ['printer_id' => 'printer_id']);
        $cartridges_ids = $cartridges->select('cartridge_id')->asArray()->all();

        return ArrayHelper::map($cartridges_ids, 'cartridge_id', 'cartridge_id');
    }

    public function addCartridges($cartridgeIds) {

        $this->clearCurrentCartridges();
        foreach($cartridgeIds as $cartridgeId) {

            $cartridge = Cartridge::findOne($cartridgeId);

            $relation = new CartridgePrinterRelation();

            $relation->cartridge_id = $cartridge->cartridge_id;
            $relation->printer_id = $this->printer_id;

            if(!$relation->save()) {
                print_r('error'); exit;
            }
        }
    }

    private function clearCurrentCartridges(): void
    {
        CartridgePrinterRelation::deleteAll(['printer_id' => $this->printer_id]);
    }

    /**
     * Gets query for [[PrinterOfficeRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOffices()
    {
        return $this->hasMany(PrinterOfficeRelation::class, ['printer_id' => 'printer_id']);
    }


}
