<?php

namespace app\controllers;

use Yii;
use webvimark\modules\UserManagement\models\User;
use app\models\Feedback;
use app\models\FeedbackSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * FeedbackController implements the CRUD actions for Feedback model.
 */
class FeedbackController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'roles' => ['@'], // Basta estar logado para acessar as ações.
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Feedback models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!User::hasPermission('view_Feedback', $superAdminAllowed = true)) {
            throw new ForbiddenHttpException('Você não tem permissão para criar feedbacks.');
        }

        $searchModel = new FeedbackSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Feedback model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        // É necessário ter a permissão de ver feedback, ser superadmin ou estar tentando ver o próprio feedback.
        if (User::hasPermission('view_Feedback', $superAdminAllowed = true) || $model->created_by == Yii::$app->user->id) {
            return $this->render('view', [
                'model' => $model,
            ]);
        } else {
            throw new ForbiddenHttpException('Você não tem permissão para visualizar este feedback.');
        }
    }

    /**
     * Creates a new Feedback model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        // É necessário ter a permissão de adicionar feedback ou ser superadmin.
        if (!User::hasPermission('create_Feedback', $superAdminAllowed = true)) {
            throw new ForbiddenHttpException('Você não tem permissão para criar feedbacks.');
        }
        

        $model = new Feedback();
        $model->author = Yii::$app->user->id;

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
     * Updates an existing Feedback model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws ForbiddenHttpException if the user does not have permission
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        // É necessário ter criado o feedback ou ser superadmin.
        if ($model->author !== Yii::$app->user->id && !User::hasRole('Admin')) {
            throw new ForbiddenHttpException('Você não tem permissão para modificar este feedback.');
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Feedback model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws ForbiddenHttpException if the user does not have permission
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        // É necessário ter criado o feedback ou ser superadmin.
        if ($model->author !== Yii::$app->user->id && !User::hasRole('Admin')) {
            throw new ForbiddenHttpException('Você não tem permissão para excluir este feedback.');
        }

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Feedback model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Feedback the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Feedback::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
