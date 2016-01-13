<?php

    use app\modules\settings\components\widgets\SettingsWidget;
    use app\modules\settings\models\Settings;
    use yii\grid\GridView;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Html;
    use yii\widgets\Pjax;


    /* @var $this yii\web\View */
/* @var $searchModel \app\modules\admin\models\search\SettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Settings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Settings', ['create'], ['class' => 'btn btn-success']) ?>
    </p>




    <?php Pjax::begin(); ?>
    <?=
        GridView::widget(
            [
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'id',
                    //'type',
                    [
                        'attribute' => 'section',
                        'filter' => ArrayHelper::map(
                            Settings::find()->select('section')->distinct()->where(['<>', 'section', ''])->all(),
                            'section',
                            'section'
                        ),
                    ],
                    'key',
                    'value:ntext',
                    [
                        'class' => '\pheme\grid\ToggleColumn',
                        'attribute' => 'active',
                        'filter' => [1 => Yii::t('yii', 'Yes'), 0 => Yii::t('yii', 'No')],
                    ],
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]
        ); ?>
    <?php Pjax::end(); ?>


    <?php echo SettingsWidget::widget(['title' => 'Settings']);?>


</div>
