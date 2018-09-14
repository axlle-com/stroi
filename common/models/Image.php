<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property integer $id
 * @property integer $folder_id
 * @property string $title
 * @property string $alt
 * @property string $description
 * @property string $link
 * @property integer $watermark
 * @property integer $small_img
 * @property integer $tumb_img
 * @property string $general_photo
 *
 * @property Folder $folder
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }
    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios['step2'] = ['general_photo'];

        return $scenarios;
    }

    public function afterSave(){
        Yii::$app->locator->cache->set('id',$this->id);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['folder_id'], 'required'],
            [['folder_id', 'watermark', 'small_img', 'tumb_img'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['alt'], 'string', 'max' => 45],
            [['description', 'link', 'general_photo'], 'string', 'max' => 255],
            [['folder_id'], 'exist', 'skipOnError' => true, 'targetClass' => Folder::className(), 'targetAttribute' => ['folder_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'folder_id' => 'Folder ID',
            'title' => 'Title',
            'alt' => 'Alt',
            'description' => 'Description',
            'link' => 'Link',
            'watermark' => 'Watermark',
            'small_img' => 'Small Img',
            'tumb_img' => 'Tumb Img',
            'general_photo' => 'General Photo',
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
     * @inheritdoc
     * @return ImageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImageQuery(get_called_class());
    }
}
