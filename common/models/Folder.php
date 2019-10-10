<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "folder".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $link
 * @property integer $show_img
 * @property integer $watermark
 * @property integer $small_img
 * @property integer $tumb_img
 * @property string $general_photo
 *
 * @property FolderHasItem[] $folderHasItems
 * @property Item[] $items
 * @property Image[] $images
 */
class Folder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'folder';
    }
    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios['step2'] = ['general_photo'];

        return $scenarios;
    }

    public function afterSave($insert, $changedAttributes){
        Yii::$app->locator->cache->set('id_folder',$this->id);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['show_img', 'watermark', 'small_img', 'tumb_img'], 'integer'],
            [['title'], 'string', 'max' => 45],
            [['description', 'general_photo'], 'string', 'max' => 255],
            [['link'], 'string', 'max' => 150],
            [['title'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'link' => 'Link',
            'show_img' => 'Show Img',
            'watermark' => 'Watermark',
            'small_img' => 'Small Img',
            'tumb_img' => 'Tumb Img',
            'general_photo' => 'General Photo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFolderHasItems()
    {
        return $this->hasMany(FolderHasItem::className(), ['folder_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['id' => 'item_id'])->viaTable('folder_has_item', ['folder_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['folder_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return FolderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FolderQuery(get_called_class());
    }
}
