<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $surname
 * @property string|null $patronymic
 * @property string|null $date_birth
 * @property string $email
 * @property string|null $phone
 * @property int|null $gender_id
 * @property string|null $photo
 * @property int $city_id
 * @property int $role_id
 * @property string $auth_key
 * @property string $password
 *
 * @property Application[] $applications
 * @property City $city
 * @property Gender $gender
 * @property Photographer[] $photographers
 * @property Role $role
 */
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    const SCENARIO_UPDATE = 'update';
    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_birth'], 'safe'],
            [['email', 'city_id', 'role_id', 'auth_key', 'password'], 'required'],
            [['gender_id', 'city_id', 'role_id'], 'integer'],
            [['name', 'surname', 'patronymic', 'email', 'phone', 'photo', 'auth_key', 'password'], 'string', 'max' => 255],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']],
            [['gender_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gender::class, 'targetAttribute' => ['gender_id' => 'id']],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['role_id' => 'id']],
            ['phone', 'match', 'pattern' => '/^\+7\(\d{3}\)\-\d{3}\-\d{2}\-\d{2}$/'],
            [['name', 'surname', 'patronymic'], 'required', 'on' => self::SCENARIO_UPDATE],
            [['name', 'surname', 'patronymic'], 'match', 'pattern' => '/^[а-яА-ЯёЁ\-]+$/ui', 'message' => 'Только кириллические буквы и тире'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'date_birth' => 'Дата рождения',
            'email' => 'Email',
            'phone' => 'Телефон',
            'gender_id' => 'Пол',
            'photo' => 'Фото',
            'city_id' => 'Город',
            'role_id' => 'Role ID',
            'auth_key' => 'Auth Key',
            'password' => 'Пароль',
        ];
    }

    /**
     * Gets query for [[Applications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplications()
    {
        return $this->hasMany(Application::class, ['user_id' => 'id']);
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
     * Gets query for [[Gender]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGender()
    {
        return $this->hasOne(Gender::class, ['id' => 'gender_id']);
    }

    /**
     * Gets query for [[Photographers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhotographers()
    {
        return $this->hasMany(Photographer::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::class, ['id' => 'role_id']);
    }
     /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|null current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool|null if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    public static function findByUsername($email)
    {
        return self::findOne(['email' => $email]);
    }
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
    public function getIsAdmin()
    {
        return $this->role_id == Role::getRoleId('admin');
    }
    public function getIsUser()
    {
        return $this->role_id == Role::getRoleId('user');
    }
    public function getFio()
    {
        return $this->name . ' '  . $this->surname;
    }
    public function upload(): bool
    {
        // VarDumper::dump($this->imageFile, 10, true); die;
        
        $result = false;
        if ($this->validate()) {
            $result = true;
            $fileName = Yii::$app->user->id
            . '_'
            . Yii::$app->security->generateRandomString(10)
            . '.' 
            . $this->imageFile->extension; // Ошибка тут
        
            $this->imageFile->saveAs('pictures/' . $fileName);
            $this->photo = $fileName;
        }
        return $result;
    }
    
}
