<?php

namespace app\controllers;

use Yii;
use app\models\Usuario;
use app\models\Cliente;
use app\models\search\ClienteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * ClienteController implements the CRUD actions for Cliente model.
 */
class ClienteController extends Controller
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
                    'reactivar' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['empleado'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Cliente models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClienteSearch();
        $searchModel->estado = 1;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cliente model.
     * @param integer $idcliente
     * @param integer $usuario_idusuario
     * @return mixed
     */
    public function actionView($idcliente, $usuario_idusuario)
    {
        return $this->render('view', [
            'model' => $this->findModel($idcliente, $usuario_idusuario),
        ]);
    }

    /**
     * Creates a new Cliente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cliente();
        $usuario = new Usuario();
        $model->empleado_idempleado = Yii::$app->user->identity->empleado->idempleado;
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();

        try {
            if ($usuario->load(Yii::$app->request->post()) && $usuario->save()) {
                $model->load(Yii::$app->request->post());
                $model->usuario_idusuario = $usuario->idusuario;
                if ($model->save()) {
                    //asigna el rol seleccionado
                    $estadoUsuario = new \app\models\Historial();
                    $estadoUsuario->fecha = date("Y-m-d");
                    $estadoUsuario->estado_idestado = 1;
                    $estadoUsuario->cliente_idcliente = $model->idcliente;
                    $estadoUsuario->empleado_idempleado = $model->empleado_idempleado; 
                    $estadoUsuario->save();

                    $transaction->commit();
                    return $this->redirect(['view', 'idcliente' => $model->idcliente, 'usuario_idusuario' => $model->usuario_idusuario]);
                }
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }

        return $this->render('create', [
            'model' => $model,
            'usuario' => $usuario,
        ]);
    }

    /**
     * Updates an existing Cliente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idcliente
     * @param integer $usuario_idusuario
     * @return mixed
     */
    public function actionUpdate($idcliente, $usuario_idusuario)
    {
        $model = $this->findModel($idcliente, $usuario_idusuario);
        $usuario = Usuario::findOne($model->usuario_idusuario);
        $passAntigua = $usuario->password;
        if ($usuario->load(Yii::$app->request->post()) && $usuario->save()) {
            $model->load(Yii::$app->request->post());
            if(strlen($usuario->password)==32){
                $usuario->password = $passAntigua;
            }else{
                $usuario->password =  md5($usuario->password);
            }
            $usuario->save();
            if ($model->save()) {
                return $this->redirect(['view', 'idcliente' => $model->idcliente, 'usuario_idusuario' => $model->usuario_idusuario]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'usuario' => $usuario,
        ]);
    }

    /**
     * Deletes an existing Cliente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idcliente
     * @param integer $usuario_idusuario
     * @return mixed
     */
    public function actionDelete($idcliente, $usuario_idusuario)
    {
        $estadoUsuario = new \app\models\Historial();
        $estadoUsuario->fecha = date("Y-m-d");
        $estadoUsuario->estado_idestado = 2;
        $estadoUsuario->empleado_idempleado = Yii::$app->user->identity->empleado->idempleado;
        $estadoUsuario->cliente_idcliente = $idcliente;
        $estadoUsuario->save();

        return $this->redirect(['index']);
    }

    public function actionReactivar($idcliente, $usuario_idusuario)
    {        
        $estadoUsuario = new \app\models\Historial();
        $estadoUsuario->fecha = date("Y-m-d");
        $estadoUsuario->estado_idestado = 1;
        $estadoUsuario->empleado_idempleado = Yii::$app->user->identity->empleado->idempleado;
        $estadoUsuario->cliente_idcliente = $idcliente;
        $estadoUsuario->save();  
        return $this->redirect(['view', 'idcliente' => $idcliente, 'usuario_idusuario' => $usuario_idusuario]);
    }

    /**
     * Finds the Cliente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idcliente
     * @param integer $usuario_idusuario
     * @return Cliente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idcliente, $usuario_idusuario)
    {
        if (($model = Cliente::findOne(['idcliente' => $idcliente, 'usuario_idusuario' => $usuario_idusuario])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
