<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Rashod */

$this->title = 'Create Rashod';
$this->params['breadcrumbs'][] = ['label' => 'Rashod', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rashod-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
