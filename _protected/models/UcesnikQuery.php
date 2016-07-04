<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Ucesnik]].
 *
 * @see Ucesnik
 */
class UcesnikQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Ucesnik[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Ucesnik|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}