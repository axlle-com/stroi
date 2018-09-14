<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\helpers\HtmlPurifier;
/**
 * This is the model class for table "semantico".
 *
 * @property integer $id
 * @property string $category_id
 * @property integer $item_id
 * @property integer $key_name
 * @property string $title
 * @property string $title_seo
 * @property string $description
 * @property string $description_seo
 *
 * @property Category $category
 * @property Item $item
 */
class Semantico extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'semantico';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'item_id', 'key_name'], 'integer'],
            [['key_name'], 'required'],
            [['description'], 'string'],
            [['title', 'title_seo', 'description_seo'], 'string', 'max' => 255],
            [['title'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Категория',
            'item_id' => 'Статья',
            'key_name' => 'Ключ/индекс',
            'title' => 'Заголовок',
            'title_seo' => 'Заголовок SEO',
            'description' => 'Текст',
            'description_seo' => 'Description/content SEO',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }

    /**
     * @inheritdoc
     * @return SemanticoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SemanticoQuery(get_called_class());
    }
    
    public function getCategoryName()
    {
        $category = $this->category;

        return $category ? $category->title : '';
    }

    public static function getCategoryList()
    {
        $categorys = Category::find()->all();

        return ArrayHelper::map($categorys, 'id', 'title');
    }

    public function getItemName()
    {
        $name = $this->item;

        return $name ? $name->title : '';
    }
    
    public static function getItemList()
    {
        $names = Item::find()->all();

        return ArrayHelper::map($names, 'id', 'title');
    }
}
