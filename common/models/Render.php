<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "render".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Category[] $categories
 * @property Item[] $items
 */
class Render extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'render';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 45],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['render_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['render_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return RenderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RenderQuery(get_called_class());
    }
}
