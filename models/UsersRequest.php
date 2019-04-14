<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Class UsersRequest
 * @package app\models
 *
 * @property Users $user
 * @property int $id [int(11)]
 * @property int $user_id [int(11)]
 * @property string $request [varchar(255)]
 * @property string $response [varchar(255)]
 * @property int $created_at [timestamp]
 */
class UsersRequest extends ActiveRecord
{

    /**
     * @inheritDoc
     * @return string
     */
    public static function tableName(): string
    {
        return 'users_request';
    }

    /**
     * @inheritDoc
     * @return array
     */
    public function rules(): array
    {
        return [
            [['user_id', 'request', 'response'], 'required'],
            [['user_id', 'id'], 'integer'],
            [['response', 'request'], 'string']
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
            'user_id' => 'Пользователь',
            'request' => 'Запрос',
            'response' => 'Ответ',
            'created_at' => 'Дата создания',
            'user' => 'Пользователь',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

}