<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stock".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $date_start
 * @property string $date_end
 * @property integer $active
 * @property double $discount
 * @property string $general_photo
 * @property string $gallery_photo
 *
 * @property DetailsHasStock[] $detailsHasStocks
 * @property Details[] $details
 */
class Stock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['active'], 'integer'],
            [['discount'], 'number'],
            [['title', 'date_start', 'date_end'], 'string', 'max' => 45],
            [['description', 'general_photo', 'gallery_photo'], 'string', 'max' => 255],
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
            'date_start' => 'Date Start',
            'date_end' => 'Date End',
            'active' => 'Active',
            'discount' => 'Discount',
            'general_photo' => 'General Photo',
            'gallery_photo' => 'Gallery Photo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailsHasStocks()
    {
        return $this->hasMany(DetailsHasStock::className(), ['stock_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetails()
    {
        return $this->hasMany(Details::className(), ['id' => 'details_id'])->viaTable('details_has_stock', ['stock_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return StockQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StockQuery(get_called_class());
    }
}
