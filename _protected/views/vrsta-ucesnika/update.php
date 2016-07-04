<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\VrstaUcesnika */

$this->title = 'Update Vrsta Ucesnika: ' . ' ' . $model->naziv;
$this->params['breadcrumbs'][] = ['label' => 'Vrsta Ucesnika', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->naziv, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vrsta-ucesnika-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
