<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\ApplicationPhotographer $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Application Photographers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="application-photographer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Назад', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            [
                'attribute' =>  'city_id',
                'value' => $model->city->title
            ],
            [
                'attribute' =>  'type_id',
                'value' => $model->type->title,
                'visible' => (bool)$model->type_id
            ],
            [
                'attribute' =>  'comment_admin',
                'value' => $model->comment_admin,
                'visible' => (bool)$model->comment_admin
            ],
            [
                'attribute' =>  'status_reception_id',
                'value' => $model->statusReception->title
            ],
            [
                'attribute' =>  'user_id',
                'value' => $model->user->name 
            ],
            'work_experience',
            'description',
            'payment',
            'portfolio_url:url',
        ],
    ]) ?>

</div>
