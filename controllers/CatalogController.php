<?php

namespace app\controllers;

use app\models\CatalogSearch;
use app\models\Category;
use app\models\ProductSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CatalogController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new CatalogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'category' => null,
            'categories' => $this->getParentCategories(),
        ]);
    }

    public function actionCategory($id)
    {
        $model = Category::findOne($id);

        if (!$model) {
            throw new NotFoundHttpException();
        }

        $searchModel = new CatalogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $model->getProducts());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'category' => $model,
            'categories' => $this->getParentCategories(),
        ]);
    }

    public function getParentCategories()
    {
        return Category::find()->where(['parent_id' => null])->all();
    }
}
