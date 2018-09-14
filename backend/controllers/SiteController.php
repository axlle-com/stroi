<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login','captcha'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'cashes'],
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

    /**
     * @inheritdoc
     */
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
                'foreColor' => 0xcecece,
                'offset' => 1,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $request = Yii::$app->request->get(trim('asslle'));

        if($request && $request == 558088)
        {
            if (!Yii::$app->user->isGuest) {
                return $this->goHome();
            }

            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->goBack();
            } else {
                return $this->render('login', [
                    'model' => $model,
                ]);
            }
        }else{
            return \Yii::$app->getResponse()->redirect('/')->send();
        }

    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    public function actionCashes()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }else{
            \Yii::$app->cache->flush();
            return $this->goBack();
        }

    }
}
