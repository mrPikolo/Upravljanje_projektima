<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Rashod */

$this->title = 'Update Rashod: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rashod', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'aktivnost_id' => $model->aktivnost_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rashod-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
