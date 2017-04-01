<?php

/* @var $this yii\web\View */
/* @var $model app\models\Parameter */
/* @var $form yii\widgets\ActiveForm */

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="parameter-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_ids')->widget(Select2::className(), [
        'data' => \app\models\Category::getList(),
        'showToggleAll' => false,
        'options' => [
            'placeholder' => 'Выберите категории ...',
            'multiple' => true,
        ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
