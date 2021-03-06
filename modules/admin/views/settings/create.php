<?php

    use yii\helpers\Html;


    /* @var $this yii\web\View */
/* @var $model \app\modules\settings\models\Settings */

$this->title = 'Create Settings';
$this->params['breadcrumbs'][] = ['label' => 'Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'section_data' => $section,
        'type_data' => $type,

    ]) ?>

</div>
