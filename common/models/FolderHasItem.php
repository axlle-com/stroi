<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "folder_has_item".
 *
 * @property integer $folder_id
 * @property integer $item_id
 *
 * @property Folder $folder
 * @property Item $item
 */
class FolderHasItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'folder_has_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['folder_id', 'item_id'], 'required'],
            [['folder_id', 'item_id'], 'integer'],
            [['folder_id'], 'exist', 'skipOnError' => true, 'targetClass' => Folder::className(), 'targetAttribute' => ['folder_id' => 'id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'folder_id' => 'Folder ID',
            'item_id' => 'Item ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFolder()
    {
        return $this->hasOne(Folder::className(), ['id' => 'folder_id']);
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
     * @return FolderHasItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FolderHasItemQuery(get_called_class());
    }
    public function getItemsName()
    {
        $details = $this->item;

        return $details ? $details->title : '';
    }
    public static function getItemsList()
    {
        $details = Item::find()->all();

        return ArrayHelper::map($details, 'id', 'title');
    }
    public function getFolderName()
    {
        $details = $this->folder;

        return $details ? $details->title : '';
    }
    public static function getFolderList()
    {
        $details = Folder::find()->all();

        return ArrayHelper::map($details, 'id', 'title');
    }
}