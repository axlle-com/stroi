<?php

namespace backend\controllers;

use Yii;
use common\models\Reviews;
use common\models\Search\ReviewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\components\Common;
/**
 * ReviewsController implements the CRUD actions for Reviews model.
 */
class ReviewsController extends DefaultController
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
     * Lists all Reviews models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReviewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionStep2(){
        $id = Yii::$app->locator->cache->get('id_image');
        $model = Reviews::findOne($id);
        $folder = Reviews::tableName();
        $title = $model->title;
        if(Yii::$app->request->isPost){
            $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render("step2",Common::getStep($model,$folder,$title));
    }

    public function actionFileUploadGeneral()
    {
        if(Yii::$app->request->isPost){
            $id = Yii::$app->request->post("id");
            $model = Reviews::findOne($id);
            $folder = $model::tableName();
            Common::getImage($model,$folder);
            return true;
        }
    }
    public function actionFileUploadImages()
    {
        if(Yii::$app->request->isPost){
            $id = Yii::$app->request->post('id');
            $model = Reviews::findOne($id);
            $folder = Reviews::tableName();
            Common::getImages($model,$folder);
            return true;
        }
    }
    /**
     * Displays a single Reviews model.
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
     * Creates a new Reviews model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Reviews();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($model->show_img)
            {
                return $this->redirect(['step2']);
            }else {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Reviews model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($model->show_img)
            {
                return $this->redirect(['step2']);
            }else {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Reviews model.
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
     * Finds the Reviews model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Reviews the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reviews::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
