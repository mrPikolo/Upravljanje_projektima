<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Aktivnost */

$this->title = $model->naziv;
$this->params['breadcrumbs'][] = ['label' => 'Aktivnost', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aktivnost-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Aktivnost'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'hidden' => true],
        [
                'attribute' => 'ucesnik.id',
                'label' => 'Ucesnik'
        ],
        [
                'attribute' => 'zadatak.naziv',
                'label' => 'Zadatak'
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
    
    <div class="row">
<?php
    $gridColumnPrihod = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'hidden' => true],
        [
                'attribute' => 'aktivnost.naziv',
                'label' => 'Aktivnost'
        ],
        'iznos',
        'datum',
        'opis',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerPrihod,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-prihod']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Prihod'.' '. $this->title),
        ],
        'columns' => $gridColumnPrihod
    ]);
?>
    </div>
    
    <div class="row">
<?php
    $gridColumnRashod = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'hidden' => true],
        [
                'attribute' => 'aktivnost.naziv',
                'label' => 'Aktivnost'
        ],
        'iznos',
        'datum',
        'opis',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerRashod,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-rashod']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Rashod'.' '. $this->title),
        ],
        'columns' => $gridColumnRashod
    ]);
?>
    </div>
</div>
