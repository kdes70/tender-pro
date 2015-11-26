<?php

namespace app\modules\admin\controllers;

use app\components\GoodException;
use app\modules\admin\models\search\SettingsSearch;
use app\modules\admin\models\Settings;
use pheme\grid\actions\ToggleAction;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * SettingsController implements the CRUD actions for Settings model.
 */
class SettingsController extends Controller
{


    public function actions()
    {
        return [
            'toggle' => [
                'class' => ToggleAction::className(),
                'modelClass' => 'app\modules\admin\models\Settings',
                //'setFlash' => true,
            ]
        ];
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Settings models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Settings();

        if (Yii::$app->request->post())
        {

                $section = Yii::$app->request->post();


            dump($section);
                $success = 0;
                foreach ($section as $key => $item) {
                    $setting_item = $model->findOne(['key' => $key]);
                    if ($setting_item) {

                        if(!isset($item['value'])){

                            $value = '0';
                        }else{
                            $value = '1';
                        }

                       // exit;
                        $values = [
                            'value'   => $value,
                            'active' => $item['active']
                        ];
                        $setting_item->attributes = $values;

                       dump($values);

                        if ($setting_item->save()) {

                            $success++;
                           //echo  "Success";
                        }
                        else{
                            echo  "Error";
                        }
                    }
                }
                if($success < 0)
                {
                    echo \yii2mod\alert\Alert::widget([
                        'type' => \yii2mod\alert\Alert::TYPE_WARNING,
                        'options' => [
                            'title' => 'Success message',
                            'text' => "You will not be able to recover this imaginary file!",
                            'confirmButtonText'  => "Yes, delete it!",
                            'cancelButtonText' =>  "No, cancel plx!"
                        ]
                    ]);

                    Yii::$app->session->setFlash('success', 'Настройки сохранены');

                    echo 'Success';



                    // данные в базу добавлены, можна и флеш-сообщение показать:


                }
        }
        else {
            $searchModel = new SettingsSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel'  => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    public function actionSave()
    {
        if(Yii::$app->request->post())
        {
            dump(Yii::$app->request->post());
            exit;
        }
    }

    /**
     * Displays a single Settings model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Settings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Settings();
        $section = $model->getSection();
        $type = $model->getType();

       // dump($section);

//        if(Yii::$app->request->post())
//        {
//            echo '<pre>';
//            var_dump(Yii::$app->request->post());
//            exit;
//        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'section' => $section,
                'type' => $type,
            ]);
        }
    }

    /**
     * Updates an existing Settings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);



        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Settings model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Settings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Settings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Settings::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
