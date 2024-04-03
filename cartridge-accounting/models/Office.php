<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "office".
 *
 * @property int $office_id
 *
 * @property OfficeUserRelation[] $officeUserRelations
 * @property PrinterOfficeRelation[] $printerOfficeRelations
 */
class Office extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'office';
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
            'office_id' => 'Office ID',
        ];
    }

    /**
     * Gets query for [[OfficeUserRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOfficeUserRelations()
    {
        return $this->hasMany(OfficeUserRelation::class, ['office_id' => 'office_id']);
    }

    /**
     * Gets query for [[PrinterOfficeRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrinterOfficeRelations()
    {
        return $this->hasMany(PrinterOfficeRelation::class, ['office_id' => 'office_id']);
    }
}
