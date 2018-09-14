<?php

namespace backend\controllers;

use Yii;
use common\models\TagsHasItem;
use common\models\Search\TagsHasItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TagsHasItemController implements the CRUD actions for TagsHasItem model.
 */
class TagsHasItemController extends DefaultController
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
     * Lists all TagsHasItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TagsHasItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TagsHasItem model.
     * @param integer $tags_id
     * @param integer $item_id
     * @return mixed
     */
    public function actionView($tags_id, $item_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($tags_id, $item_id),
        ]);
    }

    /**
     * Creates a new TagsHasItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TagsHasItem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'tags_id' => $model->tags_id, 'item_id' => $model->item_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TagsHasItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $tags_id
     * @param integer $item_id
     * @return mixed
     */
    public function actionUpdate($tags_id, $item_id)
    {
        $model = $this->findModel($tags_id, $item_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'tags_id' => $model->tags_id, 'item_id' => $model->item_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TagsHasItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $tags_id
     * @param integer $item_id
     * @return mixed
     */
    public function actionDelete($tags_id, $item_id)
    {
        $this->findModel($tags_id, $item_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TagsHasItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $tags_id
     * @param integer $item_id
     * @return TagsHasItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($tags_id, $item_id)
    {
        if (($model = TagsHasItem::findOne(['tags_id' => $tags_id, 'item_id' => $item_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
