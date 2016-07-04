<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UcesnikRadiNaZadatku */

$this->title = 'Update Ucesnik Radi Na Zadatku: ' . ' ' . $model->ucesnik_id;
$this->params['breadcrumbs'][] = ['label' => 'Ucesnik Radi Na Zadatku', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ucesnik_id, 'url' => ['view', 'ucesnik_id' => $model->ucesnik_id, 'zadatak_id' => $model->zadatak_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ucesnik-radi-na-zadatku-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
