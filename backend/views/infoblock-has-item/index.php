<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\Search\InfoblockHasItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Infoblock Has Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="infoblock-has-item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Infoblock Has Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'infoblock_id',
            [
                'attribute'=>'infoblock_id',
                'label'=>'Инфоблок',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return $data->getInfoName();
                },
                'filter' => \common\models\InfoblockHasItem::getInfoList()
            ],

            //'item_id',
            [
                'attribute'=>'item_id',
                'label'=>'Статья',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return $data->getItemName();
                },
                'filter' => \common\models\InfoblockHasItem::getItemList()
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
