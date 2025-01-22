<?php

namespace app\models;

use app\models\User;
class RegForm extends User
{
 public $confirm_password;
 public $agree;
 public function rules()
 {
    return [
        [['name', 'surname', 'username', 'email', 'password', 'confirm_password', 'agree'], 'required'],
        [['id_role'], 'integer'],
        [['name', 'surname', 'patronymic', 'username', 'email', 'password'], 'string', 'max' => 255],
        [['name', 'surname', 'patronymic'], 'match', 'pattern' => '/^[а-яё\s\-]+$/iu', 'message'=> 'Кириллица (допустимы пробел, тире,)'],
        ['password', 'match', 'pattern' => '/^[A-Za-z0-9]{5,}$/', 'message'=> 'Используйте минимум 5 символов латинских букв и цифр'],
        ['email', 'email'],
        [['confirm_password'], 'compare', 'compareAttribute'=>'password', 'message'=>'Пароли
        должны совпадать'],
        [['agree'], 'compare', 'compareValue'=>true, 'message'=>''], 
        ['username', 'match', 'pattern' => '/^(?=.*[a-zA-Z])(?=.{3,})([a-zA-Z0-9-]*)$/i', 'message'=> 'Латиница,цифры,тире (минимум 3 символа)'],
        [['username', 'email'], 'unique'],
    ];
 }
 /**
 * {@inheritdoc}
 */
 public function attributeLabels()
 {
 return [
    'id_user' => 'ID пользователя',
    'name' => 'Имя',
    'surname' => 'Фамилия',
    'patronymic' => 'Отчество',
    'username' => 'Логин',
    'email' => 'Электронная почта',
    'password' => 'Пароль',
    'id_role' => 'Роль',
    'confirm_password' => 'Повторите пароль',
    'agree' => 'Подтвердите согласие на обработку персональных данных'
 ];
 }
} 

?>