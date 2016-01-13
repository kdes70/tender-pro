<?php

    use kartik\select2\Select2;
    use toxor88\switchery\Switchery;
    use yii\helpers\Html;
    use yii\web\JsExpression;
    use yii\widgets\ActiveForm;

    //var_dump($section_data);exit;

    /* @var $this yii\web\View */
    /* @var $model \app\modules\settings\models\Settings */
    /* @var $form yii\widgets\ActiveForm */
?>

<div class="settings-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Quick Example</h3>
                </div>
                <div class="box-body">
                    <?= $form->field($model, 'section')->widget(Select2::classname(), [
                        'name'          => 'section',
                        'language'      => 'ru',
                        'value'         => 'red', // initial value
                        'data'          => $section_data,
                        'options'       => ['placeholder' => 'Выберите блок для настроек ...'],
                        'pluginOptions' => [
                            'tags'               => TRUE,
                            'tokenSeparators'    => [',', ' '],
                            'maximumInputLength' => 10
                        ],
                    ]);
                    ?>

                </div>

                <div class="box-body">
                    <?= $form->field($model, 'key')->textInput(['maxlength' => TRUE]) ?>
                </div>
                <div class="box-body">
                    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
                </div>


            </div>
            <!-- /.box -->
        </div>

        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Quick Example</h3>
                </div>
                <div class="box-body">
                    <?= $form->field($model, 'type')->widget(Select2::classname(), [
                        'name'          => 'type',
                        'language'      => 'ru',
                        'data'          => $type_data,
                        'options'       => ['placeholder' => 'Выберите тип даных ...'],
                        'pluginOptions' => [
                            'allowClear' => TRUE
                        ],
                    ]);
                    ?>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?= $form->field($model, 'value')->textarea(['rows' => 6]) ?>
                </div>

            </div>
            <!-- /.box -->
        </div>
    </div>


   <!-- --><?/*= $form->field($model, 'active')->textInput() */?>

    <?=$form->field($model, 'active')->widget(Switchery::classname(), [
        'name' => 'active',
        'clientOptions' => [
            'color'              => '#64bd63',
            'secondaryColor'     => '#dfdfdf',
            'jackColor'          => '#fff',
            'jackSecondaryColor' => null,
            'className'          => 'switchery js-switch',
            'disabled'           => false,
            'disabledOpacity'    => 0.5,
            'speed'              => '0.3s',
            'size'               => 'default',

        ],
        'clientChangeEvent' => new JsExpression('function() {
        alert("checked: " + this.checked);
    }'),

    ])->label(false);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


