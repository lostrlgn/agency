<?php

namespace app\modules\admin\controllers;

use app\models\ApplicationPhotographer;
use app\models\Photographer;
use app\models\PhotographerTypes;
use app\models\Position;
use app\models\Role;
use app\models\StatusReception;
use app\modules\admin\models\ApplicationPhotographerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ApplicationPhotographerController implements the CRUD actions for ApplicationPhotographer model.
 */
class ApplicationPhotographerController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all ApplicationPhotographer models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ApplicationPhotographerSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ApplicationPhotographer model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ApplicationPhotographer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ApplicationPhotographer();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ApplicationPhotographer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ApplicationPhotographer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ApplicationPhotographer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ApplicationPhotographer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ApplicationPhotographer::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionCancel($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($model->status_reception_id == StatusReception::getStatusId('Новая')) {
                if ($model->status_reception_id = StatusReception::getStatusId('Отказать')) {
                    $model->scenario = ApplicationPhotographer::SCENARIO_CANCEL;
                }
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
                
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionApply($id) 
    {
        $model = $this->findModel($id);

        if ($model->status_reception_id == StatusReception::getStatusId('Новая')) {
            if ($model->status_reception_id = StatusReception::getStatusId('На собеседование')) {
                if ($model->save()) {
                    
                }
            }
        }
        return $this->redirect(['index']);
    }
    public function actionHired($id) 
    {
        $model = $this->findModel($id);
        $photographer = new Photographer();
        $photographerTypes = new PhotographerTypes();

        if ($model->status_reception_id == StatusReception::getStatusId('На собеседование')) {
            if ($model->status_reception_id = StatusReception::getStatusId('Принят')) {
                if ($model->user->role_id = Role::getRoleId('expert')) {
                    $photographer->attributes = $model->attributes;
                    $photographer->position_id = Position::getPositionId('Нанят');

                    $photographerTypes->attributes = $model->attributes;
                    
                    if ($model->save() && $model->user->save() && $photographer->save()) { 
                        $photographerTypes->photograpger_id = $photographer->id;
                        if ($photographerTypes->save()) {

                        }
                        
                                
                    }  
                }
            }
        }
        return $this->redirect(['index']);
    }
    public function actionFired($id) 
    {
        $model = $this->findModel($id);

        if ($model->status_reception_id == StatusReception::getStatusId('На собеседование')) {
            if ($model->status_reception_id = StatusReception::getStatusId('Не принят')) {
                if ($model->save()) {
                    
                }
            }
        }
        return $this->redirect(['index']);
    }
    
}
