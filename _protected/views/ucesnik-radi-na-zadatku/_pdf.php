<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\UcesnikRadiNaZadatku */

$this->title = $model->ucesnik_id;
$this->params['breadcrumbs'][] = ['label' => 'Ucesnik Radi Na Zadatku', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ucesnik-radi-na-zadatku-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Ucesnik Radi Na Zadatku'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        [
                'attribute' => 'ucesnik.id',
                'label' => 'Ucesnik'
        ],
        [
                'attribute' => 'zadatak.naziv',
                'label' => 'Zadatak'
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
