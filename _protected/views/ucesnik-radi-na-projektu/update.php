<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UcesnikRadiNaProjektu */

$this->title = 'Update Ucesnik Radi Na Projektu: ' . ' ' . $model->ucesnik_id;
$this->params['breadcrumbs'][] = ['label' => 'Ucesnik Radi Na Projektu', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ucesnik_id, 'url' => ['view', 'ucesnik_id' => $model->ucesnik_id, 'projekat_id' => $model->projekat_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ucesnik-radi-na-projektu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
