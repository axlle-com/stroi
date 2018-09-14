<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ItemHasUser]].
 *
 * @see ItemHasUser
 */
class ItemHasUserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ItemHasUser[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ItemHasUser|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
