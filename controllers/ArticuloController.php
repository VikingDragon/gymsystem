<?php

namespace app\controllers;

use Yii;
use app\models\Articulo;
use app\models\Inventario;
use app\models\search\ArticuloSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ArticuloController implements the CRUD actions for Articulo model.
 */
class ArticuloController extends Controller
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
                        'roles' => ['administrador'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Articulo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticuloSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Articulo model.
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
     * Creates a new Articulo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $inventario = new Inventario();
        $model = new Articulo();

        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();

        try {
            if ($inventario->load(Yii::$app->request->post()) && $inventario->save()) {
                $model->inventario_idinventario = $inventario->idinventario;
                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $model->inventario_idinventario]);
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
            'inventario' => $inventario
        ]);
    }

    /**
     * Updates an existing Articulo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $inventario = Inventario::findOne($id);

        if ($inventario->load(Yii::$app->request->post()) && $inventario->save()) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->inventario_idinventario]);
            }
        }
        
        return $this->render('update', [
            'model' => $model,
            'inventario' => $inventario
        ]);
    }

    /**
     * Deletes an existing Articulo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Articulo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Articulo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Articulo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetArticulo($q)
    {
        //if(Yii::$app->request->isAjax){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $query=Inventario::find()
                ->orWhere(['like', 'nombre', $q])
                ->all();
            $item=[];
            foreach ($query as $articulo) {
                if($articulo->articulo){
                    array_push($item, [
                        'label'=>$articulo->nombre,
                        'value'=>$articulo->nombre,
                        'id'=>$articulo->idinventario
                    ]);
                }
            }
            return json_encode($item);
        //}
    }
}
