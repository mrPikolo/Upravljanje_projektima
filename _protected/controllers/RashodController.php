<?php

namespace app\controllers;

use Yii;
use app\models\Rashod;
use app\models\RashodSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RashodController implements the CRUD actions for Rashod model.
 */
class RashodController extends Controller
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
     * Lists all Rashod models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RashodSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rashod model.
     * @param integer $id
     * @param integer $aktivnost_id
     * @return mixed
     */
    public function actionView($id, $aktivnost_id)
    {
        $model = $this->findModel($id, $aktivnost_id);
        return $this->render('view', [
            'model' => $this->findModel($id, $aktivnost_id),
        ]);
    }

    /**
     * Creates a new Rashod model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rashod();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id, 'aktivnost_id' => $model->aktivnost_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Rashod model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $aktivnost_id
     * @return mixed
     */
    public function actionUpdate($id, $aktivnost_id)
    {
        $model = $this->findModel($id, $aktivnost_id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id, 'aktivnost_id' => $model->aktivnost_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Rashod model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $aktivnost_id
     * @return mixed
     */
    public function actionDelete($id, $aktivnost_id)
    {
        $this->findModel($id, $aktivnost_id)->deleteWithRelated();

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
     * Finds the Rashod model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $aktivnost_id
     * @return Rashod the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $aktivnost_id)
    {
        if (($model = Rashod::findOne(['id' => $id, 'aktivnost_id' => $aktivnost_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
