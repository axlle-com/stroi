<?php

namespace backend\controllers;

use Yii;
use common\models\Image;
use common\models\Search\ImageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Imagine\Image\Box;
use common\components\Common;
use yii\helpers\Url;

/**
 * ImageController implements the CRUD actions for Image model.
 */
class ImageController extends DefaultController
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
     * Lists all Image models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionStep2(){
        $id = Yii::$app->locator->cache->get('id');
        $model = Image::findOne($id);
        $folder = Image::tableName();
        $title = $model->folder->link;
        if(Yii::$app->request->isPost){
            $this->redirect(Url::to([$folder.'/']));
        }

        return $this->render("step2",Common::getStep($model,$folder,$title));
    }
    public function actionFileUploadGeneral()
    {
        if(Yii::$app->request->isPost){
            $id = Yii::$app->request->post("id");
            $model = Image::findOne($id);
            $folder = $model::tableName();
            Common::getImage($model,$folder);
            return true;

        }
    }
    /**
     * Displays a single Image model.
     * @param integer $id
     * @param integer $folder_id
     * @return mixed
     */
    public function actionView($id, $folder_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $folder_id),
        ]);
    }

    /**
     * Creates a new Image model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Image();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['step2']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Image model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $folder_id
     * @return mixed
     */
    public function actionUpdate($id, $folder_id)
    {
        $model = $this->findModel($id, $folder_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['step2']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Image model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $folder_id
     * @return mixed
     */
    public function actionDelete($id, $folder_id)
    {
        $this->findModel($id, $folder_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Image model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $folder_id
     * @return Image the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $folder_id)
    {
        if (($model = Image::findOne(['id' => $id, 'folder_id' => $folder_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
