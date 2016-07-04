<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Projekat */

$this->title = $model->naziv;
$this->params['breadcrumbs'][] = ['label' => 'Projekat', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projekat-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Projekat'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'hidden' => true],
        'naziv',
        'opis',
        'datum_pocetka',
        'datum_zavrsetka',
        'krajnji_rok',
        'budzet',
        'aktivan',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
    $gridColumnUcesnikRadiNaProjektu = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'ucesnik.id',
                'label' => 'Ucesnik'
        ],
        [
                'attribute' => 'projekat.naziv',
                'label' => 'Projekat'
        ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerUcesnikRadiNaProjektu,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-ucesnik-radi-na-projektu']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Ucesnik Radi Na Projektu'.' '. $this->title),
        ],
        'columns' => $gridColumnUcesnikRadiNaProjektu
    ]);
?>
    </div>
    
    <div class="row">
<?php
    $gridColumnZadatak = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'hidden' => true],
        [
                'attribute' => 'projekat.naziv',
                'label' => 'Projekat'
        ],
        'covjek_casova',
        'procenat_dovrsenosti',
        'opis',
        'naziv',
        'datum_pocetka',
        'datum_zavrsetka',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerZadatak,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-zadatak']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Zadatak'.' '. $this->title),
        ],
        'columns' => $gridColumnZadatak
    ]);
?>
    </div>
</div>
