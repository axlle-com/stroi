<?php

namespace backend\controllers;

use Yii;
use common\models\InfoblockHasItem;
use common\models\Search\InfoblockHasItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InfoblockHasItemController implements the CRUD actions for InfoblockHasItem model.
 */
class InfoblockHasItemController extends DefaultController
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
     * Lists all InfoblockHasItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InfoblockHasItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InfoblockHasItem model.
     * @param integer $infoblock_id
     * @param integer $item_id
     * @return mixed
     */
    public function actionView($infoblock_id, $item_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($infoblock_id, $item_id),
        ]);
    }

    /**
     * Creates a new InfoblockHasItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InfoblockHasItem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'infoblock_id' => $model->infoblock_id, 'item_id' => $model->item_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing InfoblockHasItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $infoblock_id
     * @param integer $item_id
     * @return mixed
     */
    public function actionUpdate($infoblock_id, $item_id)
    {
        $model = $this->findModel($infoblock_id, $item_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'infoblock_id' => $model->infoblock_id, 'item_id' => $model->item_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing InfoblockHasItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $infoblock_id
     * @param integer $item_id
     * @return mixed
     */
    public function actionDelete($infoblock_id, $item_id)
    {
        $this->findModel($infoblock_id, $item_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the InfoblockHasItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $infoblock_id
     * @param integer $item_id
     * @return InfoblockHasItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($infoblock_id, $item_id)
    {
        if (($model = InfoblockHasItem::findOne(['infoblock_id' => $infoblock_id, 'item_id' => $item_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
