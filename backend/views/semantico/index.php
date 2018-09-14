<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Category;
use common\models\Item;
use common\models\Semantico;
/* @var $this yii\web\View */
/* @var $searchModel common\models\Search\SemanticoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Semanticos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="semantico-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Semantico', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
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
                'filter' => Semantico::getCategoryList()
            ],
            //'item_id',
            [
                'attribute'=>'item_id',
                'label'=>'Статья',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return $data->getItemName();
                },
                'filter' => Semantico::getItemList(),
            ],
            'key_name',
            'title',
            // 'title_seo',
            // 'description:ntext',
            // 'description_seo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
