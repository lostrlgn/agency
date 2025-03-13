<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\account\models\ApplicationPhotographerSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="application-photographer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'comment_admin') ?>

    <?= $form->field($model, 'status_reception_id') ?>

    <?= $form->field($model, 'work_experience') ?>

    <?= $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'payment') ?>

    <?php // echo $form->field($model, 'portfolio_url') ?>

    <?php // echo $form->field($model, 'city_id') ?>

    <?php // echo $form->field($model, 'type_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
