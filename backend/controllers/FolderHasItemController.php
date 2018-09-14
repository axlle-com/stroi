<?php

namespace backend\controllers;

use common\models\Item;
use Yii;
use common\models\FolderHasItem;
use common\models\Search\FolderHasItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * FolderHasItemController implements the CRUD actions for FolderHasItem model.
 */
class FolderHasItemController extends DefaultController
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
     * Lists all FolderHasItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FolderHasItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FolderHasItem model.
     * @param integer $folder_id
     * @param integer $item_id
     * @return mixed
     */
    public function actionView($folder_id, $item_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($folder_id, $item_id),
        ]);
    }

    /**
     * Creates a new FolderHasItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FolderHasItem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'folder_id' => $model->folder_id, 'item_id' => $model->item_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FolderHasItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $folder_id
     * @param integer $item_id
     * @return mixed
     */
    public function actionUpdate($folder_id, $item_id)
    {
        $model = $this->findModel($folder_id, $item_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'folder_id' => $model->folder_id, 'item_id' => $model->item_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FolderHasItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $folder_id
     * @param integer $item_id
     * @return mixed
     */
    public function actionDelete($folder_id, $item_id)
    {
        $this->findModel($folder_id, $item_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FolderHasItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $folder_id
     * @param integer $item_id
     * @return FolderHasItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($folder_id, $item_id)
    {
        if (($model = FolderHasItem::findOne(['folder_id' => $folder_id, 'item_id' => $item_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    
}
