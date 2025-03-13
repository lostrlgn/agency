<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "status_reception".
 *
 * @property int $id
 * @property string $title
 *
 * @property ApplicationPhotographer[] $applicationPhotographers
 */
class StatusReception extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status_reception';
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
     * Gets query for [[ApplicationPhotographers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplicationPhotographers()
    {
        return $this->hasMany(ApplicationPhotographer::class, ['status_reception_id' => 'id']);
    }

    public static function getStatusId($status)
    {
        return self::findOne(['title' => $status])->id;
    }
}
