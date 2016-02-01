<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    /* @var $model \app\modules\settings\models\Settings */
?>

<h1><?php echo $title; ?></h1>


<?php

    /**
     * @var $collapse \app\modules\admin\components\widgets\SettingsWidget
     */
?>

<?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>

    <?php  echo \yii\bootstrap\Collapse::widget($collapse);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

<?php $script = <<< JS

$('form#{$model->formName()}').on('beforeSubmit', function(e){
    var \$form = $(this);

    $.post(
        \$form.attr("action"), //serialize yii2 form
        \$form.serialize()
    )
    .done(function(result){

        if(result = "Success")
        {
           console.log(result);
           //location.reload();

        }else{
            console.log("triger");
            $(\$form).trigger("reset")
            $('#message').html(result);
        }
    }).fail(function(){
        console.log('Server Error');
    });
    return false;
});
JS;
    $this->registerJs($script);
?>