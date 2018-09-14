<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "infoblock_has_item".
 *
 * @property integer $infoblock_id
 * @property integer $item_id
 *
 * @property Infoblock $infoblock
 * @property Item $item
 */
class InfoblockHasItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'infoblock_has_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['infoblock_id', 'item_id'], 'required'],
            [['infoblock_id', 'item_id'], 'integer'],
            [['infoblock_id'], 'exist', 'skipOnError' => true, 'targetClass' => Infoblock::className(), 'targetAttribute' => ['infoblock_id' => 'id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'infoblock_id' => 'Infoblock ID',
            'item_id' => 'Item ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInfoblock()
    {
        return $this->hasOne(Infoblock::className(), ['id' => 'infoblock_id']);
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
     * @return InfoblockHasItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InfoblockHasItemQuery(get_called_class());
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

    public function getInfoName()
    {
        $type = $this->infoblock;

        return $type ? $type->title : '';
    }

    public static function getInfoList()
    {
        $type = Infoblock::find()->all();

        return ArrayHelper::map($type, 'id', 'title');
    }
}
