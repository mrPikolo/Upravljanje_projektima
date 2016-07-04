<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[VrstaUcesnika]].
 *
 * @see VrstaUcesnika
 */
class VrstaUcesnikaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return VrstaUcesnika[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return VrstaUcesnika|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}