<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Zadatak]].
 *
 * @see Zadatak
 */
class ZadatakQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Zadatak[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Zadatak|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}