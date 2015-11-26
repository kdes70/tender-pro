<?php

namespace app\modules\blog\models;

use app\modules\admin\models\BlogCategory;
use app\modules\admin\models\BlogTagsBlog;
use app\modules\admin\models\User;
use Yii;

/**
 * This is the model class for table "{{%blog}}".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $user_id
 * @property string $title
 * @property string $slug
 * @property string $text
 * @property string $prev_img
 * @property integer $images_id
 * @property string $publication_at
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 * @property integer $order
 *
 * @property BlogCategory $category
 * @property User $user
 * @property BlogTagsBlog[] $blogTagsBlogs
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%blog}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'user_id', 'title', 'slug', 'text', 'prev_img', 'created_at', 'updated_at'], 'required'],
            [['category_id', 'user_id', 'images_id', 'created_at', 'updated_at', 'status', 'order'], 'integer'],
            [['text'], 'string'],
            [['publication_at'], 'safe'],
            [['title', 'slug', 'prev_img'], 'string', 'max' => 255],
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
            'category_id' => 'Category ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'text' => 'Text',
            'prev_img' => 'Prev Img',
            'images_id' => 'Images ID',
            'publication_at' => 'Publication At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
            'order' => 'Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(BlogCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogTagsBlogs()
    {
        return $this->hasMany(BlogTagsBlog::className(), ['blog_id' => 'id']);
    }
}
