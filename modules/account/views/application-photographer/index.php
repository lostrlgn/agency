<?php

use app\models\ApplicationPhotographer;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\modules\account\models\ApplicationPhotographerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Application Photographers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="application-photographer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!ApplicationPhotographer::find()->where(['user_id' => Yii::$app->user->id])->exists()): ?>
        <p>
            <?= Html::a('Create Application Photographer', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
        },
    ]) ?>

    <?php Pjax::end(); ?>

</div>

