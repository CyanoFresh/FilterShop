<?php

/* @var $this yii\web\View */
/* @var $model app\models\Parameter */

use yii\helpers\Html;

$this->title = 'Изменить Parameter: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Parameters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="parameter-update">

    <h1 class="page-header"><?= $this->title ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
