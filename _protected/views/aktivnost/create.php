<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Aktivnost */

$this->title = 'Create Aktivnost';
$this->params['breadcrumbs'][] = ['label' => 'Aktivnost', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aktivnost-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
