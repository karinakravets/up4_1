<?php

namespace app\controllers;

use app\models\Product;
use app\models\ProductSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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

    public function upload()
    {
        if ($this->validate()) {
            $path = 'assets/images/' . Yii::$app->getSecurity()->generateRandomString(10) . '.' . $this->photo_product->extension;
            $this->photo_product->saveAs($path);
            return $path;
        } else {
            return false;
        }
    }

    /**
     * Lists all Product models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCatalog()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('catalog', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Product model.
     * @param int $product_id Product ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_product)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_product),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($this->request->isPost) {
        $model->load($this->request->post());
        $model->photo=UploadedFile::getInstance($model,'photo');
        $file_name='assets/images/' . \Yii::$app->getSecurity()->generateRandomString(50). '.' . $model->photo->extension;
        $model->photo->saveAs(\Yii::$app->basePath .'/web/'. $file_name);
        if ($model->save(false)) {
        Yii::$app->db->createCommand()->update('product', ['photo'=>$file_name], "id_product = {$model->id_product}")->execute();
        return $this->redirect(["view","product_id"=> $model->id_product]);
        }
        } else {
        $model->loadDefaultValues();
        }
        
        return $this->render('create', [
        'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $product_id Product ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_product)
    {
        $model = $this->findModel($id_product);
        if ($this->request->isPost) {
            $post = $this->request->post();
            $new_photo = UploadedFile::getInstance($model,'photo');
            unset($post['Product']['photo']);
            $model->load($post);
        if ($new_photo){
            $model->photo=$new_photo;
            $file_name='assets/images/' . \Yii::$app->getSecurity()->generateRandomString(50). '.' . $model->photo->extension;
            $model->photo->saveAs(\Yii::$app->basePath .'/web/'. $file_name);
            $model->photo=$file_name;
        }
        $model->save(false);
        return $this->redirect(['view', 'product_id' => $model->id_product]);
        }
        return $this->render('update', [
        'model' => $model, 
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $product_id Product ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_product)
    {
        $this->findModel($id_product)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $product_id Product ID
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($product_id)
    {
        if (($model = Product::findOne( $product_id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
