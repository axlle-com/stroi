<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TagsHasItem]].
 *
 * @see TagsHasItem
 */
class TagsHasItemQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TagsHasItem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TagsHasItem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
