<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;

class RegisterForm extends Model
{
    public string $email = '';
    public $city_id;
    public string $password = '';
    public string $password_repeat = '';

    public function rules()
    {
        return [
            [['email', 'city_id', 'password', 'password_repeat'], 'required'],
            [[ 'email', 'password', 'password_repeat'], 'string', 'max' => 255],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::class],
            ['password', 'match', 'pattern' => '/^.{8,}$/i'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'city_id' => 'Город',
            'password' => 'Пароль',
            'password_repeat' => 'Повторение пароля',
        ];
    }

    public function register(): object|bool 
    {
        if ($this->validate()) {
            $user = new User();

            $user->load($this->attributes, '');
            $user->role_id = Role::getRoleId('user');
            $user->password = Yii::$app->security->generatePasswordHash($this->password);
            $user->auth_key = Yii::$app->security->generateRandomString();

            if (! $user->save()) {
                VarDumper::dump($user->errors, 10, true); die;
            }
        }
        return $user ?? false;
    }

}