<?php

use app\models\Photographer;
use app\models\PhotographerTypes;
use app\models\Type;
use yii\bootstrap5\Html;
use yii\helpers\VarDumper;

// $photographerTypes = new PhotographerTypes();

?>
<div class="card">
  <div class="card-body">
    <?#= Html:: ?>
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex  align-items-center">
            <div class="user_photo photographer_photo">
                <?= Html::img('pictures/' . $model->user->photo, ['']) ?>
            </div>
            <div class="photographer_info">
                <h5 class="card-title"><?= $model->user->fio ?></h5>
                <h6 class="card-subtitle mb-2 text-body-secondary"><?= Type::getPhotoType($model->id) ?></h6>
                <p class="card-text"><?= $model->description ?></p>
                <?= Yii::$app->user->isGuest ? $model->city->title : '' ?> 
                <?= Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <div class="photographer_price">
            <p class="card-text"><b><?= $model->payment ?></b> р/час</p>
        </div>
    </div>
  </div>
</div>