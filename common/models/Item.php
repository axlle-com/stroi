<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\helpers\HtmlPurifier;
/**
 * This is the model class for table "item".
 *
 * @property integer $id
 * @property string $category_id
 * @property integer $render_id
 * @property integer $sitemap
 * @property integer $published
 * @property string $favourites
 * @property integer $show_comments
 * @property integer $show_img
 * @property integer $show_img_post
 * @property integer $show_img_cat
 * @property integer $show_message
 * @property integer $show_data
 * @property integer $watermark
 * @property integer $small_img
 * @property integer $tumb_img
 * @property string $media
 * @property string $alias_item
 * @property string $title
 * @property string $title_seo
 * @property string $title_short
 * @property string $description_seo
 * @property string $description
 * @property string $purified_text
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $date_pub
 * @property string $date_end
 * @property string $general_photo
 * @property integer $position
 * @property string $hits
 * @property double $stars
 *
 * @property Comments[] $comments
 * @property Details[] $details
 * @property FolderHasItem[] $folderHasItems
 * @property Folder[] $folders
 * @property InfoblockHasItem[] $infoblockHasItems
 * @property Infoblock[] $infoblocks
 * @property Category $category
 * @property Render $render
 * @property ItemHasUser[] $itemHasUsers
 * @property User[] $users
 * @property Semantico[] $semanticos
 * @property TagsHasItem[] $tagsHasItems
 * @property Tags[] $tags
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /*public function afterFind()
    {
        if($this->purified_text && $this->description)
        {
            $this->purified_text = strip_tags($this->description);
            $this->update($this->id, [
                'purified_text' => $this->purified_text
            ]);
        }
        parent::afterFind();
    }*/
    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios['step2'] = ['general_photo'];

        return $scenarios;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'render_id', 'sitemap', 'alias_item', 'title'], 'required'],
            [['category_id', 'render_id', 'sitemap', 'published', 'favourites', 'show_comments', 'show_img', 'show_img_post', 'show_img_cat', 'show_message', 'show_data', 'watermark', 'small_img', 'tumb_img', 'created_at', 'updated_at', 'position', 'hits'], 'integer'],
            [['description', 'purified_text'], 'string'],
            [['date_pub', 'date_end', 'infoblockArray','tagsArray'], 'safe'],
            [['stars'], 'number'],
            [['media', 'alias_item', 'title', 'title_seo', 'description_seo', 'general_photo'], 'string', 'max' => 255],
            [['title_short'], 'string', 'max' => 155],
            [['title'], 'unique'],
            [['alias_item'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['render_id'], 'exist', 'skipOnError' => true, 'targetClass' => Render::className(), 'targetAttribute' => ['render_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Категория статьи',
            'render_id' => 'Страница вывода',
            'sitemap' => 'Sitemap',
            'published' => 'Публикация',
            'favourites' => 'Избранное',
            'show_comments' => 'Комментарии',
            'show_img' => 'Главное изображение',
            'show_img_post' => 'Show Img Post',
            'show_img_cat' => 'Show Img Cat',
            'show_message' => 'Show Message',
            'show_data' => 'Show Data',
            'watermark' => 'Watermark',
            'small_img' => 'Small Img',
            'tumb_img' => 'Tumb Img',
            'media' => 'Media',
            'alias_item' => 'Псевдоним статьи',
            'title' => 'Заголовок',
            'title_seo' => 'Заголовок Seo',
            'title_short' => 'Title Short',
            'description_seo' => 'Текст статьи Seo',
            'description' => 'Текст статьи',
            'purified_text' => 'Purified Text',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
            'date_pub' => 'Дата публикации',
            'date_end' => 'Конец публикации',
            'general_photo' => 'Главная фотография',
            'position' => 'Сортировка по цене/позиция',
            'hits' => 'Просмотры',
            'stars' => 'Оценки',
            'infoblockArray' => 'Инфоблоки',
            'tagsArray' => 'Тэги',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetails()
    {
        return $this->hasOne(Details::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFolderHasItems()
    {
        return $this->hasMany(FolderHasItem::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFolders()
    {
        return $this->hasMany(Folder::className(), ['id' => 'folder_id'])->viaTable('folder_has_item', ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInfoblockHasItems()
    {
        return $this->hasMany(InfoblockHasItem::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInfoblocks()
    {
        return $this->hasMany(Infoblock::className(), ['id' => 'infoblock_id'])->viaTable('infoblock_has_item', ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRender()
    {
        return $this->hasOne(Render::className(), ['id' => 'render_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemHasUsers()
    {
        return $this->hasMany(ItemHasUser::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('item_has_user', ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSemanticos()
    {
        return $this->hasMany(Semantico::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagsHasItems()
    {
        return $this->hasMany(TagsHasItem::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tags::className(), ['id' => 'tags_id'])->viaTable('tags_has_item', ['item_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ItemQuery(get_called_class());
    }
    public function getRenderName()
    {
        $render = $this->render;

        return $render ? $render->name : '';
    }

    public static function getRenderList()
    {
        $renders = Render::find()->all();

        return ArrayHelper::map($renders, 'id', 'name');
    }

    public function getCategoryName()
    {
        $category = $this->category;

        return $category ? $category->title : '';
    }

    public static function getCategoryList()
    {
        $categorys = Category::find()->all();

        return ArrayHelper::map($categorys, 'id', 'title');
    }
    public function getFolder(){
        return $this::tableName();
    }

    private $_infoblockArray;

    public function getInfoblockArray()
    {
        if ($this->_infoblockArray === null) {
            $this->_infoblockArray = $this->getInfoblocks()->select('id')->column();
        }
        return $this->_infoblockArray;
    }

    public function setInfoblockArray($value)
    {
        $this->_infoblockArray = (array)$value;
    }

    private $_tagsArray;

    public function getTagsArray()
    {
        if ($this->_tagsArray === null) {
            $this->_tagsArray = $this->getTags()->select('id')->column();
        }
        return $this->_tagsArray;
    }

    public function setTagsArray($value)
    {
        $this->_tagsArray = (array)$value;
    }
    public function afterSave($insert, $changedAttributes){
        $this->updateInfoblocks();
        $this->updateTags();
        Yii::$app->locator->cache->set('id_image',$this->id);
        parent::afterSave($insert, $changedAttributes);
    }

    private function updateInfoblocks()
    {
        $currentInfoblockIds = $this->getInfoblocks()->select('id')->column();
        $newInfoblockIds = $this->getInfoblockArray();

        foreach (array_filter(array_diff($newInfoblockIds, $currentInfoblockIds)) as $infoblockId) {
            /** @var Infoblock $infoblock */
            if ($infoblock = Infoblock::findOne($infoblockId)) {
                $this->link('infoblocks', $infoblock);
            }
        }

        foreach (array_filter(array_diff($currentInfoblockIds, $newInfoblockIds)) as $infoblockId) {
            /** @var Infoblock $infoblock */
            if ($infoblock = Infoblock::findOne($infoblockId)) {
                $this->unlink('infoblocks', $infoblock, true);
            }
        }
    }
    private function updateTags()
    {
        $currentTagsIds = $this->getTags()->select('id')->column();
        $newTagsIds = $this->getTagsArray();

        foreach (array_filter(array_diff($newTagsIds, $currentTagsIds)) as $tagsId) {
            /** @var Tags $tags */
            if ($tags = Tags::findOne($tagsId)) {
                $this->link('tags', $tags);
            }
        }

        foreach (array_filter(array_diff($currentTagsIds, $newTagsIds)) as $tagsId) {
            /** @var Tags $tags */
            if ($tags = Tags::findOne($tagsId)) {
                $this->unlink('tags', $tags, true);
            }
        }
    }
}
