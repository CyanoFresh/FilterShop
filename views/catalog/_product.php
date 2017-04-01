<?php
/* @var $this yii\web\View */
/* @var $model \app\models\Product */
?>
<div class="col-sm-6">
    <div class="panel panel-default">
        <div class="panel-body text-center">
            <h4><?= $model->name ?></h4>

            <hr>

            <p><?= $model->vendor_code ?></p>

            <?php foreach ($model->categories as $category): ?>
                <a href="<?= \yii\helpers\Url::to(['category', 'id' => $category->id]) ?>"><span
                            class="label label-primary"><?= $category->name ?></span></a>
            <?php endforeach; ?>

            <hr>

            <a href="<?= \yii\helpers\Url::to(['product', 'id' => $model->id]) ?>" class="btn btn-primary btn-block">Подробнее</a>
        </div>
    </div>
</div>
