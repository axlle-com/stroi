<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\Search\TagsHasItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tags Has Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tags-has-item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tags Has Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'tags_id',
            [
                'attribute'=>'tags_id',
                'label'=>'Тег',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return $data->getTagsName();
                },
                'filter' => \common\models\TagsHasItem::getTagsList()
            ],
            //'item_id',
            [
                'attribute'=>'item_id',
                'label'=>'Статья',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return $data->getItemName();
                },
                'filter' => \common\models\TagsHasItem::getItemList()
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
