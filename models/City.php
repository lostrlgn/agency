<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property string $title
 *
 * @property Photographer[] $photographers
 * @property User[] $users
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[Photographers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhotographers()
    {
        return $this->hasMany(Photographer::class, ['city_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['city_id' => 'id']);
    }
    public static function getCityes()
    {
        return self::find()
        ->select('title')
        ->indexBy('id')
        ->column();
    }
}
