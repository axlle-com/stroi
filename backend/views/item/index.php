<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Category;
use common\models\Item;
/* @var $this yii\web\View */
/* @var $searchModel common\models\Search\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box">
    <div class="box-body"

        <p>
            <?= Html::a('Create Item', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                //'category_id',
                [
                    'attribute'=>'category_id',
                    'label'=>'Категория',
                    'format'=>'text', // Возможные варианты: raw, html
                    'content'=>function($data){
                        return $data->getCategoryName();
                    },
                    'filter' => Item::getCategoryList()
                ],
                //'render_id',
                [
                    'attribute'=>'render_id',
                    'label'=>'Страница вывода',
                    'format'=>'text', // Возможные варианты: raw, html
                    'content'=>function($data){
                        return $data->getRenderName();
                    },
                    'filter' => Item::getRenderList()
                ],
                //'sitemap',
                //'published',
                //'favourites',
                // 'show_comments',
                // 'show_img',
                // 'show_img_post',
                // 'show_img_cat',
                // 'show_message',
                // 'show_data',
                // 'watermark',
                // 'small_img',
                // 'tumb_img',
                // 'media',
                 'alias_item',
                 'title',
                 //'title_seo',
                // 'title_short',
                // 'description_seo',
                // 'description:ntext',
                // 'purified_text:ntext',
                // 'date',
                // 'date_pub',
                // 'date_end',
                // 'general_photo',
                'position',
                //'hits',
                // 'stars',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
