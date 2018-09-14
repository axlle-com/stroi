<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Extra]].
 *
 * @see Extra
 */
class ExtraQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Extra[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Extra|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
