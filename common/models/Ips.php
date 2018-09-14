<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ips".
 *
 * @property integer $id
 * @property string $host
 * @property string $person
 * @property string $phone
 * @property string $email
 * @property string $description
 * @property integer $black
 * @property integer $block
 *
 * @property History[] $histories
 */
class Ips extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ips';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['host'], 'required'],
            [['description'], 'string'],
            [['black', 'block'], 'integer'],
            [['host'], 'string', 'max' => 45],
            [['person'], 'string', 'max' => 255],
            [['phone', 'email'], 'string', 'max' => 155],
            [['host'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'host' => 'Host',
            'person' => 'Person',
            'phone' => 'Phone',
            'email' => 'Email',
            'description' => 'Description',
            'black' => 'Black',
            'block' => 'Block',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistories()
    {
        return $this->hasMany(History::className(), ['ips_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return IpsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IpsQuery(get_called_class());
    }
}
