<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

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
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    public static function findByUsername($username)
    {
        return User::find()->where(['login' => $username])->one();
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

    public static function findIdentity($id)
    {
        return User::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function getId()
    {
        return $this->user_id;
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    public function validatePassword($password, $role = 0): bool
    {
        return $this->password == $password;
    }
}
