<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Ips]].
 *
 * @see Ips
 */
class IpsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Ips[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Ips|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
