<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application".
 *
 * @property int $id
 * @property int $user_id
 * @property string $created_at
 * @property string|null $comment_admin
 * @property int $status_id
 * @property int|null $photographer_id
 * @property int|null $type_id
 * @property string|null $comment
 * @property string|null $description
 * @property int $days_shoot
 * @property string $booking_date
 * @property string $phone
 * @property int $pay_type_id
 * @property string $booking_time
 * @property string|null $link_photos
 *
 * @property PayType $payType
 * @property Photographer $photographer
 * @property Status $status
 * @property Type $type
 * @property User $user
 */
class Application extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'status_id', 'days_shoot', 'booking_date', 'phone', 'pay_type_id', 'booking_time'], 'required'],
            [['user_id', 'status_id', 'photographer_id', 'type_id', 'days_shoot', 'pay_type_id'], 'integer'],
            [['created_at', 'booking_date', 'booking_time'], 'safe'],
            [['comment_admin', 'comment', 'description', 'phone', 'link_photos'], 'string', 'max' => 255],
            [['pay_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => PayType::class, 'targetAttribute' => ['pay_type_id' => 'id']],
            [['photographer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Photographer::class, 'targetAttribute' => ['photographer_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
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
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'comment_admin' => 'Comment Admin',
            'status_id' => 'Status ID',
            'photographer_id' => 'Photographer ID',
            'type_id' => 'Type ID',
            'comment' => 'Comment',
            'description' => 'Description',
            'days_shoot' => 'Days Shoot',
            'booking_date' => 'Booking Date',
            'phone' => 'Phone',
            'pay_type_id' => 'Pay Type ID',
            'booking_time' => 'Booking Time',
            'link_photos' => 'Link Photos',
        ];
    }

    /**
     * Gets query for [[PayType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayType()
    {
        return $this->hasOne(PayType::class, ['id' => 'pay_type_id']);
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
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
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

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
