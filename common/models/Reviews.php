<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reviews".
 *
 * @property integer $id
 * @property string $category_id
 * @property string $data
 * @property string $place
 * @property string $name
 * @property string $title
 * @property string $description
 * @property integer $positively
 * @property string $media
 * @property integer $show_img
 * @property integer $watermark
 * @property integer $small_img
 * @property integer $tumb_img
 * @property string $general_photo
 * @property string $data_rev
 * @property string $name_rev
 * @property string $title_rev
 * @property string $description_rev
 *
 * @property Category $category
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reviews';
    }
    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios['step2'] = ['general_photo'];

        return $scenarios;
    }

    public function afterSave($insert, $changedAttributes){
        Yii::$app->locator->cache->set('id_image',$this->id);

        parent::afterSave($insert, $changedAttributes);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id'], 'required'],
            [['category_id', 'positively', 'show_img', 'watermark', 'small_img', 'tumb_img'], 'integer'],
            [['data', 'data_rev'], 'safe'],
            [['description', 'description_rev'], 'string'],
            [['place', 'name', 'title', 'media', 'general_photo', 'name_rev', 'title_rev'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'data' => 'Data',
            'place' => 'Place',
            'name' => 'Name',
            'title' => 'Title',
            'description' => 'Description',
            'positively' => 'Positively',
            'media' => 'Media',
            'show_img' => 'Show Img',
            'watermark' => 'Watermark',
            'small_img' => 'Small Img',
            'tumb_img' => 'Tumb Img',
            'general_photo' => 'General Photo',
            'data_rev' => 'Data Rev',
            'name_rev' => 'Name Rev',
            'title_rev' => 'Title Rev',
            'description_rev' => 'Description Rev',
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
     * @inheritdoc
     * @return ReviewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReviewsQuery(get_called_class());
    }
}
