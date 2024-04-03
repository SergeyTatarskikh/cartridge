<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $user_id
 * @property string $name
 * @property string $firstname
 * @property string $login
 * @property string $password
 * @property int $role
 *
 * @property OfficeUserRelation[] $officeUserRelations
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'firstname', 'login', 'password', 'role'], 'required'],
            [['role'], 'integer'],
            [['name', 'firstname', 'login', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'name' => 'Name',
            'firstname' => 'Firstname',
            'login' => 'Login',
            'password' => 'Password',
            'role' => 'Role',
        ];
    }

    /**
     * Gets query for [[OfficeUserRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOfficeUserRelations()
    {
        return $this->hasMany(OfficeUserRelation::class, ['user_id' => 'user_id']);
    }
}
