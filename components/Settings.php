<?php
    namespace app\components;

    use yii\base\Component;
    use app\modules\admin\models\Settings as SettingsModel;

    class Settings extends Component
    {
        protected $data = array();


        public function init()
        {
            $model = new SettingsModel();
            $items = $model->findAll();

            var_dump($items);

            parent::init();
        }
    }