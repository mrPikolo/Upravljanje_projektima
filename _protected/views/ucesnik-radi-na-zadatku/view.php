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
        <div class="col-sm-3" style="margin-top: 15px">
            <?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . 'PDF', 
                ['pdf', 'id' => $model['ucesnik_id']],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => 'Will open the generated PDF file in a new window'
                ]
            )?>                        
            <?= Html::a('Update', ['update', 'ucesnik_id' => $model->ucesnik_id, 'zadatak_id' => $model->zadatak_id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'ucesnik_id' => $model->ucesnik_id, 'zadatak_id' => $model->zadatak_id], [
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
        [
            'attribute' => 'ucesnik.id',
            'label' => 'Ucesnik',
        ],
        [
            'attribute' => 'zadatak.naziv',
            'label' => 'Zadatak',
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>