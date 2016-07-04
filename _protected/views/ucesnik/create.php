<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ucesnik */

$this->title = 'Create Ucesnik';
$this->params['breadcrumbs'][] = ['label' => 'Ucesnik', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ucesnik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
