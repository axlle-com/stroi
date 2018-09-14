<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Folder]].
 *
 * @see Folder
 */
class FolderQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Folder[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Folder|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
