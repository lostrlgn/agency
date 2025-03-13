<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "position".
 *
 * @property int $id
 * @property string $title
 *
 * @property Photographer[] $photographers
 */
class Position extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'position';
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
        return $this->hasMany(Photographer::class, ['position_id' => 'id']);
    }

    public static function getPositionId($position)
    {
        return self::findOne(['title' => $position])->id;
    }
}
