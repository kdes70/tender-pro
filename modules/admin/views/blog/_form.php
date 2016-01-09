<?php

    use app\modules\blog\models\BlogCategory;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use dosamigos\selectize\SelectizeTextInput;
    use dosamigos\ckeditor\CKEditor;
    use toxor88\switchery\Switchery;
    use kartik\select2\Select2;
use dosamigos\fileinput\BootstrapFileInput;
    /* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Blog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data',
        ]
    ] ); ?>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'category_id')->widget(Select2::classname(), [
                'language'      => 'ru',
                'value'         => 0,
                'data'          => ArrayHelper::map(BlogCategory::find()->all(), 'id', 'name'),
                'options'       => [
                    'placeholder' => 'Select provinces ...',
                ],
                'pluginOptions' => [
                    'allowClear' => TRUE
                ],
            ]);
            ?>
        </div>
        <div class="col-lg-6">
            <?php
                // On our
                echo $form->field($model, 'tagNames')->widget(SelectizeTextInput::className(),
                    [   // calls an action that returns a JSON object with matched //
                        // tags
                        'loadUrl'       => ['blog-tags/list'],
                        'options'       => ['class' => 'form-control'],
                        'clientOptions' => [
                            'plugins'     => ['remove_button'],
                            'valueField'  => 'name',
                            'labelField'  => 'name',
                            'searchField' => ['name'],
                            'create'      => TRUE,
                        ],
                    ])->hint('Use commas to separate tags')
                //Read more at: http://yiiwheels.com/extension/yii2-taggable-behavior
            ?>

        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true])->hint('заголовок') ?>
            <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'slug')->hiddenInput()->label(false) ?>

        </div>
        <div class="col-lg-6">
            <!--        --><?//= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

            <!--   --><?/*= $form->field($model, 'publication_at')->widget(DateTimePicker::className(), [
            'language' => 'ru',
            'size' => 'ms',
            //'template' => '{input}',
            'pickButtonIcon' => 'glyphicon glyphicon-time',
            'inline' => false,
            'clientOptions' => [
//                'startView' => 1,
//                'minView' => 0,
//                'maxView' => 1,
                'autoclose' => true,
                // 'linkFormat' => 'HH:ii P', // if inline = true
                // 'format' => 'HH:ii P', // if inline = false
                'todayBtn' => true
            ]
        ]);*/?>
        </div>

        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">CK Editor <small>Advanced and full of features</small></h3>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                        <!--                <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>-->
                    </div><!-- /. tools -->
                </div><!-- /.box-header -->
                <div class="box-body pad" style="display: block;">
                    <?= $form->field($model, 'text')->widget(CKEditor::className(),[
                        'options' => ['rows' => 6],
                        'preset' => 'full',
                    ]); ?>
                </div>
            </div>

        </div>
    </div>





    <div class="form_group">
        <div class="col-md-offset-2 col-md-10">
            <?if($images):?>

            <div class="row">
                <? foreach($images as $image):?>
                    <? if($image):?>
                        <div class="col-md-3 text-center">
                            <img src="<?= $image->getUrl('200x200')?>" alt=""/>
                        </div>
                    <? endif; ?>
                <? endforeach;?>
            </div>
            <?php endif;?>

        </div>
    </div>

    <div class="col-md-12">
    <?= $form->field($model, 'image[]')->widget(BootstrapFileInput::className(), [
            'options' => ['accept' => 'image/*', 'multiple' => true],
            'clientOptions' => [
                'previewFileType' => 'text',
                'browseClass' => 'btn btn-success',
                'uploadClass' => 'btn btn-info',
                'removeClass' => 'btn btn-danger',
                'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> '
            ]
        ]);?>


    <?=$form->field($model, 'status')->widget(Switchery::classname(), [
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

    ])->label(false);?>

    </div>

    <div class="col-lg-6">

<!--        --><?// echo $form->field($model, 'keywords')->widget(Select2::classname(), [
//            'value' => ['red', 'green'],
//            'options' => ['placeholder' => 'Select a color ...', 'multiple' => true],
//            'pluginOptions' => [
//                'tags' => true,
//                'maximumInputLength' => 10,
//            ],
//        ]);
//        ?>
        <?= $form->field($model, 'keywords')->textInput(['maxlength' => true, 'id' => 'keywords']) ?>

        <div class="seo_result">
            <p>Отображаем результат SEO</p>
            <h3 id="meta_title_result"></h3>
            <div class="s_res">
                <div id="meta_url_result"></div>
                <span id="meta_desc_result"></span>
<!--                <p id="meta_keyword_result"></p>-->
            </div>

<!-- отображаем результат SEO-->
        </div>

    </div>
    <div class="col-lg-6">
        <?= $form->field($model, 'description')->textArea(['rows' => 6]) ?>
    </div>




<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
    <div class="col-lg-6">

    </div>
</div>




    <?php ActiveForm::end(); ?>

</div>
<!--<script>
    $(document).ready(function(){

        seoResult();

    });
</script>-->
