<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Zadatak */

$this->title = 'Create Zadatak';
$this->params['breadcrumbs'][] = ['label' => 'Zadatak', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zadatak-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
