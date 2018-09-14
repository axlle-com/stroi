<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "details_has_type".
 *
 * @property integer $details_id
 * @property integer $type_id
 *
 * @property Details $details
 * @property Type $type
 */
class DetailsHasType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'details_has_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['details_id', 'type_id'], 'required'],
            [['details_id', 'type_id'], 'integer'],
            [['details_id'], 'exist', 'skipOnError' => true, 'targetClass' => Details::className(), 'targetAttribute' => ['details_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'details_id' => 'Артикул проекта',
            'type_id' => 'Дополнительно для этого проекта',
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
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }

    /**
     * @inheritdoc
     * @return DetailsHasTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DetailsHasTypeQuery(get_called_class());
    }

    public function getDetailsName()
    {
        $details = $this->details;

        return $details ? $details->name : '';
    }

    public static function getDetailsList()
    {
        $details = Details::find()->all();

        return ArrayHelper::map($details, 'id', 'name');
    }

    public function getTypeName()
    {
        $type = $this->type;

        return $type ? $type->title : '';
    }

    public static function getTypeList()
    {
        $type = Type::find()->all();

        return ArrayHelper::map($type, 'id', 'title');
    }
}
