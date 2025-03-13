<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */


use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Создание заявки на сотрудничество';
$this->params['breadcrumbs'][] = $this->title;
?>    
<div class="site-register">
    <h1><?= Html::encode($this->title) ?></h1>

    <p class="mb-5 mt-3">Советуем подробно заполнить профиль перед подачей заявки, так возможность рассмотрения заявки выше😊</p>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'work_experience')->textInput() ?>

            <?= $form->field($model, 'description')->textInput() ?>
            
            <?= $form->field($model, 'type_id')->dropDownList($types, ['prompt' => 'Выберите вид съемки']) ?>
            
            <?= $form->field($model, 'payment')->textInput() ?>
            
            <?= $form->field($model, 'portfolio_url')->textInput() ?>
            
            <?= $form->field($model, 'city_id')->dropDownList($cityes, ['prompt' => 'Выберите город']) ?>
            
            <div class="form-group">
                <div>
                    <?= Html::submitButton('Подать заявку', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
