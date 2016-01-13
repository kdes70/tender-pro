<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\search\BlogSearch;
use app\modules\blog\models\Blog;
use app\modules\blog\models\BlogTags;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * BlogController implements the CRUD actions for Blog model.
 */
class BlogController extends Controller
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
        ];
    }

    /**
     * Lists all Blog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Blog model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, 'http://tender-pro.lok/blog/default/index');
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        $result = curl_exec($ch);
//        curl_close($ch);

        //dump($result);

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Blog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Blog();

        $items = $model->getBlogTags()->all();
        $tags = [];
        foreach ($items as $item)
        {
            $tags[] = $item->name;
        };
        $model->tagNames = BlogTags::array2string($tags);

        $images = ''; //isset($model->getImages()) ? $model->getImages() : FALSE;

        if ($model->load(Yii::$app->request->post()) )
        {

//            $model->image = UploadedFile::getInstance($model, 'image');
//            if($model->image)
//            {
//                $path = Yii::getAlias('@webroot/upload/images/blog/').$model->image->baseName.'.'.$model->image->extension;
//                $model->image->saveAs($path);
//                $model->attachImage($path);
//            }


            // dump(Yii::$app->request->post());
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'images' =>$images,
            ]);
        }
    }

    /**
     * Updates an existing Blog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $items = $model->getBlogTags()->all();
        $tags = [];
        foreach ($items as $item)
        {
            $tags[] = $item->name;
        };
        $model->tagNames = BlogTags::array2string($tags);

        //dump(Yii::$app->request->post());

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->image = UploadedFile::getInstance($model, 'image');
            if($model->image)
            {
                $path = Yii::getAlias('@webroot/upload/images/blog/').$model->image->baseName.'.'.$model->image->extension;
                $model->image->saveAs($path);
                $model->attachImage($path);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'images' => $model->getImages(),
            ]);
        }
    }

    /**
     * Deletes an existing Blog model.
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
     * Finds the Blog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Blog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Blog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
