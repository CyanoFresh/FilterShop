<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\CatalogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $categories \app\models\Category[] */
/* @var $category \app\models\Category|null */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;

$items = [];

foreach ($categories as $menuCategory) {
    $items[] = ['label' => $menuCategory->name, 'url' => Url::to(['category', 'id' => $menuCategory->id])];

    if ($menuCategory->categories) {
        foreach ($menuCategory->categories as $childCategory) {
            $items[] = [
                'label' => '-- ' . $childCategory->name,
                'url' => Url::to(['category', 'id' => $childCategory->id])
            ];
        }
    }
}
?>

<div class="row">
    <div class="col-sm-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <h4>Категории</h4>
                <?= \yii\bootstrap\Nav::widget([
                    'items' => $items,
                    'encodeLabels' => false,
                    'activateItems' => true,
                    'activateParents' => true,
                    'options' => [
                        'class' => 'nav nav-pills nav-stacked',
                    ],
                ]) ?>
            </div>
        </div>

        <?php if ($category): ?>
            <?php $form = ActiveForm::begin([
                'method' => 'get',
            ]); ?>

            <?php foreach ($category->getAllParameters() as $parameter): ?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4><?= $parameter->name ?></h4>

                        <?php $i = 0; foreach ($parameter->getProductParametersByValue()->all() as $productParameter): ?>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"
                                           name="parameters[<?= $parameter->id ?>][]"
                                           value="<?= $productParameter->value ?>"
                                    <?php if (isset($searchModel->parameters[$parameter->id]) and $searchModel->parameters[$parameter->id] == $productParameter->value): ?>checked<?php endif ?>>
                                    <?= $productParameter->value ?>
                                </label>
                            </div>
                        <?php $i++; endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <?= Html::submitButton('Применить', [
                'class' => 'btn btn-primary',
            ]) ?>

            <?php ActiveForm::end(); ?>
        <?php endif; ?>
    </div>

    <div class="col-sm-9">
        <?php if ($category and $category->categories): ?>
            <div class="row">
                <?php foreach ($category->categories as $category): ?>
                    <div class="col-sm-3">
                        <div class="panel panel-default">
                            <div class="panel-body text-center">
                                <a href="<?= Url::to(['category', 'id' => $category->id]) ?>">
                                    <?= $category->name ?>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <?= \yii\widgets\ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_product',
                'summaryOptions' => ['class' => 'alert alert-info'],
                'layout' => "{summary}\n<div class='row'>{items}</div>\n{pager}",
            ]) ?>
        </div>
    </div>

</div>
