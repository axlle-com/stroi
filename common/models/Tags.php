<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tags".
 *
 * @property integer $id
 * @property integer $sitemap
 * @property string $alias_category
 * @property string $alias_tags
 * @property string $title
 * @property string $title_short
 * @property string $title_seo
 * @property string $description_seo
 * @property string $description
 * @property string $name
 * @property string $type
 *
 * @property TagsHasItem[] $tagsHasItems
 * @property Item[] $items
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sitemap'], 'integer'],
            [['alias_category', 'alias_tags', 'title', 'title_short', 'type'], 'required'],
            [['description'], 'string'],
            [['alias_category', 'title', 'title_seo', 'description_seo', 'name'], 'string', 'max' => 255],
            [['alias_tags', 'title_short', 'type'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sitemap' => 'Sitemap',
            'alias_category' => 'Alias Category',
            'alias_tags' => 'Alias Tags',
            'title' => 'Title',
            'title_short' => 'Title Short',
            'title_seo' => 'Title Seo',
            'description_seo' => 'Description Seo',
            'description' => 'Description',
            'name' => 'Name',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagsHasItems()
    {
        return $this->hasMany(TagsHasItem::className(), ['tags_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['id' => 'item_id'])->viaTable('tags_has_item', ['tags_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return TagsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TagsQuery(get_called_class());
    }

    public function afterSave($insert, $changedAttributes){
        if ($insert || $changedAttributes) {
            $this->updateName();
        }
        parent::afterSave($insert, $changedAttributes);

    }
    private function updateName()
    {
        $category = Category::findOne(['alias_category'=> $this->alias_category]);
        $name_1 = $category->title_short;
        $name_2 = $this->title_short;
        $name = $name_1.' - '.$name_2;
        $this->name = $name;
        $this->save();
        /*$this->update($this->id, [
            'name' => $name
        ]);*/
    }
}
