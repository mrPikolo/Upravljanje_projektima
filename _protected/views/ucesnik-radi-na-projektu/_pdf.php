<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\UcesnikRadiNaProjektu */

$this->title = $model->ucesnik_id;
$this->params['breadcrumbs'][] = ['label' => 'Ucesnik Radi Na Projektu', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ucesnik-radi-na-projektu-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Ucesnik Radi Na Projektu'.' '. Html::encode($this->title) ?></h2>
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
                'attribute' => 'projekat.naziv',
                'label' => 'Projekat'
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
