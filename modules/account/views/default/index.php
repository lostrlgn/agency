<?php

use yii\bootstrap5\Html;
?>
<h1 class="user-header">Личный кабинет</h1>
<div class="d-flex gap-3">
    <div class="user_photo">
        <?= Html::img('pictures/' . $model->photo, ['']) ?>
    </div>
    <div class="user_info">
        <p class="user_info-name"><?= $model->fio ?></p>
        <p class="user_info-city"><?= $model->city->title ?></p>
        <p class="user_info-city"><?= $model->gender->title ?></p>
    </div>
    <div class="user_button">
        <?= Html::a('Редактировать профиль', ['/account/user/update'], ['class' => 'user_button btn btn-secondary btn-sm']) ?>
    </div>
</div>
<?= Html::a('Партнерство', ['/account/application-photographer/check-application'], ['class' => 'mt-5 btn btn-secondary btn-sm']) ?>
