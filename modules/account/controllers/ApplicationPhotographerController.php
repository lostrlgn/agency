<?php

namespace app\modules\account\controllers;

use app\models\ApplicationPhotographer;
use app\models\City;
use app\models\RegisterExpert;
use app\models\StatusReception;
use app\models\Type;
use app\modules\account\models\ApplicationPhotographerSearch;
use Yii;
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
        $model = new RegisterExpert();
        $cityes = City::getCityes();
        $types = Type::getTypes();


        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->register()) {
                return $this->goHome();
            }
        }
        return $this->render('create', [
            'model' => $model,
            'types' => $types,
            'cityes' => $cityes,

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
    public function actionCheckApplication()
    {
        $userId = Yii::$app->user->id;
        $application = ApplicationPhotographer::find()
            ->where([
                'user_id' => $userId,
            ])
            ->one();

        if ($application) {
            if ($application->status_reception_id == StatusReception::getStatusId('На рассмотрение') || $application->status_reception_id == StatusReception::getStatusId('Новая')) {
                return $this->redirect(['view', 'id' => $application->id]);
            }
        }

        return $this->redirect(['create']);
    }
}
