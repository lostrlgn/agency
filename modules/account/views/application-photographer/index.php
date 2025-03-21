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

$this->title = 'Заявки на сотрудничество';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="application-photographer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::a('Снова отправить заявку', ['create'], ['class' => 'btn btn-success']) ?>

    <?php Pjax::begin(); ?>
    <?php #echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => 'item',
    ]) ?>

    <?php Pjax::end(); ?>

</div>

