<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "details".
 *
 * @property integer $id
 * @property integer $item_id
 * @property string $name
 * @property string $material
 * @property string $initial_size
 * @property string $square
 * @property integer $room
 * @property integer $floor
 * @property integer $mansard
 * @property integer $balcony
 * @property integer $krilco
 * @property integer $garage
 * @property integer $erker
 * @property integer $dacha
 * @property integer $original_price
 * @property integer $time_build
 *
 * @property Item $item
 * @property DetailsHasStock[] $detailsHasStocks
 * @property Stock[] $stocks
 * @property DetailsHasType[] $detailsHasTypes
 * @property Type[] $types
 */
class Details extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'name', 'material', 'initial_size', 'square', 'room', 'floor', 'original_price'], 'required'],
            [['item_id', 'square', 'room', 'floor', 'mansard', 'balcony', 'krilco', 'garage', 'erker', 'dacha', 'original_price', 'time_build'], 'integer'],
            [['name', 'same_item'], 'string', 'max' => 255],
            [['typeArray'], 'safe'],
            [['material', 'initial_size'], 'string', 'max' => 45],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_id' => 'Статья',
            'name' => 'Артикул',
            'same_item' => 'Похожий проект',
            'material' => 'Материал проекта',
            'initial_size' => 'Начальный размер',
            'square' => 'Площадь',
            'room' => 'Количество комнат',
            'floor' => 'Количество этажей',
            'mansard' => 'Есть мансарда?',
            'balcony' => 'Есть балкон?',
            'krilco' => 'Есть крыльцо?',
            'garage' => 'Есть гараж?',
            'erker' => 'Есть эркер?',
            'dacha' => 'Дачная постройка?',
            'original_price' => 'Цена',
            'time_build' => 'Срок строительства',
            'typeArray' => 'Типы',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailsHasStocks()
    {
        return $this->hasMany(DetailsHasStock::className(), ['details_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStocks()
    {
        return $this->hasMany(Stock::className(), ['id' => 'stock_id'])->viaTable('details_has_stock', ['details_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailsHasTypes()
    {
        return $this->hasMany(DetailsHasType::className(), ['details_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypes()
    {
        return $this->hasMany(Type::className(), ['id' => 'type_id'])->viaTable('details_has_type', ['details_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return DetailsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DetailsQuery(get_called_class());
    }
    public function getItemName()
    {
        $name = $this->item;

        return $name ? $name->title : '';
    }
    public function getSameItemName()
    {
        $name = Item::find()->where(['id' =>$this->same_item])->one();

        return $name ? $name->title : '';
    }
    public static function getItemList()
    {
        $names = Item::find()->all();

        return ArrayHelper::map($names, 'id', 'title');
    }

    public function getTypeName()
    {
        $name = $this->material;

        return $name ? $name->material : '';
    }

    public static function getTypeList()
    {
        $names = Type::find()->all();

        return ArrayHelper::map($names, 'name', 'name');
    }

    private $_typeArray;

    public function getTypeArray()
    {
        if ($this->_typeArray === null) {
            $this->_typeArray = $this->getTypes()->select('id')->column();
        }
        return $this->_typeArray;
    }

    public function setTypeArray($value)
    {
        $this->_typeArray = (array)$value;
    }

    public function afterSave($insert, $changedAttributes){
        $this->updateTypes();
        parent::afterSave($insert, $changedAttributes);
    }

    private function updateTypes()
    {
        $currentTypeIds = $this->getTypes()->select('id')->column();
        $newTypeIds = $this->getTypeArray();

        foreach (array_filter(array_diff($newTypeIds, $currentTypeIds)) as $typeId) {
            /** @var Infoblock $infoblock */
            if ($type = Type::findOne($typeId)) {
                $this->link('types', $type);
            }
        }

        foreach (array_filter(array_diff($currentTypeIds, $newTypeIds)) as $typeId) {
            /** @var Infoblock $infoblock */
            if ($type = Type::findOne($typeId)) {
                $this->unlink('types', $type, true);
            }
        }
    }
}
