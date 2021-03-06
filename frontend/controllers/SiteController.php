<?php
namespace frontend\controllers;

use common\components\Common;
use common\models\Infoblock;
use common\models\Reviews;
use common\models\Tags;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Category;
use common\models\Item;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\Response;
use yii\widgets\ActiveForm;
use frontend\filters\FilterCategory;
use frontend\filters\FilterItem;
use frontend\filters\FilterAll;
use frontend\filters\FilterTags;
use yii\base\DynamicModel;
use yii\data\Pagination;
use yii\web\HttpException;

class SiteController extends Controller
{
    public $category_name='';

    public function behaviors()
    {
        return [
            /*[
                'class' => 'yii\filters\PageCache',
                'duration' => 3600*24*30,
                'dependency' =>[
                    'class' => 'yii\caching\ChainedDependency',
                    'dependencies' =>
                    [
                        new DbDependency([
                            'sql' => 'SELECT MAX("id") FROM' . Item::tableName(),
                        ]),
                    ]

                ]

            ],*/
            [
                'only' => ['category'],
                'class' =>  FilterCategory::className(),
            ],
            [
                'only' => ['item'],
                'class' =>  FilterItem::className(),
            ],
            /*[
                'only' => ['tags'],
                'class' =>  FilterTags::className(),
            ],*/
            [
                'only' => ['index','item','category','tags'],
                'class' =>  FilterAll::className(),
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup',],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['cashes'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'frontend\config\NumericCaptcha',
                //'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'backColor'=> 0xfafafa,
                'foreColor' => 0xcecece, // цвет символов
                'offset' => 1,
            ],
        ];
    }

    public function actionIndex()
    {
        $this->layout = 'bootstrap';
        return $this->render('index');
    }

    public function actionFavorite()
    {
        $cookie = $_COOKIE['srbstrfvrt'];
        $cookie = json_decode($cookie);
//        print_r($cookie);
        if(count($cookie))
        {
            $query = Item::find()->where(['id' => $cookie])->andWhere(['sitemap' => 1])->orderBy(['position'=>SORT_ASC]);
            $items_count = clone $query;
            $pages = new Pagination(['totalCount' => $items_count->count()]);
            $pages->setPageSize(12);
            $pages_size = $pages->getPageSize();
            $pages->forcePageParam = false;
            $pages->pageSizeParam = false;
            $model = $query->offset($pages->offset)->limit($pages->limit)->all();
            return $this->render('favorite',[
                'model' => $model,
                'pages' => $pages,
                'pages_size' => $pages_size,
                'category' => $category,
            ]);
        }
        return $this->render('favorite',[
            'model' => $model,
            'pages' => $pages,
            'pages_size' => $pages_size,
            'category' => $category,
        ]);
    }

    public function actionCategory($alias_category)
    {
        $sort = Yii::$app->request->get(trim('sort'));
        $category = Category::findOne(['alias_category' => $alias_category]);
        //Common::getHitSb();
        //Common::getHotPrice();
        //Common::getDesc();
        //Common::getMyMetaTeg();
        $category_name = Category::findOne($category->parent_id)->title;
        function Sample($option,$sort,$category){
            return Item::find()
                ->where(['category_id' => $category->id])
                ->andWhere(['sitemap' => 1])
                ->joinWith(['details'])
                ->orderBy([$option => $sort]);
        }
        if($category->render->name == 'reviews'){
            $query = Reviews::find()
                ->where(['category_id' => $category->id])
                ->orderBy(['data'=>SORT_DESC]);
        }
        elseif($category->render->name == 'blog' || $category->render->name == 'service' || $category->render->name == 'gallery')
        {
            $query = Item::find()
                ->where(['category_id' => $category->id])
                ->andWhere(['sitemap' => 1])
                ->orderBy(['date_pub'=>SORT_DESC]);
        }
        elseif ($category->render->name == 'favorite'){
            $cookie = $_COOKIE['srbstrfvrt'];
            $cookie = json_decode($cookie);
            if($sort){
                if($sort == 'price-desc'){
                    $query = Item::find()->where(['id' => $cookie])->andWhere(['sitemap' => 1])->orderBy(['position'=>SORT_DESC]);
                }else{
                    $query = Item::find()->where(['id' => $cookie])->andWhere(['sitemap' => 1])->orderBy(['position'=>SORT_ASC]);
                }
            }else{
                $query = Item::find()->where(['id' => $cookie])->andWhere(['sitemap' => 1])->orderBy(['position'=>SORT_ASC]);
            }
        }
        else{
            $itemPrice = Item::find()->alias('i')
                ->select('MIN(d.original_price) AS min_price, MAX(d.original_price) AS max_price')
                ->andWhere(['i.category_id' => $category->id])
                ->andWhere(['sitemap' => 1])
                ->joinWith('details as d')
                ->asArray()->one();
            $max = $itemPrice['max_price'];
            $max = Common::getShemaPrice($max,'');
            $min = $itemPrice['min_price'];
            $min = Common::getShemaPrice($min,'');
            if($sort) {
                if ($sort == 'price-desc') {
                    $query = Sample('original_price',SORT_DESC,$category);
                } elseif ($sort == 'square-desc') {
                    $query = Sample('square',SORT_DESC,$category);
                } elseif($sort == 'square-asc'){
                    $query = Sample('square',SORT_ASC,$category);
                }else{
                    $query = Sample('original_price',SORT_ASC,$category);
                }
            }else{
                $query = Sample('original_price',SORT_ASC,$category);
            }

        }
        $items_count = clone $query;
        $pages = new Pagination(['totalCount' => $items_count->count()]);
        $pages->setPageSize(12);
        $pages_size = $pages->getPageSize();
        $pages->forcePageParam = false;
        $pages->pageSizeParam = false;
        $model = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render($category->render->name,[
            'model' => $model,
            'category' => $category,
            'pages' => $pages,
            'pages_size' => $pages_size,
            'category_name' => $category_name,
            'max' => $max,
            'min' => $min,
        ]);
    }

