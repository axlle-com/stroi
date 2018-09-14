<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "details_has_stock".
 *
 * @property integer $details_id
 * @property integer $stock_id
 *
 * @property Details $details
 * @property Stock $stock
 */
class DetailsHasStock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'details_has_stock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['details_id', 'stock_id'], 'required'],
            [['details_id', 'stock_id'], 'integer'],
            [['details_id'], 'exist', 'skipOnError' => true, 'targetClass' => Details::className(), 'targetAttribute' => ['details_id' => 'id']],
            [['stock_id'], 'exist', 'skipOnError' => true, 'targetClass' => Stock::className(), 'targetAttribute' => ['stock_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'details_id' => 'Details ID',
            'stock_id' => 'Stock ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetails()
    {
        return $this->hasOne(Details::className(), ['id' => 'details_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStock()
    {
        return $this->hasOne(Stock::className(), ['id' => 'stock_id']);
    }

    /**
     * @inheritdoc
     * @return DetailsHasStockQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DetailsHasStockQuery(get_called_class());
    }
}
