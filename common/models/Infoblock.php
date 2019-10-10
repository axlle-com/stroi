<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "infoblock".
 *
 * @property integer $id
 * @property integer $published
 * @property integer $favourites
 * @property integer $show_img
 * @property integer $watermark
 * @property integer $small_img
 * @property integer $tumb_img
 * @property string $name
 * @property string $title
 * @property string $description
 * @property string $purified_text
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $date_pub
 * @property string $date_end
 * @property string $general_photo
 *
 * @property InfoblockHasItem[] $infoblockHasItems
 * @property Item[] $items
 */
class Infoblock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'infoblock';
    }
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /*public function afterFind()
    {
        if(!$this->purified_text && $this->description)
        {
            $this->purified_text = strip_tags($this->description);
            $this->update($this->id, [
                'purified_text' => $this->purified_text
            ]);
        }
        parent::afterFind();
    }*/
    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios['step2'] = ['general_photo'];

        return $scenarios;
    }

    public function afterSave($insert, $changedAttributes){
        Yii::$app->locator->cache->set('id_image',$this->id);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['published', 'favourites', 'show_img', 'watermark', 'small_img', 'tumb_img', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'required'],
            [['description', 'purified_text'], 'string'],
            [['date_pub', 'date_end'], 'safe'],
            [['name'], 'string', 'max' => 45],
            [['title', 'general_photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'published' => 'Published',
            'favourites' => 'Favourites',
            'show_img' => 'Show Img',
            'watermark' => 'Watermark',
            'small_img' => 'Small Img',
            'tumb_img' => 'Tumb Img',
            'name' => 'Name',
            'title' => 'Title',
            'description' => 'Description',
            'purified_text' => 'Purified Text',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'date_pub' => 'Date Pub',
            'date_end' => 'Date End',
            'general_photo' => 'General Photo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInfoblockHasItems()
    {
        return $this->hasMany(InfoblockHasItem::className(), ['infoblock_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['id' => 'item_id'])->viaTable('infoblock_has_item', ['infoblock_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return InfoblockQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InfoblockQuery(get_called_class());
    }
}
