<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%settings}}".
 *
 * @property integer $id
 * @property string $type
 * @property string $section
 * @property string $key
 * @property string $value
 * @property string $description
 * @property integer $active
 * @property string $created
 * @property string $modified
 */
class Settings extends \yii\db\ActiveRecord implements \pheme\settings\models\SettingInterface
{
    protected $type_data = [
        'string'  => 'string',
        'integer' => 'integer',
        'boolean' => 'boolean',
        'float'   => 'float',
        'array'   => 'array',
        'object'  => 'object',
        'null'    => 'null'
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%settings}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value', 'description'], 'string'],
            [['active'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['type', 'section', 'key'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'section' => 'Section',
            'key' => 'Key',
            'value' => 'Value',
            'description' => 'Description',
            'active' => 'Active',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'modified',
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function getType()
    {
        return $this->type_data;
    }

    /**
     * @inheritdoc
     */
    public function getSettings()
    {
        $settings = static::find()->where(['active' => true])->asArray()->all();
        return array_merge_recursive(
            ArrayHelper::map($settings, 'key', 'value', 'section'),
            ArrayHelper::map($settings, 'key', 'type', 'section')
        );
    }

    public function getSection()
    {
        $model = static::find()->select('section')->asArray()->all();
        return $section = ArrayHelper::map($model, 'section', 'section');
    }

    /**
     * @inheritdoc
     */
    public function setSetting($section, $key, $value, $type = null)
    {
        $model = static::findOne(['section' => $section, 'key' => $key]);

        if ($model === null) {
            $model = new static();
            $model->active = 1;
        }
        $model->section = $section;
        $model->key = $key;
        $model->value = strval($value);

        if ($type !== null) {
            $model->type = $type;
        } else {
            $model->type = gettype($value);
        }

        return $model->save();
    }

    /**
     * @inheritdoc
     */
    public function activateSetting($section, $key)
    {
        $model = static::findOne(['section' => $section, 'key' => $key]);

        if ($model && $model->active == 0) {
            $model->active = 1;
            return $model->save();
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function deactivateSetting($section, $key)
    {
        $model = static::findOne(['section' => $section, 'key' => $key]);

        if ($model && $model->active == 1) {
            $model->active = 0;
            return $model->save();
        }
        return false;
    }


    public function deleteSetting($section, $key)
    {
        $model = static::findOne(['section' => $section, 'key' => $key]);

        if ($model) {
            return $model->delete();
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteAllSettings()
    {
        return static::deleteAll();
    }
}
