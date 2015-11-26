<?php

namespace app\modules\blog\models;

use app\modules\admin\models\BlogCategory;
use app\modules\admin\models\BlogTagsBlog;
use app\modules\admin\models\User;
use dosamigos\taggable\Taggable;
use Yii;
use yii\behaviors\TimestampBehavior;

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
            [['user_id', 'title', 'text'], 'required'],
            [['category_id', 'user_id', 'images_id', 'created_at', 'updated_at', 'status', 'order'], 'integer'],
            [['text'], 'string'],
            [['publication_at', 'tagNames'], 'safe'],
            [['title', 'slug', 'prev_img'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            ['tagNames', 'match', 'pattern' => '/^[\w\s,]+$/', 'message' => 'В тегах можно использовать только буквы.'],

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

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [ 'class' => Taggable::className(), ],//tags
            'slug' => [
                'class' => 'app\behaviors\Slug',
                'in_attribute' => 'title',
                'out_attribute' => 'slug',
                'translit' => true
            ],
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

    /**
     * @return \yii\db\ActiveQuery
     * Read more at: http://yiiwheels.com/extension/yii2-taggable-behavior
     */
    public function getTags()
    {
        $viaTable = '{{%blog_tags_blog}}';
        return $this->hasMany(BlogTags::className(), ['id' => 'tag_id'])->viaTable($viaTable, ['blog_id' => 'id']);
    }
}
