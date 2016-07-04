<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UcesnikRadiNaZadatku */

$this->title = 'Create Ucesnik Radi Na Zadatku';
$this->params['breadcrumbs'][] = ['label' => 'Ucesnik Radi Na Zadatku', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ucesnik-radi-na-zadatku-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
