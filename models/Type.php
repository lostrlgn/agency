<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "type".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $price
 *
 * @property Application[] $applications
 * @property PhotoPortfolio[] $photoPortfolios
 * @property PhotographerTypes[] $photographerTypes
 * @property TypeImages[] $typeImages
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'price'], 'required'],
            [['description'], 'string'],
            [['price'], 'integer'],
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
            'description' => 'Description',
            'price' => 'Price',
        ];
    }

    /**
     * Gets query for [[Applications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplications()
    {
        return $this->hasMany(Application::class, ['type_id' => 'id']);
    }

    /**
     * Gets query for [[PhotoPortfolios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoPortfolios()
    {
        return $this->hasMany(PhotoPortfolio::class, ['type_id' => 'id']);
    }

    /**
     * Gets query for [[PhotographerTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhotographerTypes()
    {
        return $this->hasMany(PhotographerTypes::class, ['type_id' => 'id']);
    }

    /**
     * Gets query for [[TypeImages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTypeImages()
    {
        return $this->hasMany(TypeImages::class, ['type_id' => 'id']);
    }

    public function getApplicationPhotographers()
    {
        return $this->hasMany(ApplicationPhotographer::class, ['type_id' => 'id']);
    }

    public static function getTypes()
    {
        return self::find()
        ->select('title')
        ->indexBy('id')
        ->column();
    }
    public static function getPhotoType($user_id)
    {
        $photo_id = PhotographerTypes::getTypePhoto($user_id);
        $str = '';
        foreach ($photo_id as $val) {
            $result = self::findOne(['id' => $val])->title;
            $str .= $result;
        }
        return $str;
    }

}
