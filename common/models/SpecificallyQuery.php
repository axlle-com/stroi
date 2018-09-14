<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Specifically]].
 *
 * @see Specifically
 */
class SpecificallyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Specifically[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Specifically|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
