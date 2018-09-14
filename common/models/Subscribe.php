<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "subscribe".
 *
 * @property integer $id
 * @property string $email
 * @property integer $created_at
 */
class Subscribe extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscribe';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['created_at'], 'safe'],
            [['email'], 'string', 'max' => 45],
            [['email'], 'unique'],
            ['email', 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @inheritdoc
     * @return SubscribeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SubscribeQuery(get_called_class());
    }
}
