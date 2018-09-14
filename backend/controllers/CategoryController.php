<?php

namespace backend\controllers;

use Yii;
use common\models\Category;
use common\models\Search\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\components\Common;
use yii\helpers\Url;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends DefaultController
{
    /**
     * @inheritdoc
     */
    /*public function behaviors()
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionStep2(){
        $id = Yii::$app->locator->cache->get('id');
        $model = Category::findOne($id);
        $folder = Category::tableName();
        $title = $model->alias_category;
        if(Yii::$app->request->isPost){
            $this->redirect(['view', 'id' => $model->id, 'render_id' => $model->render_id]);
        }
        return $this->render("step2",Common::getStep($model,$folder,$title));
    }

    public function actionFileUploadGeneral()
    {
        if(Yii::$app->request->isPost){
            $id = Yii::$app->request->post("id");
            $model = Category::findOne($id);
            $folder = $model::tableName();
            Common::getImage($model,$folder);
            return true;
        }
    }
    public function actionFileUploadImages()
    {
        if(Yii::$app->request->isPost){
            $id = Yii::$app->request->post('id');
            $model = Category::findOne($id);
            $folder = Category::tableName();
            Common::getImages($model,$folder);
            return true;

        }
    }


    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param string $id
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();

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
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @param integer $render_id
     * @return mixed
     */
    public function actionDelete($id, $render_id)
    {
        $this->findModel($id, $render_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @param integer $render_id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $render_id)
    {
        if (($model = Category::findOne(['id' => $id, 'render_id' => $render_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
