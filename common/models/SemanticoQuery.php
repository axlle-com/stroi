<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Semantico]].
 *
 * @see Semantico
 */
class SemanticoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Semantico[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Semantico|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
