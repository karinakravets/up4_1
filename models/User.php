<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id_user
 * @property string $name
 * @property string|null $surname
 * @property string $patronymic
 * @property string $login
 * @property string $email
 * @property string $password
 * @property int $role
 *
 * @property Cart[] $carts
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'username', 'email', 'password', 'id_role'], 'required'],
            [['id_role'], 'integer'],
            [['name', 'surname', 'patronymic', 'username', 'email', 'password'], 'string', 'max' => 255],
            [['username', 'email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Айди пользователя',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'username' => 'Логин',
            'email' => 'Электронная почта',
            'password' => 'Пароль',
            'id_role' => 'Роль',
        ];
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::class, ['id_user' => 'id_user']);
    }

 public static function findIdentity($id)
 {
 return static::findOne($id);
 }
 public function isAdmin()
    {
    if(Yii::$app->user->identity->id_role == 1)
    {    
    return false;
    }
    else{
    return true;
    }
    } 
 public static function findIdentityByAccessToken($token, $type = null)
 {
 return static::findOne(['access_token' => $token]);
 }
 public function getId()
 {
 return $this->id_user;
 }
 public function getAuthKey()
 {
 return ;
 }
 public function validateAuthKey($authKey)
 {
 return ;
 }
 public function validatePassword($password){
 return $this->password==$password;
 }
 public static function findByUsername($login){
 return self::find()->where(['username'=> $login])->one();
 }

}