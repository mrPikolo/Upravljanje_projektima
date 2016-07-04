<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Aktivnost */

?>
<div class="aktivnost-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->naziv) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'hidden' => true],
        [
            'attribute' => 'ucesnik.id',
            'label' => 'Ucesnik',
        ],
        [
            'attribute' => 'zadatak.naziv',
            'label' => 'Zadatak',
        ],
        'naziv',
        'opis',
        'utroseno_vrijeme',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>