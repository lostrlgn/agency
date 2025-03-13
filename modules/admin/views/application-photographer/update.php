<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ApplicationPhotographer $model */

$this->title = 'Update Application Photographer: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Application Photographers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="application-photographer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
