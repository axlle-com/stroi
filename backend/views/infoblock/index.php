<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\Search\InfoblockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Infoblocks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="infoblock-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Infoblock', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'published',
            'favourites',
            //'show_img',
            //'watermark',
            // 'small_img',
            // 'tumb_img',
            'name',
            'title',
            // 'description:ntext',
            // 'date_pub',
            // 'date_end',
            // 'general_photo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
