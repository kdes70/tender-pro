<?php

namespace app\modules\blog\models;

use Yii;

/**
 * This is the model class for table "{{%blog_category}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $slug
 * @property string $prev_img
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 * @property integer $order
 *
 * @property Blog[] $blogs
 */
class BlogCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%blog_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'created_at', 'updated_at', 'status', 'order'], 'integer'],
            [['name', 'slug', 'prev_img', 'created_at', 'updated_at'], 'required'],
            [['name', 'slug', 'prev_img'], 'string', 'max' => 255],
            [['slug'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'prev_img' => 'Prev Img',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
            'order' => 'Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogs()
    {
        return $this->hasMany(Blog::className(), ['category_id' => 'id']);
    }
}
