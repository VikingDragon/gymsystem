<?php

namespace app\controllers;

use Yii;
use app\models\Membrecia;
use app\models\Inventario;
use app\models\search\MembreciaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MembreciaController implements the CRUD actions for Membrecia model.
 */
class MembreciaController extends Controller
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
        ];
    }

    /**
     * Lists all Membrecia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MembreciaSearch();
        $searchModel->estado_idestado = 1;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Membrecia model.
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
     * Creates a new Membrecia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Membrecia();
        $inventario = new Inventario();

        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();

        try {
            if ($inventario->load(Yii::$app->request->post()) && $inventario->save()) {
                $model->inventario_idinventario = $inventario->idinventario;
                $model->estado_idestado = 1;
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
     * Updates an existing Membrecia model.
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
     * Deletes an existing Membrecia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->estado_idestado = 2;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Membrecia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Membrecia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Membrecia::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
