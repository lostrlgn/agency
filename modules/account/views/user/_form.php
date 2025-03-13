<?php

use yii\bootstrap5\Html;
use yii\web\JqueryAsset;
use yii\bootstrap5\ActiveForm;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

<?php Pjax::begin([
        'id' => 'form-user-pjax',
        'enablePushState' => false,
        'timeout' => 5000,
    ]) ?>

        <?php $form = ActiveForm::begin([
            'id' => 'form-user',
            'options' => [
                'data-pjax' => true,
            ]
        ]); ?>

<div class="d-flex justify-content-center align-items-center">
<div class="d-flex flex-column" style="max-width: 600px; width: 100%;">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'patronymic')->textInput(['maxlength' => true]) ?>
        <div class="d-flex gap-5">
            <?= $form->field($model, 'date_birth')->textInput(['type' => 'date', 'max' => date('Y-m-d')]) ?>
            
            <?= $form->field($model, 'gender_id')->dropDownList($genders, ['prompt' => 'Выберите пол']) ?>
        </div>
    
    
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'phone')->textInput(['maxlength' => true])->widget(\yii\widgets\MaskedInput::class, [
        'mask' => '+7(999)-999-99-99',
    ]) ?>
    
        <?= $form->field($model, 'imageFile')->fileInput() ?>
    
        <?= $form->field($model, 'city_id')->dropDownList($cityes, ['prompt' => 'Выберите город']) ?>
            
        <div class="form-group">
            <?= Html::a('Назад', ['/account'], ['class' => 'btn btn-success']) ?>
            <?= Html::submitButton('Сохранить', ['class' => 'user-save btn btn-success']) ?>
        </div>
    </div>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end() ?>


</div>

<?php

$this->registerJsFile('/js/user.js', ['depends' => JqueryAsset::class]);
