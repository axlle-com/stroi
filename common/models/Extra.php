<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "extra".
 *
 * @property integer $id
 * @property integer $markup
 *
 * @property Specifically[] $specificallies
 */
class Extra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'extra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['markup'], 'required'],
            [['markup'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'markup' => 'Markup',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecificallies()
    {
        return $this->hasMany(Specifically::className(), ['extra_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ExtraQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ExtraQuery(get_called_class());
    }
}
