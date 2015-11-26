<?php

namespace app\modules\blog\models;

use Yii;

/**
 * This is the model class for table "{{%blog_tags}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $frequency
 *
 * @property BlogTagsBlog[] $blogTagsBlogs
 */
class BlogTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%blog_tags}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'frequency'], 'required'],
            [['frequency'], 'integer'],
            [['name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'frequency' => 'Frequency',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogTagsBlogs()
    {
        return $this->hasMany(BlogTagsBlog::className(), ['tags_id' => 'id']);
    }
}
