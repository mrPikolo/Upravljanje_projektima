<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Prihod]].
 *
 * @see Prihod
 */
class PrihodQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Prihod[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Prihod|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}