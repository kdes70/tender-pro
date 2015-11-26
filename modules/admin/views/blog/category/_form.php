<?php

    use yii\helpers\ArrayHelper;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use toxor88\switchery\Switchery;
    use kartik\select2\Select2;

    /* @var $this yii\web\View */
/* @var $model app\modules\blog\models\BlogCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if(!empty($category)):?>

        <?php

        //dump(ArrayHelper::map($category, 'id', 'name'));

        echo $form->field($model, 'parent_id')->widget(Select2::classname(), [
            'language' => 'ru',
            'value' => 0,
            'data' =>  ArrayHelper::map($category, 'id', 'name'),
            'options' => [
                'placeholder' => 'Select provinces ...',
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>


   <!-- --><?/*= $form->field($model, 'parent_id')->dropDownList(
        ArrayHelper::map($category, 'id', 'name'))
    */?>
    <?php endif;?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <? //= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prev_img')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'status')->widget(Switchery::classname(), [
        'name' => 'status',
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
       /* 'clientChangeEvent' => new JsExpression('function() {
        alert("checked: " + this.checked);
    }'),*/

    ])->label(false);?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
