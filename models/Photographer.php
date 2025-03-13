<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "photographer".
 *
 * @property int $id
 * @property int $user_id
 * @property string $portfolio_url
 * @property int $payment
 * @property string|null $description
 * @property int $position_id
 * @property int $city_id
 *
 * @property Application[] $applications
 * @property City $city
 * @property PhotoPortfolio[] $photoPortfolios
 * @property PhotographerTypes[] $photographerTypes
 * @property Position $position
 * @property User $user
 */
class Photographer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'photographer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'portfolio_url', 'work_experience', 'payment', 'position_id', 'city_id'], 'required'],
            [['user_id', 'work_experience', 'payment', 'position_id', 'city_id'], 'integer'],
            [['description'], 'string'],
            [['portfolio_url', 'comment_admin'], 'string', 'max' => 255],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => Position::class, 'targetAttribute' => ['position_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']],
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
            'portfolio_url' => 'Portfolio Url',
            'work_experience' => 'Work Experience',
            'payment' => 'Payment',
            'description' => 'Description',
            'position_id' => 'Position ID',
            'comment_admin' => 'Comment Admin',
            'city_id' => 'City ID',
        ];
    }

    /**
     * Gets query for [[Applications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplications()
    {
        return $this->hasMany(Application::class, ['photographer_id' => 'id']);
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
     * Gets query for [[PhotoPortfolios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoPortfolios()
    {
        return $this->hasMany(PhotoPortfolio::class, ['photographer_id' => 'id']);
    }

    /**
     * Gets query for [[PhotographerTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhotographerTypes()
    {
        return $this->hasMany(PhotographerTypes::class, ['photograpger_id' => 'id']);
    }

    /**
     * Gets query for [[Position]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(Position::class, ['id' => 'position_id']);
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
