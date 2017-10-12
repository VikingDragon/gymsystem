<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ClienteController implements the CRUD actions for Cliente model.
 */
class AdministrarController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['administrador','empleado'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Muestra un menu para administrar el sistema
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

}
