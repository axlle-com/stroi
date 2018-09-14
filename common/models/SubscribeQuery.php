<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Subscribe]].
 *
 * @see Subscribe
 */
class SubscribeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Subscribe[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Subscribe|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
