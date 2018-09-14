<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "type".
 *
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property string $description
 *
 * @property CalculatorHasType[] $calculatorHasTypes
 * @property Calculator[] $calculators
 * @property DetailsHasType[] $detailsHasTypes
 * @property Details[] $details
 * @property TypeHasSpecifically[] $typeHasSpecificallies
 * @property Specifically[] $specificallies
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'title'], 'required'],
            [['name', 'title'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'title' => 'Title',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalculatorHasTypes()
    {
        return $this->hasMany(CalculatorHasType::className(), ['type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalculators()
    {
        return $this->hasMany(Calculator::className(), ['id' => 'calculator_id'])->viaTable('calculator_has_type', ['type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailsHasTypes()
    {
        return $this->hasMany(DetailsHasType::className(), ['type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetails()
    {
        return $this->hasMany(Details::className(), ['id' => 'details_id'])->viaTable('details_has_type', ['type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeHasSpecificallies()
    {
        return $this->hasMany(TypeHasSpecifically::className(), ['type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecificallies()
    {
        return $this->hasMany(Specifically::className(), ['id' => 'specifically_id'])->viaTable('type_has_specifically', ['type_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return TypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TypeQuery(get_called_class());
    }
}
