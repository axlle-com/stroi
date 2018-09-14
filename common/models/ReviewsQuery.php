<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Reviews]].
 *
 * @see Reviews
 */
class ReviewsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Reviews[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Reviews|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
