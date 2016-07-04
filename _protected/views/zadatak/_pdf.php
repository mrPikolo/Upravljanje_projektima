<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Zadatak */

$this->title = $model->naziv;
$this->params['breadcrumbs'][] = ['label' => 'Zadatak', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zadatak-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Zadatak'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
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
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
    $gridColumnAktivnost = [
        ['class' => 'yii\grid\SerialColumn'],
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
    echo Gridview::widget([
        'dataProvider' => $providerAktivnost,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-aktivnost']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Aktivnost'.' '. $this->title),
        ],
        'columns' => $gridColumnAktivnost
    ]);
?>
    </div>
    
    <div class="row">
<?php
    $gridColumnUcesnikRadiNaZadatku = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'ucesnik.id',
                'label' => 'Ucesnik'
        ],
        [
                'attribute' => 'zadatak.naziv',
                'label' => 'Zadatak'
        ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerUcesnikRadiNaZadatku,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-ucesnik-radi-na-zadatku']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Ucesnik Radi Na Zadatku'.' '. $this->title),
        ],
        'columns' => $gridColumnUcesnikRadiNaZadatku
    ]);
?>
    </div>
</div>
