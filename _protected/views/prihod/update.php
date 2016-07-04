<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Prihod */

$this->title = 'Update Prihod: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Prihod', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'aktivnost_id' => $model->aktivnost_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prihod-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
