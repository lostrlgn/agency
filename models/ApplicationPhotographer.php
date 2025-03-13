<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application_photographer".
 *
 * @property int $id
 * @property string|null $comment_admin
 * @property int $status_reception_id
 * @property int $work_experience
 * @property int $user_id
 * @property int $type_id
 * @property string $description
 * @property int $payment
 * @property string $portfolio_url
 * @property int $city_id
 *
 * @property City $city
 * @property StatusReception $statusReception
 * @property User $user
 */
class ApplicationPhotographer extends \yii\db\ActiveRecord
{
    const SCENARIO_CANCEL = 'cancel';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'application_photographer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'status_reception_id', 'work_experience', 'user_id', 'description', 'payment', 'portfolio_url', 'city_id', 'type_id'], 'required'],
            [['status_reception_id', 'work_experience', 'user_id', 'payment', 'city_id', 'type_id'], 'integer'],
            [['comment_admin', 'description', 'portfolio_url'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['status_reception_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusReception::class, 'targetAttribute' => ['status_reception_id' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']],
            ['comment_admin', 'required', 'on' => self::SCENARIO_CANCEL],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comment_admin' => 'Comment Admin',
            'status_reception_id' => 'Status Reception ID',
            'work_experience' => 'Work Experience',
            'user_id' => 'User ID',
            'description' => 'Description',
            'payment' => 'Payment',
            'portfolio_url' => 'Portfolio Url',
            'city_id' => 'City ID',
        ];
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    /**
     * Gets query for [[StatusReception]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatusReception()
    {
        return $this->hasOne(StatusReception::class, ['id' => 'status_reception_id']);
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
    public function getType()
    {
        return $this->hasOne(Type::class, ['id' => 'type_id']);
    }
}
