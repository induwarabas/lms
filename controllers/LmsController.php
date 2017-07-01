<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 6/29/2017
 * Time: 8:51 PM
 */

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use webvimark\modules\UserManagement\components\GhostMenu;
use webvimark\modules\UserManagement\UserManagementModule;

class LmsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
//            'access' => [
//                'class' => AccessControl::className(),
//                'only' => ['logout'],
//                'rules' => [
//                    [
//                        'actions' => ['logout'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
}