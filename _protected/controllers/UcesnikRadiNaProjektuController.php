<?php

namespace app\controllers;

use Yii;
use app\models\UcesnikRadiNaProjektu;
use app\models\UcesnikRadiNaProjektuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UcesnikRadiNaProjektuController implements the CRUD actions for UcesnikRadiNaProjektu model.
 */
class UcesnikRadiNaProjektuController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update','delete'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => false
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all UcesnikRadiNaProjektu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UcesnikRadiNaProjektuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UcesnikRadiNaProjektu model.
     * @param integer $ucesnik_id
     * @param integer $projekat_id
     * @return mixed
     */
    public function actionView($ucesnik_id, $projekat_id)
    {
        $model = $this->findModel($ucesnik_id, $projekat_id);
        return $this->render('view', [
            'model' => $this->findModel($ucesnik_id, $projekat_id),
        ]);
    }

    /**
     * Creates a new UcesnikRadiNaProjektu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UcesnikRadiNaProjektu();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'ucesnik_id' => $model->ucesnik_id, 'projekat_id' => $model->projekat_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UcesnikRadiNaProjektu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $ucesnik_id
     * @param integer $projekat_id
     * @return mixed
     */
    public function actionUpdate($ucesnik_id, $projekat_id)
    {
        $model = $this->findModel($ucesnik_id, $projekat_id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'ucesnik_id' => $model->ucesnik_id, 'projekat_id' => $model->projekat_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UcesnikRadiNaProjektu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $ucesnik_id
     * @param integer $projekat_id
     * @return mixed
     */
    public function actionDelete($ucesnik_id, $projekat_id)
    {
        $this->findModel($ucesnik_id, $projekat_id)->deleteWithRelated();

        return $this->redirect(['index']);
    }
    
    /**
     * 
     * for export pdf at actionView
     *  
     * @param type $id
     * @return type
     */
    public function actionPdf($id) {
        $model = $this->findModel($id);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
        ]);

        $pdf = new \kartik\mpdf\Pdf([
            'mode' => \kartik\mpdf\Pdf::MODE_CORE,
            'format' => \kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}',
            'options' => ['title' => \Yii::$app->name],
            'methods' => [
                'SetHeader' => [\Yii::$app->name],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        return $pdf->render();
    }
    
    /**
     * Finds the UcesnikRadiNaProjektu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $ucesnik_id
     * @param integer $projekat_id
     * @return UcesnikRadiNaProjektu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ucesnik_id, $projekat_id)
    {
        if (($model = UcesnikRadiNaProjektu::findOne(['ucesnik_id' => $ucesnik_id, 'projekat_id' => $projekat_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
