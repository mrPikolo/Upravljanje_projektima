<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\VrstaUcesnika */

$this->title = $model->naziv;
$this->params['breadcrumbs'][] = ['label' => 'Vrsta Ucesnika', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vrsta-ucesnika-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Vrsta Ucesnika'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'hidden' => true],
        'naziv',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
    $gridColumnUcesnik = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'hidden' => true],
        [
                'attribute' => 'user.id',
                'label' => 'User'
        ],
        [
                'attribute' => 'vrstaUcesnika.naziv',
                'label' => 'Vrsta Ucesnika'
        ],
        'ime',
        'prezime',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerUcesnik,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-ucesnik']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Ucesnik'.' '. $this->title),
        ],
        'columns' => $gridColumnUcesnik
    ]);
?>
    </div>
</div>
