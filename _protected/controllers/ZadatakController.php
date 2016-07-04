<?php

namespace app\controllers;

use Yii;
use app\models\Zadatak;
use app\models\ZadatakSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ZadatakController implements the CRUD actions for Zadatak model.
 */
class ZadatakController extends Controller
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
     * Lists all Zadatak models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ZadatakSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Zadatak model.
     * @param integer $id
     * @param integer $projekat_id
     * @return mixed
     */
    public function actionView($id, $projekat_id)
    {
        $model = $this->findModel($id, $projekat_id);
        $providerAktivnost = new \yii\data\ArrayDataProvider([
            'allModels' => $model->aktivnosts,
        ]);
        $providerUcesnikRadiNaZadatku = new \yii\data\ArrayDataProvider([
            'allModels' => $model->ucesnikRadiNaZadatkus,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id, $projekat_id),
            'providerAktivnost' => $providerAktivnost,
            'providerUcesnikRadiNaZadatku' => $providerUcesnikRadiNaZadatku,
        ]);
    }

    /**
     * Creates a new Zadatak model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Zadatak();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id, 'projekat_id' => $model->projekat_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Zadatak model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $projekat_id
     * @return mixed
     */
    public function actionUpdate($id, $projekat_id)
    {
        $model = $this->findModel($id, $projekat_id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id, 'projekat_id' => $model->projekat_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Zadatak model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $projekat_id
     * @return mixed
     */
    public function actionDelete($id, $projekat_id)
    {
        $this->findModel($id, $projekat_id)->deleteWithRelated();

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
        $providerAktivnost = new \yii\data\ArrayDataProvider([
            'allModels' => $model->aktivnosts,
        ]);
        $providerUcesnikRadiNaZadatku = new \yii\data\ArrayDataProvider([
            'allModels' => $model->ucesnikRadiNaZadatkus,
        ]);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
            'providerAktivnost' => $providerAktivnost,
            'providerUcesnikRadiNaZadatku' => $providerUcesnikRadiNaZadatku,
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
     * Finds the Zadatak model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $projekat_id
     * @return Zadatak the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $projekat_id)
    {
        if (($model = Zadatak::findOne(['id' => $id, 'projekat_id' => $projekat_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for Aktivnost
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddAktivnost()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('Aktivnost');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('action') == 'load' && empty($row)) || Yii::$app->request->post('action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formAktivnost', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for UcesnikRadiNaZadatku
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddUcesnikRadiNaZadatku()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('UcesnikRadiNaZadatku');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('action') == 'load' && empty($row)) || Yii::$app->request->post('action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formUcesnikRadiNaZadatku', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
