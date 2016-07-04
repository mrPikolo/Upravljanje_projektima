<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Projekat */

$this->title = 'Update Projekat: ' . ' ' . $model->naziv;
$this->params['breadcrumbs'][] = ['label' => 'Projekat', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->naziv, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="projekat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
