<?php

namespace app\controllers;

use Yii;
use app\models\Usuario;
use app\models\Empleado;
use app\models\search\EmpleadoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * EmpleadoController implements the CRUD actions for Empleado model.
 */
class EmpleadoController extends Controller
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
                        'roles' => ['administrador'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Empleado models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmpleadoSearch();
        $searchModel->estado = 1;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Empleado model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Empleado model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Empleado();
        $usuario = new Usuario();

        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();

        try {
            if ($usuario->load(Yii::$app->request->post()) && $usuario->save()) {
                $model->load(Yii::$app->request->post());
                $model->usuario_idusuario = $usuario->idusuario;
                if ($model->save()) {
                    //asigna el rol seleccionado
                    $auth = \Yii::$app->authManager;
                    $role = $auth->getRole($model->tipo);
                    $auth->assign($role, $usuario->idusuario);

                    $estadoUsuario = new \app\models\EstadoEmpleado();
                    $estadoUsuario->fecha = date("Y-m-d");
                    $estadoUsuario->estado_idestado = 1;
                    $estadoUsuario->empleado_idempleado = $model->idempleado;
                    $estadoUsuario->save();

                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $model->idempleado]);
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
     * Updates an existing Empleado model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $usuario = Usuario::findOne($model->usuario_idusuario);
        $rol = \app\models\AuthAssignment::find()->where(['user_id'=>$model->usuario_idusuario])->one();
        $model->tipo = $rol->item_name;
        $passAntigua = $usuario->password;
        if ($usuario->load(Yii::$app->request->post()) && $usuario->save()) {
            $model->load(Yii::$app->request->post());
            if(strlen($usuario->password)==32){
                $usuario->password = $passAntigua;
            }else{
                $usuario->password =  md5($usuario->password);
            }
            if ($model->save()) {
                if($rol->item_name != $model->tipo){
                    $auth = \Yii::$app->authManager;
                    $role = $auth->getRole($model->tipo);
                    $auth->assign($role, $usuario->idusuario);
                    $rol->delete();
                }
                return $this->redirect(['view', 'id' => $model->idempleado]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'usuario' => $usuario,
        ]);
    }

    /**
     * Deletes an existing Empleado model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $usuario = Usuario::findOne($model->usuario_idusuario);
        $rol = \app\models\AuthAssignment::find()->where(['user_id'=>$model->usuario_idusuario])->one();
        
        $estadoUsuario = new \app\models\EstadoEmpleado();
        $estadoUsuario->fecha = date("Y-m-d");
        $estadoUsuario->estado_idestado = 2;
        $estadoUsuario->empleado_idempleado = $model->idempleado;
        $estadoUsuario->save();
                    
        //$rol->delete();
        //$model->delete();
        //$usuario->delete();
        return $this->redirect(['index']);
    }

    public function actionReactivar($id)
    {        
        $estadoUsuario = new \app\models\EstadoEmpleado();
        $estadoUsuario->fecha = date("Y-m-d");
        $estadoUsuario->estado_idestado = 1;
        $estadoUsuario->empleado_idempleado = $id;
        $estadoUsuario->save();  
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Finds the Empleado model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Empleado the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Empleado::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
