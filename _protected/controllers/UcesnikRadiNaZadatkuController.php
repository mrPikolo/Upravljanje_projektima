<?php

namespace app\controllers;

use Yii;
use app\models\UcesnikRadiNaZadatku;
use app\models\UcesnikRadiNaZadatkuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UcesnikRadiNaZadatkuController implements the CRUD actions for UcesnikRadiNaZadatku model.
 */
class UcesnikRadiNaZadatkuController extends Controller
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
     * Lists all UcesnikRadiNaZadatku models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UcesnikRadiNaZadatkuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UcesnikRadiNaZadatku model.
     * @param integer $ucesnik_id
     * @param integer $zadatak_id
     * @return mixed
     */
    public function actionView($ucesnik_id, $zadatak_id)
    {
        $model = $this->findModel($ucesnik_id, $zadatak_id);
        return $this->render('view', [
            'model' => $this->findModel($ucesnik_id, $zadatak_id),
        ]);
    }

    /**
     * Creates a new UcesnikRadiNaZadatku model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UcesnikRadiNaZadatku();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'ucesnik_id' => $model->ucesnik_id, 'zadatak_id' => $model->zadatak_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UcesnikRadiNaZadatku model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $ucesnik_id
     * @param integer $zadatak_id
     * @return mixed
     */
    public function actionUpdate($ucesnik_id, $zadatak_id)
    {
        $model = $this->findModel($ucesnik_id, $zadatak_id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'ucesnik_id' => $model->ucesnik_id, 'zadatak_id' => $model->zadatak_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UcesnikRadiNaZadatku model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $ucesnik_id
     * @param integer $zadatak_id
     * @return mixed
     */
    public function actionDelete($ucesnik_id, $zadatak_id)
    {
        $this->findModel($ucesnik_id, $zadatak_id)->deleteWithRelated();

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
     * Finds the UcesnikRadiNaZadatku model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $ucesnik_id
     * @param integer $zadatak_id
     * @return UcesnikRadiNaZadatku the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ucesnik_id, $zadatak_id)
    {
        if (($model = UcesnikRadiNaZadatku::findOne(['ucesnik_id' => $ucesnik_id, 'zadatak_id' => $zadatak_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
