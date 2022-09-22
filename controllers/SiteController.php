<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Reg;
use app\models\CreateApplic;
use yii\web\UploadedFile;
use app\models\ApplicationsSearchModel;
use app\models\ApplicationsSearchModelIndex;
use app\models\ApplicationsSearchModelAdmin;
use app\models\ApplicationsModel;
use app\models\CreateUpdateModel;
use app\models\UpdateModel;
use app\models\CategoriesSearch;
use app\models\CategoriesModel;
use app\models\CreateCategories;
use app\models\Users;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        // return $this->render('index');
    /*
        $model=new CreateApplic();
        if(isset($_POST['CreateApplic']))
            {
                $model->attributes=Yii::$app->request->post('CreateApplic');
                $model->img = UploadedFile::getInstance($model, 'img');
                if($model->validate() && $model->createapplication())
                {
                    return $this->goHome();
                }
            }
        return $this->render('index',['model'=>$model]);
    */
        $searchModel = new ApplicationsSearchModelIndex();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        ]);
    } 


    public function actionRegister()
    {
        $model=new Reg();
        if(isset($_POST['Reg']))
            {
                $model->attributes=Yii::$app->request->post('Reg');
                if($model->validate() && $model->register())
                {
                  return $this->goHome();
                }
            }
        return $this->render('register',['model'=>$model]);

    }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        // if ($model->load(Yii::$app->request->post()) && $model->login()) {
        //     return $this->goBack();
        // }
        if(Yii::$app->request->post('LoginForm')){
            $model->attributes=Yii::$app->request->post('LoginForm');
            if($model->validate()){
                // Yii::$app->user->login($model->getUser());
                Yii::$app->user->login($model->getUser(), $model->rememberMe ? 3600*24*30 : 0);
                // return $this->goHome();
                return $this->redirect(array('site/profile'));
            }
        }   

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /*
            Displays contact page.
    
            @return Response|string
    
            public function actionContact()
            {
                $model = new ContactForm();
                if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
                    Yii::$app->session->setFlash('contactFormSubmitted');

                    return $this->refresh();
                }
                return $this->render('contact', [
                    'model' => $model,
                ]);
            } 
    */

    public function actionNewapplication()
    {
        // return $this->render('about');
        if(!Yii::$app->user->isGuest){
        $model=new CreateApplic();
        if(isset($_POST['CreateApplic']))
            {
                $model->attributes=Yii::$app->request->post('CreateApplic');
                $model->img = UploadedFile::getInstance($model, 'img');
                if($model->validate() && $model->createapplication())
                {
                    return $this->redirect(['profile']);
                }
            }
        return $this->render('newapplication',['model'=>$model]);
        }
        else return $this->goHome();
    }

    public function actionDelete($id)
    {
            $img=ApplicationsModel::findOne($id)->img;
            $this->findModel($id)->delete();
            unlink('uploads/'.$img);
            if(ApplicationsModel::findOne($id)->img2!=Null)
            {
                $img2=ApplicationsModel::findOne($id)->img2;
                unlink('uploads/'.$img2);
            }
            return $this->redirect(['profile']);
    }
    
    public function actionProfile()
    {
        $searchModel = new ApplicationsSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if (!Yii::$app->user->isGuest)
            // return $this->render('profile');
            return $this->render('profile', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            ]);
        else $this->goBack();
    }

    protected function findModel($id)
    {
        if (($model = ApplicationsModel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    public function actionUpdate($id)
        {
            if(!Yii::$app->user->isGuest&&Yii::$app->user->identity->role==2&&UpdateModel::findOne($id)->status=='Новая')
            {
                // $model = UpdateModel::findOne($id);        
                // if ($model->load(Yii::$app->request->post()) && $model->save()) {
                   
                //     return $this->redirect(['changestatus', 'id' => $model->id]);
                // }
                // else return $this->render('update', [
                //     'model' => $model,
                // ]);
                // return $this->goHome();
                $modelinfo = UpdateModel::findOne($id);
                $model=new CreateUpdateModel();
                if(isset($_POST['CreateUpdateModel']))
                {
                    $model->attributes=Yii::$app->request->post('CreateUpdateModel');
                    $model->img2 = UploadedFile::getInstance($model, 'img2');
                    if($model->validate() && $model->createapplication($id))
                    {
                        return $this->goHome();
                    }
                }
                return $this->render('update',['model'=>$model,'modelinfo'=>$modelinfo]);
            }
            else return $this->goHome();
        }
    
    public function actionChangestatus()
    {

        if(!Yii::$app->user->isGuest&&Yii::$app->user->identity->role==2){
            $searchModel = new ApplicationsSearchModelAdmin();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            return $this->render('changestatus',['searchModel' => $searchModel,
            'dataProvider' => $dataProvider,]);
        }
        // else return $this->redirect('index');
        else return $this->redirect('changestatus');
    }
    public function actionUpdatecategories()
    {
        if(!Yii::$app->user->isGuest&&Yii::$app->user->identity->role==2){
            $model=new CreateCategories();
            $searchModel = new CategoriesSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            if(isset($_POST['CreateCategories']))
            {
                $model->attributes=Yii::$app->request->post('CreateCategories');
                if($model->validate() && $model->createapplication())
                {
                    // return $this->goHome();
                    return $this->redirect(['updatecategories']);
                }
            }
            return $this->render('updatecategories',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model,
            ]);
        }
        else $this->redirect(['index']);

        // return $this->render('updatecategories',['model'=>$model]);
    }
    public function actionDelete1($id)
    {
        // $img=ApplicationsModel::findOne($id)->img;
        // unlink('uploads/'.$img);
        if(!Yii::$app->user->isGuest&&Yii::$app->user->identity->role==2){
            $category=CategoriesModel::findOne($id)->categories;
            $this->findModel1($id)->delete();
            $img=ApplicationsModel::find()->where(['category'=>$category])->all();
            $model = ApplicationsModel::deleteAll(['category'=>$category]);
            foreach ($img as $value) {
                unlink('uploads/'.$value->img);
                if($value->img2!=Null)
                unlink('uploads/'.$value->img2);
            }           
            return $this->redirect(['updatecategories']);
        }
        else $this->redirect(['index']);
    }
    protected function findModel1($id)
    {
        if (($model = CategoriesModel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}

