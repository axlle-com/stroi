<?php

namespace backend\controllers;

use Yii;
use common\models\Specifically;
use common\models\Search\SpecificallySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SpecificallyController implements the CRUD actions for Specifically model.
 */
class SpecificallyController extends DefaultController
{
    /**
     * @inheritdoc

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
    }*/

    /**
     * Lists all Specifically models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SpecificallySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Specifically model.
     * @param integer $id
     * @param integer $extra_id
     * @return mixed
     */
    public function actionView($id, $extra_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $extra_id),
        ]);
    }

    /**
     * Creates a new Specifically model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Specifically();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'extra_id' => $model->extra_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Specifically model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $extra_id
     * @return mixed
     */
    public function actionUpdate($id, $extra_id)
    {
        $model = $this->findModel($id, $extra_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'extra_id' => $model->extra_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Specifically model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $extra_id
     * @return mixed
     */
    public function actionDelete($id, $extra_id)
    {
        $this->findModel($id, $extra_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Specifically model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $extra_id
     * @return Specifically the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $extra_id)
    {
        if (($model = Specifically::findOne(['id' => $id, 'extra_id' => $extra_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
