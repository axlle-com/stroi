<?php

namespace backend\controllers;

use Yii;
use common\models\TypeHasSpecifically;
use common\models\Search\TypeHasSpecificallySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TypeHasSpecificallyController implements the CRUD actions for TypeHasSpecifically model.
 */
class TypeHasSpecificallyController extends DefaultController
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
     * Lists all TypeHasSpecifically models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TypeHasSpecificallySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TypeHasSpecifically model.
     * @param integer $type_id
     * @param integer $specifically_id
     * @return mixed
     */
    public function actionView($type_id, $specifically_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($type_id, $specifically_id),
        ]);
    }

    /**
     * Creates a new TypeHasSpecifically model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TypeHasSpecifically();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'type_id' => $model->type_id, 'specifically_id' => $model->specifically_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TypeHasSpecifically model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $type_id
     * @param integer $specifically_id
     * @return mixed
     */
    public function actionUpdate($type_id, $specifically_id)
    {
        $model = $this->findModel($type_id, $specifically_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'type_id' => $model->type_id, 'specifically_id' => $model->specifically_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TypeHasSpecifically model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $type_id
     * @param integer $specifically_id
     * @return mixed
     */
    public function actionDelete($type_id, $specifically_id)
    {
        $this->findModel($type_id, $specifically_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TypeHasSpecifically model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $type_id
     * @param integer $specifically_id
     * @return TypeHasSpecifically the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($type_id, $specifically_id)
    {
        if (($model = TypeHasSpecifically::findOne(['type_id' => $type_id, 'specifically_id' => $specifically_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
