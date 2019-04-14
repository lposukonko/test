<?php

namespace app\controllers;

use app\helpers\ArraySortHelper;
use app\models\UsersRequest;
use Yii;
use yii\db\Exception;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\Controller;
use yii\web\HttpException;
use yii\web\Response;

/**
 * Controller for calculate sorting  array
 *
 * Class TaskController
 * @package app\controllers
 */
class TaskController extends Controller
{
    /**
     * @inheritDoc
     * @return array
     */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['verbFilter']['actions'] = [
            'calculate' => ['GET']
        ];

        $behaviors['contentNegotiator']['formats'] = [
            'application/json' => Response::FORMAT_JSON
        ];

        $behaviors['authenticator']['authMethods'] = [
            [
                'class' => QueryParamAuth::class,
                'tokenParam' => 'token'
            ],
            HttpBearerAuth::class
        ];

        return $behaviors;
    }

    /**
     * Action calculate array
     *
     * @param string $array
     * @param int $number
     * @return array
     * @throws Exception
     * @throws HttpException
     */
    public function actionCalculate(string $array, int $number): array
    {
        $preparedArray = json_decode($array, true);

        if ($preparedArray !== null && is_array($preparedArray) && $this->checkArray($preparedArray)) {

            $sorted = ArraySortHelper::run($number, $preparedArray);
            $request = [
                'type' => 'rest',
                'array' => $array,
                'number' => $number
            ];

            $userRequest = new UsersRequest([
                'user_id' => Yii::$app->user->id,
                'request' => json_encode($request),
                'response' => $sorted
            ]);

            if ($userRequest->validate() && $userRequest->save()) {
                return ['User' => Yii::$app->user->identity->username,'Answer' => $sorted];
            }

            throw new Exception(implode(': ', $userRequest->getErrors()), 400);
        }

        throw new HttpException(400, 'First parameter - $array, must be [1,23,45,6,7,8,9]. Second parameter $number, must be an integer');
    }

    /**
     * Check array
     *
     * @param array $array
     * @return bool
     */
    private function checkArray ( array $array): bool
    {
        foreach ($array as $item) {
            if (!is_int($item)) {
                return false;
            }
        }

        return true;
    }

}