    public function actionTags($alias_category,$alias_tags)
    {
        $sort = Yii::$app->request->get(trim('sort'));
        $category = Tags::find()->where(['alias_category' => $alias_category])->andWhere(['alias_tags' => $alias_tags])->one();
        $r = [];
        if($category){
            foreach ($category->items as $row){
                $r[] = $row->id;
            }
        }
        function Sample($option,$sort,$r){
            return Item::find()->alias('i')
                ->where(['i.id' => $r])
                ->andWhere(['sitemap' => 1])
                ->joinWith('details as d')
                ->orderBy([$option => $sort]);
        }
        $itemPrice = Item::find()->alias('i')
            ->select('MIN(d.original_price) AS min_price, MAX(d.original_price) AS max_price')
            ->andWhere(['i.id' => $r])
            ->andWhere(['sitemap' => 1])
            ->joinWith('details as d')
            ->asArray()
            ->one();
        $max = $itemPrice['max_price'];
        $max = Common::getShemaPrice($max,'');
        $min = $itemPrice['min_price'];
        $min = Common::getShemaPrice($min,'');
        if($sort){
            if($sort == 'price-desc'){
                $query = Sample('d.original_price',SORT_DESC,$r);
            }else{
                $query = Sample('d.original_price',SORT_ASC,$r);
            }
        }else{
            $query = Sample('d.original_price',SORT_ASC,$r);
        }
        $items_count = clone $query;
        $pages = new Pagination(['totalCount' => $items_count->count()]);
        $pages->setPageSize(12);
        $pages_size = $pages->getPageSize();
        $pages->forcePageParam = false;
        $pages->pageSizeParam = false;
        $model = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('tags',[
            'model' => $model,
            'category' => $category,
            'pages' => $pages,
            'pages_size' => $pages_size,
            'max' => $max,
            'min' => $min,
        ]);
    }

    public function actionItem($alias_item)
    {
        $model = Item::findOne(['alias_item' => $alias_item]);
        $related = Common::getRelated($model);
        $model->updateCounters(['hits' => 1]);
//        $query = Item::find()->alias('i')
//            ->select(['i.published hour','i.date_pub min','b.date_pub id'])
//            ->joinWith([
//                'infoblocks b' /*=> function($qury){
//                        $qury->select(['infoblock.date_pub']);
//                    },*/
//                ])
//            ->groupBy(['hour','min','id'])
//            ->asArray()
//            ->all();
//        echo '<pre>';
//        print_r($query);
//        echo '</pre>';
//        echo '<pre>';
//        foreach ($query as $item){
//            echo '================<br>';
//            echo $item['hour'].'<br>';
//            echo $item['min'].'<br>';
//            if(isset($item['id'])){
//                echo $item['id'].'<br>';
//            }else{
//                echo 'xxxxx<br>';
//            }
//        }
//        echo '</pre>';
//        exit();
        return $this->render($model->render->name,[
            'model' => $model,
            'category_name' => $model->category->title,
            'related' => $related,
        ]);
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $body = " <div>Тема: <b> ".$model->subject." </b></div>";
            $body .= " <div>Body: <b> ".$model->body." </b></div>";
            $body .= " <div>Телефон: <b> ".$model->phone." </b></div>";
            $body .= " <div>Email: <b> ".$model->email." </b></div>";
            if (\Yii::$app->common->sendMail($model->subject,$body)) {
                Yii::$app->session->setFlash('success', 'Спасибо.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        //$this->layout = 'bootstrap';
        $model = Item::find()->all();
        return $this->render('about',[
            'model' => $model,
            'category_name' => $model->category->title,
        ]);
    }

    public function actionSearch()
    {
        return $this->render('search');
    }

//    public function actionLogin()
//    {
//        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
//        }
//        $model = new LoginForm();
//        if ($model->load(Yii::$app->request->post()) && $model->login()) {
//            return $this->goBack();
//        } else {
//            return $this->render('login', [
//                'model' => $model,
//            ]);
//        }
//    }

//    public function actionLogout()
//    {
//        Yii::$app->user->logout();
//        return $this->goHome();
//    }

//    public function actionSignup()
//    {
//        $model = new SignupForm();
//        if(\Yii::$app->request->isAjax && \Yii::$app->request->isPost){
//            if($model->load(\Yii::$app->request->post())) {
//                \Yii::$app->response->format = Response::FORMAT_JSON;
//                return ActiveForm::validate($model);
//            }
//        }
//
//        if($model->load(\Yii::$app->request->post()) && $model->signup()){
//
//            \Yii::$app->session->setFlash('success', 'Register Success');
//        }
//
//        return $this->render('signup', [
//            'model' => $model,
//        ]);
//    }

//    public function actionRequestPasswordReset()
//    {
//        $model = new PasswordResetRequestForm();
//        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//            if ($model->sendEmail()) {
//                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
//
//                return $this->goHome();
//            } else {
//                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
//            }
//        }
//
//        return $this->render('requestPasswordResetToken', [
//            'model' => $model,
//        ]);
//    }

//    public function actionResetPassword($token)
//    {
//        try {
//            $model = new ResetPasswordForm($token);
//        } catch (InvalidParamException $e) {
//            throw new BadRequestHttpException($e->getMessage());
//        }
//
//        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
//            Yii::$app->session->setFlash('success', 'New password saved.');
//
//            return $this->goHome();
//        }
//
//        return $this->render('resetPassword', [
//            'model' => $model,
//        ]);
//    }

}
