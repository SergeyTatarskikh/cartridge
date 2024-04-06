<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

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
     * Gets query for [[PrinterOfficeRelations]].
     *
     * @return array
     */
    public function getPrinters()
    {
        $printers = $this->hasMany(PrinterOfficeRelation::class, ['office_id' => 'office_id']);
        $printers_ids = $printers->select('printer_id')->asArray()->all();

        return ArrayHelper::map($printers_ids, 'printer_id', 'printer_id');
    }

    public function addPrinters($printerIds) {

        $this->clearCurrentPrinters();
        foreach($printerIds as $printerId) {

            $printer = Printer::findOne($printerId);

            $relation = new PrinterOfficeRelation();

            $relation->printer_id = $printer->printer_id;
            $relation->office_id = $this->office_id;

            if(!$relation->save()) {
                print_r('error'); exit;
            }
        }
    }

    private function clearCurrentPrinters(): void
    {
        PrinterOfficeRelation::deleteAll(['office_id' => $this->office_id]);
    }

    public function getUsers()
    {
        $users = $this->hasMany(OfficeUserRelation::class, ['office_id' => 'office_id']);
        $users_ids = $users->select('user_id')->asArray()->all();

        return ArrayHelper::map($users_ids, 'user_id', 'user_id');
    }

    public function addUsers($userIds) {

        $this->clearCurrentUsers();

        foreach($userIds as $userId) {

            $user = User::findOne($userId);

            $relation = new OfficeUserRelation();

            $relation->user_id = $user->user_id;
            $relation->office_id = $this->office_id;

            if(!$relation->save()) {
                print_r('error'); exit;
            }
        }
    }

    private function clearCurrentUsers(): void
    {
        OfficeUserRelation::deleteAll(['office_id' => $this->office_id]);
    }
}
