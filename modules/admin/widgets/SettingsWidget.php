<?php
namespace app\modules\admin\widgets;

use app\modules\admin\models\Settings;
use toxor88\switchery\Switchery;
use yii\bootstrap\Widget;
use yii\helpers\Html;
use yii\web\JsExpression;

class SettingsWidget extends Widget
{
    protected $settings;
    protected $collapse = [];
    public $model;


    public function init()
    {
        parent::init();

        $this->model = new Settings();
        $this->settings = $this->model->find()->groupBy(['section', 'id'])->asArray()->all();

        $res = [];
        foreach ($this->settings as $it) {
            $res[$it['section']][$it['id']] = $it;
        }

        $collap_item = [];

        foreach ($res as $key => $item) {
            $collap_item[] = [

                'label'          => $this->set_label($key),
                'content'        => $this->get_content($item),
                'contentOptions' => ['class' => 'collapsing '],
                'options' => ['class' => 'panel box box-primary'],
                'footer' => $this->set_footer($item['key']),
            ];
        }

        $this->collapse = ['items' => $collap_item];
        return $this->collapse;
    }

    protected function set_footer($data)
    {
        return Html::submitButton('Submit', ['class' => 'btn btn-success', 'name' => $data]);
    }

    protected function set_label($data)
    {
        return $data;
    }

    protected function get_content($data, $isActiveForm = FALSE)
    {
        $res = array();
        $res[] = Html::a('<i class="fa fa-cog"></i> add', ['admin/settings/create'],['class' => 'add_settings_in_section']);

        foreach($data as $item)
        {
            $res[] =
                '<div class="row">' .
                '<div class="form-group">' .
                Html::label($item['key'], $item['key'], ['class' => 'col-sm-2 control-label']) .
                '<div class="col-sm-3">' .
                $this->set_input_type($item['type'], $item['key'], $item['value']) .
                '</div>' .
                '</div>' .
                '<div class="col-sm-4">' .
                Html::tag('span', $item['description']) .
                '</div>' .
                Html::label('active', 'active', ['class' => 'col-sm-2 control-label']) .
                '<div class="col-sm-1">' .

                Html::checkbox($item['key'].'[active]',
                    $this->has_checked($this->has_checked($item['active'])),
                    ['data-atr' => 'icheck', 'class' => 'flat-red']) .
                '</div>';
        }
        return $res;
    }


    protected function set_input_type($type, $name, $value)
    {
        if(isset($type) && isset($name) && isset($value))
            {
                $input = NULL;
                $input_name = $name.'[value]';


                switch($type)
                {
                    case 'string':
                        $input = Html::input('text', $input_name, $value, ['class' => 'form-control' , 'placeholder' => 'Значение пустое...']);
                        break;
                    case 'integer':
                        $input = Html::input('number',$input_name, $value, ['class' => 'form-control' , 'placeholder' => 'Значение пустое...']);
                        break;
                    case 'boolean':
                        $input =  Switchery::widget([
                            'name' => $input_name,
                            'clientOptions' => [
                                'color'              => '#64bd63',
                                'secondaryColor'     => '#dfdfdf',
                                'jackColor'          => '#fff',
                                'jackSecondaryColor' => null,
                                'className'          => 'switchery',
                                'disabled'           => FALSE,
                                'disabledOpacity'    => 0.5,
                                'speed'              => '0.1s',
                                'size'               => 'default',
                            ],
                            'options' => array_merge(['value' => 0], $this->has_checked($value)),
                           /* 'clientChangeEvent' => new JsExpression('function() {
                                alert("checked: " + this.checked);
                            }'),*/

                        ]);
                        break;
                    default:
                        $input = Html::input('text',$input_name, $value, ['class' => 'form-control' , 'placeholder' => 'Значение пустое...']);
                        break;
                }
                return $input;
            }
        return FALSE;

    }

    protected function has_checked($value)
    {
        return  isset($value) && !empty($value)? ['checked' => 'checked'] : [''];
    }


    public function run()
    {
        return $this->render('settings', ['collapse' => $this->collapse, 'model' => $this->model]);
    }
}