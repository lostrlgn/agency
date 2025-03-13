<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;

class RegisterExpert extends Model
{

    public $work_experience;
    public string $description = '';
    public $payment;
    public string $portfolio_url = '';
    public $city_id;
    public $type_id;

    public function rules()
    {
        return [
            [['work_experience', 'description', 'payment', 'portfolio_url', 'city_id', 'type_id'], 'required'],
            [[ 'work_experience', 'payment', 'city_id', 'type_id'], 'integer'],
            [['description', 'portfolio_url'], 'string', 'max' => 255],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'work_experience' => 'Укажите опыт работы в годах',
            'description' => 'Опишите опыт работы',
            'payment' => 'Оплата в час',
            'portfolio_url' => 'Ссылка на портфолио',
            'city_id' => 'В каком городе будете рабоать',
            'type_id' => 'Укажите вид съемки'
        ];
    }

    public function register(): object|bool 
    {
        if ($this->validate()) {
            $user = new ApplicationPhotographer();

            $user->attributes = $this->attributes;
            $user->status_reception_id = StatusReception::getStatusId('Новая');
            $user->user_id = Yii::$app->user->id;
            if (! $user->save()) {
                VarDumper::dump($user->errors, 10, true);
            }
        } else {
            VarDumper::dump($this->errors, 10, true); die;

        }
        return $user ?? false;
    }

}