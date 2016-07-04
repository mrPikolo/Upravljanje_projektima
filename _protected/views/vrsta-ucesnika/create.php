<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\VrstaUcesnika */

$this->title = 'Create Vrsta Ucesnika';
$this->params['breadcrumbs'][] = ['label' => 'Vrsta Ucesnika', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vrsta-ucesnika-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
