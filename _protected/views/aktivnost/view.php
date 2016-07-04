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
        <div class="col-sm-3" style="margin-top: 15px">
            <?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . 'PDF', 
                ['pdf', 'id' => $model['id']],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => 'Will open the generated PDF file in a new window'
                ]
            )?>                        
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
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
    
    <div class="row">
<?php
if($providerPrihod->totalCount){
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
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Prihod'.' '. $this->title),
        ],
        'columns' => $gridColumnPrihod
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerRashod->totalCount){
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
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Rashod'.' '. $this->title),
        ],
        'columns' => $gridColumnRashod
    ]);
}
?>
    </div>
</div>