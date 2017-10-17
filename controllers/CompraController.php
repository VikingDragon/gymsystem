<?php

namespace app\controllers;

use Yii;
use app\models\Compra;
use app\models\DetalleCompra;
use app\models\search\CompraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * CompraController implements the CRUD actions for Compra model.
 */
class CompraController extends Controller
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
                        'roles' => ['empleado'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Compra models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Compra model.
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
     * Creates a new Compra model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $compra = $this->findModel($id);
        $compra->estado_compra_idestado_compra = 1;
        $compra->save();
        return $this->redirect(['view', 'id' => $compra->idcompra]);
    }

    /**
     * Updates an existing Compra model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idcompra]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Compra model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $compra = $this->findModel($id);
        foreach ($compra->detalleCompras as $key => $detalle) {
            \app\models\Lote::findOne($detalle->lote_idlote)->delete();
            //$detalle->delete();
        }
        $compra->delete();
        return $this->redirect(['compra/compra']);
    }

    /**
     * Finds the Compra model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Compra the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Compra::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCompra()
    {
        $carrito = [];
        $compra = Compra::find()
            ->where([
                'estado_compra_idestado_compra'=>2,
                'empleado_idempleado' => Yii::$app->user->identity->empleado->idempleado
            ])
            ->OrderBy('idcompra')
            ->one();

        if(!$compra){
            $compra = new Compra();
        }
        
        $compra->fecha = date("Y-m-d");
        $compra->estado_compra_idestado_compra = 2;
        $compra->empleado_idempleado =  Yii::$app->user->identity->empleado->idempleado;

        $detalleCompra = new DetalleCompra();
        $lote = new \app\models\Lote();
        //$articulo = new \app\models\Articulo();

        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();

        try {
            if ($lote->load(Yii::$app->request->post())) {
                if ($compra->load(Yii::$app->request->post())) {
                    $lote->cantidad_actual = $lote->cantidad;
                    if($compra->save() && $lote->save()){
                        $detalleCompra->load(Yii::$app->request->post());
                        $detalleCompra->compra_idcompra = $compra->idcompra;
                        $detalleCompra->lote_idlote = $lote->idlote;
                        if($detalleCompra->save()){
                            $transaction->commit();
                        }
                    }
                 }
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }

        if(isset($compra->idcompra)){
            $carrito = DetalleCompra::find()
                ->where(['compra_idcompra'=>$compra->idcompra])
                ->all();
        }

        return $this->render('compra',[
            'compra' => $compra,
            'detalleCompra' => $detalleCompra,
            'carrito' => $carrito,
            'lote' => $lote,
            //'articulo' => $articulo,
        ]);
    }
}
