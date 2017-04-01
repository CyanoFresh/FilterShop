<?php

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */

use app\models\Category;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id')->dropDownList(Category::getList(), [
        'prompt' => '--- выберите категорию ---',
    ]) ?>

    <?= $form->field($model, 'parameter_ids')->widget(Select2::className(), [
        'data' => \app\models\Parameter::getList(),
        'showToggleAll' => false,
        'options' => [
            'placeholder' => 'Выберите параметры ...',
            'multiple' => true,
        ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
