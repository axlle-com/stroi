<?php

namespace backend\controllers;

use Yii;
use common\models\Folder;
use common\models\Search\FolderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\components\Common;
use yii\helpers\Url;

/**
 * FolderController implements the CRUD actions for Folder model.
 */
class FolderController extends DefaultController
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
     * Lists all Folder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FolderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionStep2(){
        $id = Yii::$app->locator->cache->get('id_folder');
        $model = Folder::findOne($id);
        $folder = Folder::tableName();
        $title = $model->id;
        if(Yii::$app->request->isPost){
            $this->redirect(Url::to([$folder.'/']));
        }

        return $this->render("step2",Common::getStep($model,$folder,$title));
    }

    public function actionFileUploadGeneral()
    {
        if(Yii::$app->request->isPost){
            $id = Yii::$app->request->post("id");
            $model = Folder::findOne($id);
            $folder = $model::tableName();
            Common::getImage($model,$folder);
            return true;

        }
    }
    public function actionFileUploadImages()
    {
        if(Yii::$app->request->isPost){
            $id = Yii::$app->request->post('id');
            $model = Folder::findOne($id);
            $folder = Folder::tableName();
            Common::getImages($model,$folder);
            return true;

        }
    }
    /**
     * Displays a single Folder model.
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
     * Creates a new Folder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Folder();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['step2']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Folder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['step2']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Folder model.
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
     * Finds the Folder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Folder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Folder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
