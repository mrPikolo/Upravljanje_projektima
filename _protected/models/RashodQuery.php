<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Rashod]].
 *
 * @see Rashod
 */
class RashodQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Rashod[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Rashod|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}