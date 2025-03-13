<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "photo_portfolio".
 *
 * @property int $id
 * @property int $photographer_id
 * @property string $photo_url
 * @property string $created_at
 * @property int $type_id
 *
 * @property Photographer $photographer
 * @property Type $type
 */
class PhotoPortfolio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'photo_portfolio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['photographer_id', 'photo_url', 'type_id'], 'required'],
            [['photographer_id', 'type_id'], 'integer'],
            [['created_at'], 'safe'],
            [['photo_url'], 'string', 'max' => 255],
            [['photographer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Photographer::class, 'targetAttribute' => ['photographer_id' => 'id']],
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
            'photographer_id' => 'Photographer ID',
            'photo_url' => 'Photo Url',
            'created_at' => 'Created At',
            'type_id' => 'Type ID',
        ];
    }

    /**
     * Gets query for [[Photographer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhotographer()
    {
        return $this->hasOne(Photographer::class, ['id' => 'photographer_id']);
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
