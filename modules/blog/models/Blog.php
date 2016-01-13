<?php

namespace app\modules\blog\models;

use app\behaviors\CreateUpdateBehavior;
use app\modules\admin\models\User;
use app\modules\blog\Module;
use dosamigos\taggable\Taggable;
use rico\yii2images\behaviors\ImageBehave;
use Yii;

/**
 * This is the model class for table "{{%blog}}".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $user_id
 * @property string $title
 * @property string $slug
 * @property string $keywords
 * @property string $text
 * @property string $description
 * @property string $image
 * @property string $prev_img
 * @property integer $images_id
 * @property string $publication_at
 * @property integer $created_at
 * @property integer $update_user_id
 * @property integer $updated_at
 * @property integer $status
 * @property integer $order
 *
 * @property BlogCategory $category
 * @property User $user
 * @property BlogTags[] $blogTags
 */
class Blog extends \yii\db\ActiveRecord
{

    const STATUS_PUBLISH = 1;
    const STATUS_UNPUBLISH = 0;

    public $image;
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
            [['title', 'text'], 'required'],
            [['category_id', 'images_id', 'created_at', 'updated_at', 'status', 'order'], 'integer'],
            [['text', 'description', 'keywords'], 'string'],
            [['publication_at', 'tagNames', 'slug', 'category_id', 'user_id', 'update_user_id'], 'safe'],
            [['title', 'slug', 'prev_img'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            ['tagNames', 'match', 'pattern' => '/^[\w\s,]+$/', 'message' => 'В тегах можно использовать только буквы.'],
           /* ['image', 'image', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024*1024],*/

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
            'tagNames' => 'Теги',
            'user_id' => 'User ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'keywords' => 'Keywords',
            'text' => 'Text',
            'description' => 'Description',
            'image' => 'IMG',
            'prev_img' => 'Prev Img',
            'images_id' => 'Images ID',
            'publication_at' => 'Publication At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'update_user_id' => 'Updated User',
            'status' => 'Status',
            'order' => 'Order',
        ];
    }

    public function behaviors()
    {
        return [

            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ],
            'createUpdate' => ['class' => CreateUpdateBehavior::className()],

            ['class' => Taggable::className(),],//tags

            'slug'         => [
                'class'         => 'app\behaviors\Slug',
                'in_attribute'  => 'title',
                'out_attribute' => 'slug',
                'translit'      => TRUE
            ],

        ];
    }


    public function getStatusName()
    {
        $statuses = self::getStatusesArray();
        return isset($statuses[$this->status]) ? $statuses[$this->status] : '';
    }

    public static function getStatusesArray()
    {
        return [
            self::STATUS_PUBLISH => Module::t('module', 'STATUS_PUBLISH'),
            self::STATUS_UNPUBLISH => Module::t('module', 'STATUS_UNPUBLISH'),
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
//    public function getBlogTagsBlogs()
//    {
//        return $this->hasMany(BlogTagsBlog::className(), ['blog_id' => 'id']);
//    }

    /**
     * @return \yii\db\ActiveQuery
     * Read more at: http://yiiwheels.com/extension/yii2-taggable-behavior
     */
    public function getBlogTags()
    {
        $viaTable = '{{%blog_tags_blog}}';
        return $this->hasMany(BlogTags::className(), ['id' => 'tag_id'])->viaTable($viaTable, ['blog_id' => 'id']);
    }

    /**
     * Возвращает опубликованные посты
     * @return ActiveDataProvider
     */
    public static function getPublishedPosts()
    {
        return self::find()
            ->where(['status' => self::STATUS_PUBLISH])
            ->with('category')
            ->orderBy('id DESC');
    }


    public function getBlogFeed($limit)
    {
        return $this->find()
            ->where(['status' => self::STATUS_PUBLISH])
//            ->with('category')
            ->orderBy('id DESC')
            ->limit($limit)->all();
    }

}
