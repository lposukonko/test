<?php

namespace app\commands;

use app\helpers\ArraySortHelper;
use app\models\Users;
use app\models\UsersRequest;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

/**
 * Controller for calculate sorting  array
 *
 * Class TaskController
 * @package app\commands
 */
class TaskController extends Controller
{

    /**
     * Action calculate array
     *
     * @param array $array
     * @param null|int $number
     * @param int $user_id
     * @return int
     */
    public function actionCalculate(array $array, int $number, $user_id = null): int
    {
        $preparedArray = array_map(function ($item){
            return (int) $item;
        }, $array);

        $sorted = ArraySortHelper::run($number, $preparedArray);

        if ($user_id) {
            $request = [
                'type' => 'console',
                'array' => $array,
                'number' => $number
            ];

            $id = (int)$user_id;

            if (($user = Users::findOne($id)) !== null) {
                $userRequest = new UsersRequest([
                    'user_id' => $user->id,
                    'request' => json_encode($request),
                    'response' => $sorted
                ]);

                if ($userRequest->validate() && $userRequest->save()) {
                    echo Console::output('User: ' . $user->username);
                } else {
                    echo implode(': ', $userRequest->getErrors());
                    return ExitCode::IOERR;
                }
            }
        }

        echo Console::output('Answer: ' . $sorted);

        return ExitCode::OK;
    }

}