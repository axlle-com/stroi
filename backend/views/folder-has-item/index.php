<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\Search\FolderHasItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Folder Has Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folder-has-item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Folder Has Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'folder_id',
            [
                'attribute'=>'folder_id',
                'label'=>'Галерея',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return $data->getFolderName();
                },
                'filter' => \common\models\FolderHasItem::getFolderList()
            ],

            //'item_id',
            [
                'attribute'=>'item_id',
                'label'=>'Статья',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return $data->getItemsName();
                },
                'filter' => \common\models\FolderHasItem::getItemsList()
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
