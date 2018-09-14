<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Category;
/* @var $this yii\web\View */
/* @var $searchModel common\models\Search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'render_id',
            [
                'attribute'=>'render_id',
                'label'=>'Страница вывода',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return $data->getRenderName();
                },
                'filter' => Category::getRenderList(),
            ],
            //'parent_id',
            [
                'attribute'=>'parent_id',
                'label'=>'Родительская категория',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return $data->getParentName();
                },
                'filter' => Category::getParentList()
            ],

            'sitemap',
            'published',
            // 'favourites',
            // 'show_img',
            // 'watermark',
            // 'small_img',
            // 'tumb_img',
            'alias_category',
            'title',
            // 'title_seo',
            'title_short',
            // 'description:ntext',
            // 'description_seo',
            // 'purified_text:ntext',
            // 'general_photo',
            // 'sort',
            // 'created_at',
            // 'updated_at', 

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
