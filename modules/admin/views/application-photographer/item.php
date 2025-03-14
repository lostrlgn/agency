<?php

use app\models\StatusReception;
use yii\bootstrap5\Html;
?>
<div class="card" style="width: 18rem;">

    
    <p><?= $model->city->title ?></p>
    <p><?= $model->type->title ?></p>
    <p><?= $model->comment_admin ?></p>
    <p><?= $model->statusReception->title ?></p>
    <p><?=  $model->user->name  ?></p>
    <p><?=  $model->work_experience  ?></p>
    <p><?=  $model->description  ?></p>
    <p><?=  $model->payment  ?></p>
    <p><?=  $model->portfolio_url  ?></p>
    <p><?= Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?></p>
    <p><?= $model->status_reception_id == StatusReception::getStatusId('Новая')
      ? Html::a('Отказать', ['cancel', 'id' => $model->id], ['class' => 'btn btn-primary']) .
        Html::a('На собеседование', ['apply', 'id' => $model->id], ['class' => 'btn btn-primary'])
     : ''
     ?></p>
    <p><?= $model->status_reception_id == StatusReception::getStatusId('На собеседование')
      ? Html::a('Принят', ['hired', 'id' => $model->id], ['class' => 'btn btn-primary']) .
        Html::a('Не принят', ['fired', 'id' => $model->id], ['class' => 'btn btn-primary'])
     : ''
     ?></p>
    
</div>
    
