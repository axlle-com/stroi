<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Details]].
 *
 * @see Details
 */
class DetailsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Details[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Details|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
