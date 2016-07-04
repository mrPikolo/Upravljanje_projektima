<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Zadatak */

$this->title = 'Update Zadatak: ' . ' ' . $model->naziv;
$this->params['breadcrumbs'][] = ['label' => 'Zadatak', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->naziv, 'url' => ['view', 'id' => $model->id, 'projekat_id' => $model->projekat_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="zadatak-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
