<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tags_has_item".
 *
 * @property integer $tags_id
 * @property integer $item_id
 *
 * @property Tags $tags
 * @property Item $item
 */
class TagsHasItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tags_has_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tags_id', 'item_id'], 'required'],
            [['tags_id', 'item_id'], 'integer'],
            [['tags_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tags::className(), 'targetAttribute' => ['tags_id' => 'id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tags_id' => 'Tags ID',
            'item_id' => 'Item ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasOne(Tags::className(), ['id' => 'tags_id']);
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
     * @return TagsHasItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TagsHasItemQuery(get_called_class());
    }

    public function getItemName()
    {
        $item = $this->item;

        return $item ? $item->title : '';
    }

    public static function getItemList()
    {
        $item = Item::find()->all();

        return ArrayHelper::map($item, 'id', 'title');
    }

    public function getTagsName()
    {
        $type = $this->tags;

        return $type ? $type->name : '';
    }

    public static function getTagsList()
    {
        $type = Tags::find()->all();

        return ArrayHelper::map($type, 'id', 'name');
    }
}
