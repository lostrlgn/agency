<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "photographer_types".
 *
 * @property int $photograpger_id
 * @property int $type_id
 *
 * @property Photographer $photograpger
 * @property Type $type
 */
class PhotographerTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'photographer_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['photograpger_id', 'type_id'], 'required'],
            [['photograpger_id', 'type_id'], 'integer'],
            [['photograpger_id'], 'exist', 'skipOnError' => true, 'targetClass' => Photographer::class, 'targetAttribute' => ['photograpger_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::class, 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'photograpger_id' => 'Photograpger ID',
            'type_id' => 'Type ID',
        ];
    }

    /**
     * Gets query for [[Photograpger]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhotograpger()
    {
        return $this->hasOne(Photographer::class, ['id' => 'photograpger_id']);
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
