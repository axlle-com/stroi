<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "specifically".
 *
 * @property integer $id
 * @property string $title
 * @property string $specialty
 * @property integer $extra_id
 *
 * @property Extra $extra
 * @property TypeHasSpecifically[] $typeHasSpecificallies
 * @property Type[] $types
 */
class Specifically extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'specifically';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['specialty', 'extra_id'], 'required'],
            [['extra_id'], 'integer'],
            [['title', 'specialty'], 'string', 'max' => 45],
            [['extra_id'], 'exist', 'skipOnError' => true, 'targetClass' => Extra::className(), 'targetAttribute' => ['extra_id' => 'id']],
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
            'specialty' => 'Specialty',
            'extra_id' => 'Extra ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExtra()
    {
        return $this->hasOne(Extra::className(), ['id' => 'extra_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeHasSpecificallies()
    {
        return $this->hasMany(TypeHasSpecifically::className(), ['specifically_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypes()
    {
        return $this->hasMany(Type::className(), ['id' => 'type_id'])->viaTable('type_has_specifically', ['specifically_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return SpecificallyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SpecificallyQuery(get_called_class());
    }

    public function getExtraName()
    {
        $item = $this->extra;

        return $item ? $item->markup : '';
    }

    public static function getExtraList()
    {
        $items = Extra::find()->all();

        return ArrayHelper::map($items, 'id', 'markup');
    }
}
