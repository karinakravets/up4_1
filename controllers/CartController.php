<?php

namespace app\controllers;

use app\models\Cart;
use app\models\CartSearch;
use app\models\Product;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * CartController implements the CRUD actions for Cart model.
 */
class CartController extends Controller
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
     * Lists all Cart models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CartSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(['site/login']);
            return false;
        } else
            return true;

        if ($action->id == 'create') $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Displays a single Cart model.
     * @param int $cart_id Cart ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($cart_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($cart_id),
        ]);
    }

    /**
     * Creates a new Cart model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $product_id = Yii::$app->request->post('product_id');
        $items = Yii::$app->request->post('count');
        $product = Product::findOne($product_id);

        if (!$product) return false;

        if ($product->count > 0) {
            $product->count -= $items;

            $product->save(false);

            $model = Cart::find()->where(['id_user' => Yii::$app->user->identity->id])->andWhere(['id_product' => $product_id])->one();

            if ($model) {
                $model->count += $items;
                $model->save(false);
                return true;
            }

            $model = new Cart();
            $model->id_user = Yii::$app->user->identity->id;
            $model->id_product = $product->id_product;
            $model->count = $items;

            if ($model->save(false)) return $product->count;
        }
        return false;
    }

    public function actionRemoveItem()
    {
        $id_product = Yii::$app->request->post('good_id');
        $product = Product::find()->where(['id_product' => $id_product])->one();

        if (!$product) {
            return false;
        }

        $cart_product = Cart::find()->where(['id_user' => Yii::$app->user->identity->id, 'id_product' => $id_product])
            ->andWhere(['id_order' => null])->one();

        if ($cart_product) {
            if ($cart_product->count > 1) {
                $cart_product->count -= 1;

                $cart_product->save(false);

                $product->count += 1;
                $product->save(false);
                return true;
            } else {
                if ($cart_product->count = 1) {
                    $cart_product->delete();
                    $product->quantity += 1;
                    $product->save(false);
                    return true;
                } else {
                    return false;
                }
            }
        }
        return false;
    }

    /**
     * Updates an existing Cart model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $cart_id Cart ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($cart_id)
    {
        $model = $this->findModel($cart_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'cart_id' => $model->cart_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Cart model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $cart_id Cart ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($cart_id)
    {
        $this->findModel($cart_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cart model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $cart_id Cart ID
     * @return Cart the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($cart_id)
    {
        if (($model = Cart::findOne(['cart_id' => $cart_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
