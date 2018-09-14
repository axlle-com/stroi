<?php

namespace backend\controllers;

use Yii;
use common\models\Item;
use common\models\Search\ItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\BaseFileHelper;
use yii\web\UploadedFile;
use Imagine\Image\Point;
use yii\imagine\Image;
use Imagine\Image\Box;
use common\components\Common;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends DefaultController
{
    /**
     * @inheritdoc
     */

    /**
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionStep2(){
        $id = Yii::$app->locator->cache->get('id_image');
        $model = Item::findOne($id);
        $folder = Item::tableName();
        $title = $model->alias_item;
        if(Yii::$app->request->isPost){
            $this->redirect(['view', 'id' => $model->id, 'render_id' => $model->render_id]);
        }

        return $this->render("step2",Common::getStep($model,$folder,$title));
    }

    public function actionFileUploadGeneral()
    {
        if(Yii::$app->request->isPost){
            $id = Yii::$app->request->post("id");
            $model = Item::findOne($id);
            $folder = $model::tableName();
            Common::getImage($model,$folder);
            return true;
        }
    }
    public function actionFileUploadImages()
    {
        if(Yii::$app->request->isPost){
            $id = Yii::$app->request->post('id');
            $model = Item::findOne($id);
            $folder = Item::tableName();
            Common::getImages($model,$folder);
            return true;
        }
    }
    /**
     * Displays a single Item model.
     * @param integer $id
     * @param integer $render_id
     * @return mixed
     */
    public function actionView($id, $render_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $render_id),
        ]);
    }

    /**
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Item();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($model->show_img)
            {
                return $this->redirect(['step2']);
            }else{
                return $this->redirect(['view', 'id' => $model->id, 'render_id' => $model->render_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Item model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $render_id
     * @return mixed
     */
    public function actionUpdate($id, $render_id)
    {
        $model = $this->findModel($id, $render_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($model->show_img)
            {
                return $this->redirect(['step2']);
            }else{
                return $this->redirect(['view', 'id' => $model->id, 'render_id' => $model->render_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Item model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $render_id
     * @return mixed
     */
    public function actionDelete($id, $render_id)
    {
        $this->findModel($id, $render_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $render_id
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $render_id)
    {
        if (($model = Item::findOne(['id' => $id, 'render_id' => $render_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
