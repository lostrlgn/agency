<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "type_images".
 *
 * @property int $id
 * @property int $type_id
 * @property string $photo_url
 *
 * @property Type $type
 */
class TypeImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'type_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_id', 'photo_url'], 'required'],
            [['type_id'], 'integer'],
            [['photo_url'], 'string', 'max' => 255],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::class, 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_id' => 'Type ID',
            'photo_url' => 'Photo Url',
        ];
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::class, ['id' => 'type_id']);
    }
}
