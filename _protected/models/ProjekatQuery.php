<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Projekat]].
 *
 * @see Projekat
 */
class ProjekatQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Projekat[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Projekat|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}