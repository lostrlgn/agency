<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ApplicationPhotographer $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="application-photographer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'comment_admin')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
