<?php

use app\models\Position;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Photographer $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Photographers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="photographer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Назад', ['/admin/photographer', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= $model->position_id == Position::getPositionId('Нанят')
        ? Html::a('Удалить из системы', ['dismiss', 'id' => $model->id],  [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) 
        : ''
        ?>
    </p>

    <div class="d-flex justify-content-between">
        <div class="d-flex">
            <div class="user_photo photographer_info-photo">
                <?= Html::img('pictures/' . $model->user->photo, ['']) ?>
            </div>
            <div class="photographer_info">
                <p class="user_info-name"><?= $model->user->fio ?></p>
                <p class="user_info-city"><?= $model->city->title ?></p>
                <p class="photographer_info-description"><?= $model->description ?></p>
                <p class="photographer_info-portfolio_url"><?= $model->portfolio_url ?></p>
            </div>

        </div>
        <div class="photographer_info-button">
            <p class="photographer_info-payment"><b><?= $model->payment ?></b> р/час</p>
            <?= Html::a('Редактировать профиль', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?#= DetailView::widget([
        // 'model' => $model,
        // 'attributes' => [
        //     'id',
        //     'user_id',
        //     'portfolio_url:url',
        //     'payment',
        //     'description:ntext',
        //     'position_id',
        //     'city_id',
        // ],
    #]) ?>

</div>
