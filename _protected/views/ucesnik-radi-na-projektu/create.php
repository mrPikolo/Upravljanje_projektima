<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UcesnikRadiNaProjektu */

$this->title = 'Create Ucesnik Radi Na Projektu';
$this->params['breadcrumbs'][] = ['label' => 'Ucesnik Radi Na Projektu', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ucesnik-radi-na-projektu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
