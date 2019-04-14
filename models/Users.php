<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Class User
 * @package app\models
 * @property int $id [int(11)]
 * @property string $username [varchar(255)]
 * @property string $password [varchar(255)]
 * @property string $auth_key [varchar(255)]
 * @property string $access_token [varchar(255)]
 * @property string|mixed $authKey
 * @property null|string $accessToken
 * @property int $created_at [timestamp]
 */
class Users extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritDoc
     * @return string
     */
    public static function tableName(): string
    {
        return 'users';
    }

    /**
     * @inheritDoc
     * @return array
     */
    public function rules(): array
    {
        return [
            [['username', 'password'], 'required'],
            [['id'], 'integer'],
            [['username', 'password', 'auth_key', 'access_token', 'created_at'], 'string']
        ];
    }


    /**
     * @inheritDoc
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'username' => 'Имя пользователя',
            'password' => 'Пароль',
            'access_token' => 'Ключ доступа',
            'auth_key' => 'Ключ авторизации',
            'created_at' => 'Дата создания',
        ];
    }

    /**
     * @inheritDoc
     * @param int|string $id
     * @return static|IdentityInterface|null
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritDoc
     * @param mixed $token
     * @param null $type
     * @return static|IdentityInterface|null
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Find user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername(string $username): ?self
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * @inheritDoc
     * @return int|mixed|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     * @return mixed|string
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @return string|null
     */
    public function getAccessToken (): ?string
    {
        return  $this->access_token;
    }

    /**
     * @inheritDoc
     * @param string $token
     * @return bool
     */
    public function validateAuthKey($token): bool
    {
        return $this->getAuthKey() === $token;
    }

    /**
     * @param string $token
     * @return bool
     */
    public function validateAccessToken(string $token): bool
    {
        return $this->getAuthKey() === $token;
    }
}
