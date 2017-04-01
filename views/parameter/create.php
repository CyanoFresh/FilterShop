<?php

/* @var $this yii\web\View */
/* @var $model app\models\Parameter */

use yii\helpers\Html;

$this->title = 'Добавить Parameter';
$this->params['breadcrumbs'][] = ['label' => 'Parameters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parameter-create">

    <h1 class="page-header"><?= $this->title ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
