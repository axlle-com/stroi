<?php

namespace backend\controllers;

use Yii;
use common\models\DetailsHasType;
use common\models\Search\DetailsHasTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DetailsHasTypeController implements the CRUD actions for DetailsHasType model.
 */
class DetailsHasTypeController extends DefaultController
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
    }
*/
    /**
     * Lists all DetailsHasType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DetailsHasTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DetailsHasType model.
     * @param integer $details_id
     * @param integer $type_id
     * @return mixed
     */
    public function actionView($details_id, $type_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($details_id, $type_id),
        ]);
    }

    /**
     * Creates a new DetailsHasType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DetailsHasType();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'details_id' => $model->details_id, 'type_id' => $model->type_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing DetailsHasType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $details_id
     * @param integer $type_id
     * @return mixed
     */
    public function actionUpdate($details_id, $type_id)
    {
        $model = $this->findModel($details_id, $type_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'details_id' => $model->details_id, 'type_id' => $model->type_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DetailsHasType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $details_id
     * @param integer $type_id
     * @return mixed
     */
    public function actionDelete($details_id, $type_id)
    {
        $this->findModel($details_id, $type_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DetailsHasType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $details_id
     * @param integer $type_id
     * @return DetailsHasType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($details_id, $type_id)
    {
        if (($model = DetailsHasType::findOne(['details_id' => $details_id, 'type_id' => $type_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
