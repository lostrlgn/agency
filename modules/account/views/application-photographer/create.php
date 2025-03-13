<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ApplicationPhotographer $model */

$this->title = 'Create Application Photographer';
$this->params['breadcrumbs'][] = ['label' => 'Application Photographers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="application-photographer-create">

    <h1><?#= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'types' => $types,
        'cityes' => $cityes,
    ]) ?>

</div>
