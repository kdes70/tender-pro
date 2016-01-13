<?php
namespace app\modules\settings\components\widgets;

use app\modules\settings\models\Settings;
use toxor88\switchery\Switchery;
use yii\bootstrap\Widget;
use yii\helpers\Html;

/**
 * Class SettingsWidget
 * Формирует форму для настроек в фдминке
 * @package app\modules\admin\components\widgets
 */

class SettingsWidget extends Widget
{
    protected $settings;

    protected $collapse = [];

    protected $collap_item = [];

    protected $add_set_link = 'admin/settings/create';

    public $model;

    public $title = '';


    public function init()
    {
        parent::init();

        $this->model = new Settings();
        $this->settings = $this->model->find()->groupBy(['section', 'id'])->asArray()->all();

        $res = [];
        foreach ($this->settings as $it) {
            $res[$it['section']][$it['id']] = $it;
        }

        foreach ($res as $key => $item) {
            $this->collap_item[] = [

                'label'          => $this->set_label($key),
                'content'        => $this->get_content($item),
                'contentOptions' => ['class' => 'collapsing '],
                'options' => ['class' => 'panel box box-primary'],
                'footer' => $this->set_footer($item['key']),
            ];
        }

        $this->collapse = ['items' => $this->collap_item];

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
        // Ссылка добавления настройка для секции
        $res[] = Html::a('<i class="fa fa-cog"></i> add', [$this->add_set_link],['class' => 'add_settings_in_section']);

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
                    $input = Html::input('text', $input_name, $value,
                        ['class' => 'form-control', 'placeholder' => 'Значение пустое...']);
                    break;
                case 'integer':
                    $input = Html::input('number', $input_name, $value,
                        ['class' => 'form-control', 'placeholder' => 'Значение пустое...']);
                    break;
                case 'text':
                    $input = Html::textarea($input_name,$value,
                        ['class' => 'form-control', 'placeholder' => 'Значение пустое...']);
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
        return $this->render('settings',
            [
                'collapse' => $this->collapse,
                'model'    => $this->model,
                'title' => $this->title,
            ]);
    }
}