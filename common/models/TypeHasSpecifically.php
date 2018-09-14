<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "type_has_specifically".
 *
 * @property integer $type_id
 * @property integer $specifically_id
 *
 * @property Type $type
 * @property Specifically $specifically
 */
class TypeHasSpecifically extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type_has_specifically';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'specifically_id'], 'required'],
            [['type_id', 'specifically_id'], 'integer'],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['specifically_id'], 'exist', 'skipOnError' => true, 'targetClass' => Specifically::className(), 'targetAttribute' => ['specifically_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'type_id' => 'Type ID',
            'specifically_id' => 'Specifically ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecifically()
    {
        return $this->hasOne(Specifically::className(), ['id' => 'specifically_id']);
    }

    /**
     * @inheritdoc
     * @return TypeHasSpecificallyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TypeHasSpecificallyQuery(get_called_class());
    }

    public function getTypeName()
    {
        $type = $this->type;

        return $type ? $type->name : '';
    }

    public static function getTypeList()
    {
        $type = Type::find()->all();

        return ArrayHelper::map($type, 'id', 'name');
    }

    public function getSpecName()
    {
        $type = $this->specifically;

        return $type ? $type->specialty : '';
    }

    public static function getSpecList()
    {
        $type = Specifically::find()->all();

        return ArrayHelper::map($type, 'id', 'specialty');
    }
}
