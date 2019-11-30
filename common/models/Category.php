<?php

namespace common\models;

use phpDocumentor\Reflection\Types\Self_;
use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\helpers\HtmlPurifier;
/**
 * This is the model class for table "category".
 *
 * @property string $id
 * @property integer $render_id
 * @property integer $parent_id
 * @property integer $sitemap
 * @property integer $published
 * @property integer $favourites
 * @property integer $show_img
 * @property integer $watermark
 * @property integer $small_img
 * @property integer $tumb_img
 * @property string $alias_category
 * @property string $title
 * @property string $title_seo
 * @property string $title_short
 * @property string $description
 * @property string $description_seo
 * @property string $purified_text
 * @property string $general_photo
 * @property integer $sort
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Render $render
 * @property Item[] $items
 * @property Reviews[] $reviews
 * @property Semantico[] $semanticos
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }
    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios['step2'] = ['general_photo'];

        return $scenarios;
    }

    public function afterSave($insert, $changedAttributes){
        Yii::$app->locator->cache->set('id',$this->id);
        
        parent::afterSave($insert, $changedAttributes);
    }
    /*public function afterFind()
    {
        if($this->purified_text && $this->description)
        {
            $this->purified_text = strip_tags($this->description);
            $this->update($this->id, [
                'purified_text' => $this->purified_text
            ]);
        }
        parent::afterFind();
    }*/
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['render_id', 'sitemap', 'alias_category', 'title'], 'required'],
            [['render_id', 'parent_id', 'sitemap', 'published', 'favourites', 'show_img', 'watermark', 'small_img', 'tumb_img', 'sort', 'created_at', 'updated_at'], 'integer'],
            [['description', 'purified_text'], 'string'],
            [['alias_category', 'title', 'title_seo', 'description_seo', 'general_photo'], 'string', 'max' => 255],
            [['title_short'], 'string', 'max' => 150],
            [['title'], 'unique'],
            [['alias_category'], 'unique'],
            [['render_id'], 'exist', 'skipOnError' => true, 'targetClass' => Render::class, 'targetAttribute' => ['render_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'render_id' => 'Страница вывода',
            'parent_id' => 'Родительская категория',
            'sitemap' => 'Sitemap',
            'published' => 'Published',
            'favourites' => 'Favourites',
            'show_img' => 'Show Img',
            'watermark' => 'Watermark',
            'small_img' => 'Small Img',
            'tumb_img' => 'Tumb Img',
            'alias_category' => 'Псевдоним категории',
            'title' => 'Заголовок',
            'title_seo' => 'Заголовок Seo',
            'title_short' => 'Короткий заголовок',
            'description' => 'Текст статьи',
            'description_seo' => 'Описание Seo',
            'purified_text' => 'Purified Text',
            'general_photo' => 'Главная фотография',
            'sort' => 'Сортировка',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRender()
    {
        return $this->hasOne(Render::class, ['id' => 'render_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::class, ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Reviews::class, ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSemanticos()
    {
        return $this->hasMany(Semantico::class, ['category_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }

    public function getRenderName()
    {
        $render = $this->render;

        return $render ? $render->name : '';
    }

    public static function getRenderList()
    {
        $renders = Render::find()->all();

        return ArrayHelper::map($renders, 'id', 'name');
    }

    public function getParentName()
    {
        $parent = Category::findOne($this->parent_id) ;

        return $parent ? $parent->title : 'Родительская категория';
    }

    public static function getParentList()
    {
        $parents = Category::find()->all();

        return ArrayHelper::map($parents, 'id', 'title');
    }

    public function getCategoryList()
    {
        $parents = Category::find()->where('parent_id = :id', [':id' => $this->parent_id])->all();

        return ArrayHelper::map($parents, 'alias_category', 'title');
    }

    public function getFolder(){
        return self::tableName();
    }
}
