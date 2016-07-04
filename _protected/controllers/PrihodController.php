<?php

namespace app\controllers;

use Yii;
use app\models\Prihod;
use app\models\PrihodSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PrihodController implements the CRUD actions for Prihod model.
 */
class PrihodController extends Controller
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
     * Lists all Prihod models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PrihodSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Prihod model.
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
     * Creates a new Prihod model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Prihod();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id, 'aktivnost_id' => $model->aktivnost_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Prihod model.
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
     * Deletes an existing Prihod model.
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
     * Finds the Prihod model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $aktivnost_id
     * @return Prihod the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $aktivnost_id)
    {
        if (($model = Prihod::findOne(['id' => $id, 'aktivnost_id' => $aktivnost_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
