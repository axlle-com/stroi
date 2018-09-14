<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Infoblock]].
 *
 * @see Infoblock
 */
class InfoblockQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Infoblock[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Infoblock|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
