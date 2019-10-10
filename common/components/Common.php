<?
namespace common\components;

use common\models\Category;
use common\models\Details;
use common\models\Infoblock;
use common\models\Ips;
use common\models\Reviews;
use common\models\Tags;
use yii\base\Component;
use yii\helpers\BaseFileHelper;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use yii\web\UploadedFile;

use yii\imagine\Image;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Imagine\Image\ImageInterface;
use common\models\Item;
use common\models\Search\ItemSearch;
use Yii;
use yii\helpers\ArrayHelper;
use common\models\Render;
use Imagine\Gmagick\Imagine;

class Common extends Component{

    const EVENT_NOTIFY = 'notify_admin';

    public static function getImage($model,$folder)
    {
        if($folder == 'item')
        {
            $title = $model->alias_item;
            
        }elseif ($folder == 'category')
        {
            $title = $model->alias_category;
            
        }elseif ($folder == 'image')
        {
            $title = $model->folder->link;
        }else
        {
            $title = $model->id;
        }


        $path = Yii::getAlias('@frontend/web/images/'.$folder.'/'.$title.'/general');
        BaseFileHelper::createDirectory($path);

        $model->scenario = 'step2';

        $file = UploadedFile::getInstance($model,'general_photo');
        if ($file) {

            $name = 'general_' . $title . '_' . time() . '.' . $file->extension;
            if($model->watermark)
            {
                $temp_name = 'temp_' . $title . '.' . $file->extension;
                $file->saveAs($path . DIRECTORY_SEPARATOR . $temp_name);
                $temp_image = $path . DIRECTORY_SEPARATOR . $temp_name;
                $fold = Yii::getAlias('@frontend/web/images/backgrounds');
                if($model->watermark == 1)
                {
                    $stamp = $fold . DIRECTORY_SEPARATOR .'stamp_lbg.png';
                }elseif ($model->watermark == 2)
                {
                    $stamp = $fold . DIRECTORY_SEPARATOR .'stamp_big.png';
                }
                $temp_image_size = getimagesize($temp_image);
                $stamp_size = getimagesize($stamp);
                $temp_image_width = $temp_image_size[0];
                $temp_image_height = $temp_image_size[1];
                $stamp_width = $stamp_size[0];
                $stamp_height = $stamp_size[1];
                if(($temp_image_width < $stamp_width) || ($temp_image_height < $stamp_height))
                {
                    $temp_w = $fold . DIRECTORY_SEPARATOR .'stamp_tmp.png';
                    Image::frame($stamp, 0, '666', 0)
                        ->thumbnail(new Box($temp_image_width, $temp_image_height))
                        ->save($temp_w, ['quality' => 100]);

                    Image::watermark($temp_image,$temp_w,[0,0])->save($path . DIRECTORY_SEPARATOR . $name, ['quality' => 80]);
                    unlink($temp_w);

                }else{
                    Image::watermark($temp_image,$stamp,[0,0])->save($path . DIRECTORY_SEPARATOR . $name, ['quality' => 80]);
                }

                unlink($temp_image);
            }else{
                $file->saveAs($path . DIRECTORY_SEPARATOR . $name);
            }
            $image = $path . DIRECTORY_SEPARATOR . $name;

            $new_name = $path . DIRECTORY_SEPARATOR . "small_" . $name;
            $tumb_name = $path . DIRECTORY_SEPARATOR . "tumb_" . $name;
            $model->general_photo = $name;
            $model->save();

            $size = getimagesize($image);
            $width = $size[0];
            $height = $size[1];
            if($model->small_img)
            {
                Image::frame($image, 0, '666', 0)
                    ->thumbnail(new Box($width/2.5, $height/2.5))
                    ->save($new_name, ['quality' => 95]);
            }
            if ($model->tumb_img)
            {
                Image::frame($image, 0, '666', 0)
                    ->thumbnail(new Box(120, 80))
                    ->save($tumb_name, ['quality' => 100]);
            }
        }
        return true;
    }
    public static function getImages($model,$folder)
    {
        if($folder == 'item')
        {
            $title = $model->alias_item;
        }elseif ($folder == 'category')
        {
            $title = $model->alias_category;
        }elseif ($folder == 'image')
        {
            $title = $model->folder->link;
        }else
        {
            $title = $model->id;
        }
        $path = Yii::getAlias('@frontend/web/images/'.$folder.'/'.$title.'/gallery');
        BaseFileHelper::createDirectory($path);
        $file = UploadedFile::getInstanceByName('images');
        if ($file) {
            $name = $title . '_' . time() . '.' . $file->extension;

            if($model->watermark)
            {
                $temp_name = 'temp_' . $title . '.' . $file->extension;
                $file->saveAs($path . DIRECTORY_SEPARATOR . $temp_name);
                $temp_image = $path . DIRECTORY_SEPARATOR . $temp_name;
                $fold = Yii::getAlias('@frontend/web/images/backgrounds');
                if($model->watermark == 1)
                {
                    $stamp = $fold . DIRECTORY_SEPARATOR .'stamp_lbg.png';
                }elseif ($model->watermark == 2)
                {
                    $stamp = $fold . DIRECTORY_SEPARATOR .'stamp_big.png';
                }
                $temp_image_size = getimagesize($temp_image);
                $stamp_size = getimagesize($stamp);
                $temp_image_width = $temp_image_size[0];
                $temp_image_height = $temp_image_size[1];
                $stamp_width = $stamp_size[0];
                $stamp_height = $stamp_size[1];
                if(($temp_image_width < $stamp_width) || ($temp_image_height < $stamp_height))
                {
                    $temp_w = $fold . DIRECTORY_SEPARATOR .'stamp_tmp.png';
                    Image::frame($stamp, 0, '666', 0)
                        ->thumbnail(new Box($temp_image_width, $temp_image_height))
                        ->save($temp_w, ['quality' => 100]);

                    Image::watermark($temp_image,$temp_w,[0,0])->save($path . DIRECTORY_SEPARATOR . $name, ['quality' => 80]);
                    unlink($temp_w);

                }else{
                    Image::watermark($temp_image,$stamp,[0,0])->save($path . DIRECTORY_SEPARATOR . $name, ['quality' => 80]);
                }

                unlink($temp_image);
            }else{
                $file->saveAs($path . DIRECTORY_SEPARATOR . $name);
            }
            $image = $path . DIRECTORY_SEPARATOR . $name;
            $new_name = $path . DIRECTORY_SEPARATOR . "small_" . $name;
            $tumb_name = $path . DIRECTORY_SEPARATOR . "tumb_" . $name;
            $size = getimagesize($image);
            $width = $size[0];
            $height = $size[1];
            if($model->small_img)
            {
                Image::frame($image, 0, '666', 0)
                    ->thumbnail(new Box($width/2.5, $height/2.5))
                    ->save($new_name, ['quality' => 95]);
            }
            if ($model->tumb_img)
            {
                Image::frame($image, 0, '666', 0)
                    ->thumbnail(new Box(120, 80))
                    ->save($tumb_name, ['quality' => 100]);
            }
            sleep(1);
        }
        return true;
    }
    public static function getStep($model,$folder,$title)
    {
        $image = [];
        if($general_photo = $model->general_photo){
            $image[] =  '<img src="/images/'.$folder.'/' . $title . '/general/' . $general_photo . '" width=250>';
        }

        $path = Yii::getAlias('@frontend/web/images/'.$folder.'/'.$title.'/gallery');
        $images_add = [];

        try {
            if(is_dir($path)) {
                $files = \yii\helpers\FileHelper::findFiles($path);

                foreach ($files as $file) {
                    if (!strstr($file, "small_") && !strstr($file, "tumb_")) {
                        $images_add[] = '<img src="/images/'.$folder.'/' . $title . '/gallery/' . basename($file) . '" width=250>';
                    }
                }
            }
        }
        catch(\yii\base\Exception $e){}
        return (['model' => $model,'image' => $image, 'images_add' => $images_add,'title' => $title]);
    }
    public function sendMail($subject,$text){
        if(\Yii::$app->mail->compose()
            ->setFrom(['web@srub-stroi.ru' => 'Сообщение с сайта'])
            ->setTo(['mail@srub-stroi.ru' => 'ООО "Сруб-Строй"'])
            ->setSubject($subject)
            ->setHtmlBody($text)
            ->send()){
            return true;
        }
        return false;
    }

    public function contact($subject,$text)
    {
        if (Yii::$app->mailer->compose()
                ->setTo('mail@srub-stroi.ru')
                ->setFrom(['web@srub-stroi.ru' => 'Сообщение с сайта'])
                ->setSubject($subject)
                ->setTextBody($text)
                ->send()) {
            return true;
        }
        return false;
    }
    public function notifyAdmin($event){

        print "Notify Admin";
    }
    public static function showGeneralImage($model){

        $image = [];
        $base = '/';
        $folder = $model::tableName();
        if($folder == 'item')
        {
            $alias = $model->alias_item;
        }elseif ($folder == 'category')
        {
            $alias = $model->alias_category;
        }elseif ($folder == 'image')
        {
            $alias = $model->folder->link;
        }else
        {
            $alias = $model->id;
        }
        $path = \Yii::getAlias('@frontend/web/images/'.$folder.$base.$alias.'/general');
        if(is_dir('../../frontend/web/images/'.$folder) && is_dir('../../frontend/web/images/'.$folder.$base.$alias) && is_dir($path))
        {
            $files = BaseFileHelper::findFiles($path);
            foreach($files as $file){
                if (!strstr($file, 'small_') && !strstr($file, 'tumb_')) {
                    $image[] = basename($file);//$image[] = $base.'images/'.$folder.$base.$alias.'/general'.$base.basename($file);
                }else{
                    continue;
                }
            }
            return $image;
        }
        return false;
    }
    public static function showGalleryImage($model){
        $image = [];
        $base = '/';
        $folder = $model::tableName();
        if($folder == 'item')
        {
            $alias = $model->alias_item;
        }elseif ($folder == 'category')
        {
            $alias = $model->alias_category;
        }elseif ($folder == 'image')
        {
            $alias = $model->folder->link;
        }else
        {
            $alias = $model->id;
        }
        $path = \Yii::getAlias('@frontend/web/images/'.$folder.$base.$alias.'/gallery');
        if(is_dir('../../frontend/web/images/'.$folder) && is_dir('../../frontend/web/images/'.$folder.$base.$alias) && is_dir($path))
        {
            $files = BaseFileHelper::findFiles($path);
            foreach($files as $file){
                if (!strstr($file, 'small_') && !strstr($file, 'tumb_')) {
                    $image[] = basename($file);

                    //continue;//$image[] = $base.'images/'.$folder.$base.$alias.'/gallery'.$base.basename($file);
                }
            }
            return $image;
        }

        return false;
    }
    public static function substr($text,$start=0,$end=50){
        $text = strip_tags($text);
        $text = substr($text, $start, $end);
        $text = rtrim($text, "!,.-");
        $text = substr($text, 0, strrpos($text, ' '));
        return $text." … ";
    }
    public static function getDesc(){
        $items = Item::find()->all();
        foreach ($items as $row){
            $text = $row->title_seo;
            $text = strip_tags($text);
            $text = substr($text, 0, 80);
            $text = rtrim($text, "!,.-");
            $text = substr($text, 0, strrpos($text, ' '));
            $row->title_seo = $text;

            $desc = $row->description_seo;
            $desc = strip_tags($desc);
            $desc = substr($desc, 0, 290);
            $desc = rtrim($desc, "!,.-");
            $desc = substr($desc, 0, strrpos($desc, ' '));
            $row->description_seo = $desc;

            $row->save();
        }

        $cat = Category::find()->all();
        foreach ($cat as $row){
            $text = $row->title_seo;
            $text = strip_tags($text);
            $text = substr($text, 0, 80);
            $text = rtrim($text, "!,.-");
            $text = substr($text, 0, strrpos($text, ' '));
            $row->title_seo = $text;

            $desc = $row->description_seo;
            $desc = strip_tags($desc);
            $desc = substr($desc, 0, 290);
            $desc = rtrim($desc, "!,.-");
            $desc = substr($desc, 0, strrpos($desc, ' '));
            $row->description_seo = $desc;

            $row->save();
        }
    }
    public static function getData($data,$num = 1)
    {
        $form_date = explode('-', $data);
        if($num == 1){
            if($form_date[1] == '01')
            {
                $month = 'Января';
            }
            elseif ($form_date[1] == '02')
            {
                $month = 'Февраля';
            }
            elseif ($form_date[1] == '03')
            {
                $month = 'Марта';
            }
            elseif ($form_date[1] == '04')
            {
                $month = 'Апреля';
            }
            elseif ($form_date[1] == '05')
            {
                $month = 'Мая';
            }
            elseif ($form_date[1] == '06')
            {
                $month = 'Июня';
            }
            elseif ($form_date[1] == '07')
            {
                $month = 'Июля';
            }
            elseif ($form_date[1] == '08')
            {
                $month = 'Августа';
            }
            elseif ($form_date[1] == '09')
            {
                $month = 'Сентября';
            }
            elseif ($form_date[1] == '10')
            {
                $month = 'Октября';
            }
            elseif ($form_date[1] == '11')
            {
                $month = 'Ноября';
            }
            elseif ($form_date[1] == '12')
            {
                $month = 'Декабря';
            }
            return $pub_data = $form_date[2].' '.$month.' '.$form_date[0];
        }elseif($num == 0){
            if($form_date[1] == '01')
            {
                $month = 'Январь';
            }
            elseif ($form_date[1] == '02')
            {
                $month = 'Февраль';
            }
            elseif ($form_date[1] == '03')
            {
                $month = 'Март';
            }
            elseif ($form_date[1] == '04')
            {
                $month = 'Апрель';
            }
            elseif ($form_date[1] == '05')
            {
                $month = 'Май';
            }
            elseif ($form_date[1] == '06')
            {
                $month = 'Июнь';
            }
            elseif ($form_date[1] == '07')
            {
                $month = 'Июль';
            }
            elseif ($form_date[1] == '08')
            {
                $month = 'Август';
            }
            elseif ($form_date[1] == '09')
            {
                $month = 'Сентябрь';
            }
            elseif ($form_date[1] == '10')
            {
                $month = 'Октябрь';
            }
            elseif ($form_date[1] == '11')
            {
                $month = 'Ноябрь';
            }
            elseif ($form_date[1] == '12')
            {
                $month = 'Декабрь';
            }

            return $pub_data = [$month,$form_date[0]];
        }elseif ($num == 2){
            return $pub_data = $form_date[2].'.'.$form_date[1].'.'.$form_date[0];
        }
    }
    public static function getRelated($model){
        $id = $model->id;
        $category_id = $model->category_id;
        $related = Item::find()->where(['not in', 'id', $id])->andWhere(['category_id' => $category_id])
            ->limit(6)->orderBy(['hits'=>SORT_DESC])->all();
        return $related;
    }

    public static function getTitlePage($data)
    {
        if($data == 'category')
        {
            if($request_category = Yii::$app->request->get(trim('alias_category')))
            {
                if($item = Item::findOne(['alias_item' => $request_category]))
                {
                    return [
                        'title' => $item->title,
                        'alias_item' => $request_category,
                        'alias_category' => $item->category->alias_category,
                        'item' => $item,
                    ];
                }elseif($model = Category::findOne(['alias_category'=> $request_category]))
                {
                    return [
                        'title' => $model->title,
                        'alias_category' => $request_category,
                        'model' => $model,
                    ];
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }elseif ($data == 'item')
        {
            if($request_item = Yii::$app->request->get(trim('alias_item')))
            {
                $model = Item::findOne(['alias_item'=> $request_item]);
                return [
                    'title' => $model->title,
                    'alias_item' => $request_item,
                    'model' => $model,
                ];
            }elseif($request_category = Yii::$app->request->get(trim('alias_category')))
            {
                if($model = Category::findOne(['alias_category'=> $request_category]))
                {
                    return [
                        'title' => $model->title,
                        'alias_item' => $request_item,
                        'model' => $model,
                    ];
                }

                return false;
            }
        }else
        {
            return false;
        }

    }
    public static function getMarkup($model,$markup)
    {
        if(strlen($markup) == 1)
        {
            $newMarkup = (float)('0.0'.$markup);
        }else{
            $newMarkup = (float)('0.'.$markup);
        }

        $newPrice = number_format(((int)($model->details->original_price*$newMarkup))/100,0, ',', '');
        $newPrice = $newPrice*100;
        return [
            'newPrice' => $newPrice,
        ];

    }
    public static function getSalePrice($model,$delimiter){
        $old_price = (int)$model->details->original_price;
        $new_price = $old_price-($old_price*0.1);
        $new_price =(number_format(($new_price/100),0,',',''))*100;
        return number_format($new_price,0,',',$delimiter);
    }
    public static function getShemaPrice($price,$delimiter){
        $old_price = (int)$price;
        $new_price = $old_price-($old_price*0.1);
        $new_price =(number_format(($new_price/100),0,',',''))*100;
        return number_format($new_price,0,',',$delimiter);
    }
    public static function createdLink($model,$parent = true)
    {
        if($parent)
        {
            if($model::tableName() == 'category')
            {
                $link = '/'.$model->alias_category.'.htm';
            }elseif ($model::tableName() == 'item')
            {
                $link = '/'.$model->category->alias_category.'/'.$model->alias_item.'.htm';
            }
        }else{
            $link = '/'.$model->category->alias_category.'.htm';

        }
        return $link;
    }
    public static function getSlider()
    {
        $id = [];
        $category = Category::find()->where(['parent_id' => 2])->all();
        foreach($category as $row)
        {
            $id = $row->id;
        }

        //$items = Item::find()->where(['in', 'category_id', $id]) ->orderBy(['hits'=>SORT_ASC])->limit(3)->all();
        $item_1 = Item::find()->where(['category_id'=> 1])->orderBy(['hits'=>SORT_ASC])->one();
        $item_2 = Item::find()->where(['category_id'=> 5])->orderBy(['hits'=>SORT_ASC])->one();
        $item_3 = Item::find()->where(['category_id'=> 6])->orderBy(['hits'=>SORT_ASC])->one();
        $items= [$item_1,$item_2,$item_3];

        foreach($items as $row)
        {
            $images = Common::showGeneralImage($row);
        }
        return [
            'items' => $items,
            'images' => $images,
        ];
    }
    public static function getNews($data,$sort = 1,$limit = 7)
    {
        if($sort == 1){
            $items = Item::find()->where(['in', 'category_id', $data]) ->andWhere(['sitemap' => 1])->limit($limit)->orderBy(['date_pub'=>SORT_DESC])->all();
        }else{
            $items = Item::find()->where(['in', 'category_id', $data]) ->andWhere(['sitemap' => 1])->limit($limit)->orderBy(['hits'=>SORT_DESC])->all();
        }
        return $items;
    }
    public static function getLeftNav($alias)
    {
        $cat = Category::findOne(['alias_category' => $alias]);
        if($cat->parent_id)
        {
            $categories = Category::find()->where(['parent_id' => $cat->parent_id])->groupBy(['title_short', 'alias_category'])->orderBy(['sort'=>SORT_ASC])->all();
            $who = 1;

        }else{
            $categories = Item::find()->where(['category_id' => $cat->id])->orderBy(['position'=>SORT_ASC])->all();
            $who = 0;
        }
        return [
            'categories' => $categories,
            'who' => $who,
        ];

    }
    public static function getTopNav($cat,$who = 1)
    {
        if($who)
        {
            $categories = Category::find()->where(['parent_id' => (int)$cat])->groupBy(['title_short', 'alias_category'])->orderBy(['sort'=>SORT_ASC])->all();
        }else{
            $categories = Item::find()->where(['category_id' => (int)$cat])->orderBy(['position' => SORT_ASC])->all();
        }

        return $categories;
    }
    public static function getImportant($data)
    {
        $important = Infoblock::find()->where(['name' =>$data])->all();
        return $important;
    }
    public static function getNeg()
    {
        return Reviews::find()->where(['positively' => '0'])->count();
    }
    public static function getPoz()
    {
        return Reviews::find()->where(['positively' => '1'])->count();
    }
    public static function getBread()
    {
        $alias_category = Yii::$app->request->get(trim('alias_category'));
        $alias_item = Yii::$app->request->get(trim('alias_item'));
        $request_tags = Yii::$app->request->get('alias_tags');

        $category = Category::findOne(['alias_category'=> $alias_category]);
        $item = Item::findOne(['alias_item'=> $alias_item]);
        $tags = Tags::findOne([
            'alias_category' => $alias_category,
            'alias_tags' => $request_tags,
        ]);
        if($item && $category)
        {
            $cat_title = $category->title_short;
            return '<div class="page-header custom larger"><div class="container"><div class="row"><div class="col-md-6">
                <p>'.$cat_title.'</p></div><div class="col-md-6"><ol class="breadcrumb">
                <li><a href="/">Главная</a></li><li><a href="/'.$alias_category.'.htm">'.$cat_title.'</a></li>'
                .'<li>'.$item->title.'</li></ol></div></div></div></div>';
        }
        elseif ($tags && $category)
        {
            $cat_title = $category->title_short;
            return '<div class="page-header custom larger"><div class="container"><div class="row"><div class="col-md-6">
                <p>'.$cat_title.'</p></div><div class="col-md-6"><ol class="breadcrumb">
                <li><a href="/">Главная</a></li><li><a href="/'.$alias_category.'.htm">'.$cat_title.'</a></li>'
            .'<li>'.$tags->title_short.'</li></ol></div></div></div></div>';
        }
        elseif ($item && !$category)
        {
            $cat_title = $item->title_short;
            return '<div class="page-header custom larger"><div class="container"><div class="row"><div class="col-md-6">
            <p>'.$cat_title.'</p></div><div class="col-md-6"><ol class="breadcrumb">
            <li><a href="/">Главная</a></li><li>'.$cat_title.'</li></ol></div>
            </div></div></div>';
        }
        elseif (!$item && $category)
        {
            if($id = $category->parent_id)
            {
                $cat = Category::findOne(['id' => $id]);
                $cat_title = $cat->title;
            }else{
                $cat_title = $category->title_short;
            }
            return '<div class="page-header custom larger"><div class="container"><div class="row"><div class="col-md-6">
            <p>'.$cat_title.'</p></div><div class="col-md-6"><ol class="breadcrumb">
            <li><a href="/">Главная</a></li><li>'.$cat_title.'</li></ol></div>
            </div></div></div>';
        }
    }
    public static function getHomeFav()
    {
        return Item::find()->where(['favourites' => '1'])->limit(6)->all();
    }
    public static function getTesm()
    {
        return $tesm = Reviews::find()->where(['positively' => '1'])->limit(6)->all();
    }
    public static function getHitSb()
    {
        $model = Item::find()->all();
        foreach ($model as $row){
            $row->hits = 1;
            $row->save();
        }
    }
    public static function getPrice()
    {
        $item = Item::find()->all();
        $details = Details::find()->all();
        foreach ($item as $row){
            $price = $row->position;
            $newprice = (number_format(($price*1.1)/100,0,',',''))*100;
            $row->position = $newprice;
            $row->save();
        }
        foreach ($details as $row){
            $price = $row->original_price;
            $newprice = (number_format(($price*1.1)/100,0,',',''))*100;
            $row->original_price = $newprice;
            $row->save();
        }
    }
    public static function getMyMetaTeg()
    {
        /*$item_arr = [
            ['fundament-s-rostverkom','Преимущества свайно-ростверкового фундамента, заказать','Устанавливаем свайно-ростверковый фундамент для дома качественно и в минимальные сроки! Наши профессионалы сделают все на высшем уровне. Тел.☎+7 (915) 91 000 55','Свайно-ростверковый фундамент'],
['lentochnyj-fundament','Преимущества ленточный фундамент для домов различного типа','Критерии выбора ленточного фундамента. У нас можно заказать фундамент под деревянный дом. Качественная заливка и быстрые сроки ☑ Москва и МО, ☎+7 (915) 91 000 55 Сруб-Строй','Ленточный фундамент для домов разных типов'],
['lentochnyj-melkozaglublennyj-fundament','Преимущества мелкозаглубленного ленточного фундамента-заказать в Москве','Технологические этапы монтажа мелкозаглубленного ленточного фундамента расскажет компания «Сруб-Строй». Многолетний опыт работы✔ Гарантия качества✔ Выполнение в установленные строки.','Мелкозаглубленный ленточный фундамент под ключ'],
['svajnyj-fundament','Преимущества свайно-винтового фундамента-заказать в Москве','Компания «Сруб-Строй» проводит монтаж свайно-винтового фундамента для деревянных домов. Оперативность✔ Низкие цены✔ Надежность. ☎ +7 (915) 91 000 55, Москва и Московская область','Монтаж свайно-винтового фундамента'],
['banya-5x5-kostroma','Сруб бани под ключ 5х5, фото, «Сруб-Строй»','Готовый проект добротной бани из сруба 5х5 м. в г. Кострома . Проверка качества сборки.','Баня 5х5 Кострома 2018'],
['brevno-mihnevo','Этапы строительство дома из сруба, фото','Фотографии наглядно показывают как происходит строительство дома из сруба в Михнево.','Строительство дома из сруба'],
['dom-iz-lafeta-novaya-riga','Дом из лафета с отделкой, фотогалерея','Роскошный загородный дом из лафета с отделкой в Новой-Риге от строительной компании Сруб-Строй','Дом из лафета - Новая Рига'],
['mihnevo-7x8-zima-2018','Дом из бруса 7х8, фотогалерея, «Сруб-Строй»','Фотографии реализованного нами проекта. Дома из бруса 7х8 м. в пос. Михнево.','Михнево 7х8 зима 2018'],
['otdelka-doma-iz-sruba','Отделка деревянного дома из сруба, фотогалерея','Реализованный проект отделки дома из сруба г. Чехов. Наши фотографии.','Отделка дома из сруба г. Чехов'],
['otdelka-doma-iz-sruba-2018','Дом из сруба с отделкой, галерея домов, «Сруб-Строй»','Фотографии отделки готового проекта загородного дома из бруса.','Отделка дома из сруба 2018'],
['banya-v-sochi','Русская баня в Сочи, новости «Сруб-Строй»','Рубленная баня по старорусским технологиям будет построена в городе курорте Сочи. При проектировании наши специалисты учтут природно-климатические особенности и проанализируют технические характеристики.','Русская баня от «Сруб – Строя» появится в Сочи'],
['dobrye-dela-v-chuhlome','Михаил Пуговкин родом из Чухломы','Компания «Сруб-Строй» помогала в организации фестиваля "Чухломская пуговка "в память об актере Михаиле Пуговкине в г. Чухлома. В музее кинотеатра представлены подлинные вещи актера, собранные его женой.','Добрые дела в Чухломе'],
['intervyu-maksima-yarygina','Максим Ярыгин руководитель компании Сруб-Строй','Руководитель компании Максим Ярыгин рассказывает о преимуществах строительства деревянных домов. Делится тонкостями подбора древесины.','Интервью Максима Ярыгина'],
['kachestvennye-bani-ot-srub-stroj','Лена Ленина о русских банях от «Сруб-Строй»','Высокий уровень квалификации и подготовки специалистов нашей компании по достоинству оценила Лена Ленских. Возведенная баня от "Сруб-Строя" сделала её счастливой. Интервью с Леной Ленских.','Качественные бани “«Сруб-Строй»” заменят лучшие СПА-салоны'],
['korneliya-mango-ocenila-nashi-bani','Новости Корнелия Манго оценила бани по новой технологии','Наша компания реализовала проект бани для Корнелия Манго. Новые технологии теперь позволяют не ждать усадки сруба.','Корнелия Манго оценила наши бани'],
['new-year-2016','Поздравления с Новым годом, фото с поздравлением','Компания «Сруб-Строй» поздравляет всех своих партнеров, клиентов и заказчиков С Новым годом!','С наступающими праздниками Новым годом и Рождеством!'],
['pevets-sergej-krylov-otsenil-kachestvo-kostromskikh-ban','Певцу Сергею Крылову понравились бани от Сруб Строй','Деревянные бани из Костромы пришлись по душе певцу Сергею Крылову. На фотографиях певец оценивает одну из таких бань, которая уже готова принять первых посетителей.','Певец Сергей Крылов оценил качество костромских бань'],
['podorozhanie-domov-i-ban-iz-dereva','Строения из сруба дорожают','Наша компания информирует своих клиентов о подорожании цен на дома и бани на 10%. С 1 января 2018 г. вступит новое постановление , принятое правительством РФ.','Подорожание домов и бань из дерева на 10%'],
['samyj-luchshij-srub-iz-zimnego-lesa','Зимний сруб лучше летнего «Сруб-Строй»','Мы расскажем вам об особенностях зимнего леса, которые позволяют дереву сохранять максимальную прочность. Дом из зимнего леса служит дольше, чем из летнего.','Самый лучший сруб - из зимнего леса'],
['s-novym-godom','Поздравление с Новым Годом и Рождеством от компании «Сруб-Строй»','Компания «Сруб-Строй» поздравляет своих клиентов с Новым годом и Рождеством! Желает всем оптимизма, благополучия и стабильности.','С Новым 2018 Годом и Рождеством Христовым'],
['v-pamyat-o-velikom-aktere','Фестиваль Чухломская пуговка-Михаил Пуговкин - «Сруб-Строй»','В Чухломе пройдет фестиваль в память Михаила Пуговкина -"Чухломская пуговка". Артист родом из села Ремешки Чухломского района. Идею фестиваля поддержали Сергей Крылов и солист группы "Доктор Ватсон" Владимир Овчаров','В память о великом актере'],
['zvezdnye-bani-kompanii-srub-stroj','Бани для знаменитостей от «Сруб-Строй»','Звезды Российского шоу-бизнеса выбирают бани от компании «Сруб-Строй». Качество и экологически чистые материалы покоряют не только простых людей, но и знаменитостей.','«Звездные» бани компании «Сруб-Строй»'],
['eskiznyj-proekt','Заказать индивидуальный проект дома «Сруб-Строй»','У нас можно заказать как типовой проект дома, так и индивидуальный. Архитекторы компании «Сруб-Строй» помогут определиться с выбором. Любая сложность! Наш адрес: г. Москва, ул. Коммунистическая, д.25Г','Заказать индивидуальный проект дома'],
['etapy-rabot','Этапы строительства дома и бани из бруса, бревна','Строительство дома из бруса или бревна ведется от 6 до 9 месяцев строго соблюдая технологии. Надежность и качество от компании «Сруб-Строй». Выполним заказ в назначенный срок! ☎ +7 (915) 91-000-55','Этапы и сроки строительства домов и бань'],
['garantii','Гарантии компании на строительство «Сруб-Строй»','Гарантия на построенные дома и бани от компании «Сруб-Строй» составляет 3 года. Предлагаем своим клиентам выгодные условия сотрудничества +7 (915) 91-000-55. Многолетний опыт!','Гарантии на строительство от компании «Сруб-Строй»'],
['kak-oformit-zakaz','Оформить заказ на строительство дома из бруса под ключ','Наши специалисты быстро выполнят необходимые расчеты и предоставят смету дома, бани. Оформить заказ можно через сайт или прийти к нам в офис: г. Москва, ул. Коммунистическая, д.25Г','Оформление заказа строительства дома под ключ'],
['on-line-kalkulyator','Калькулятор для расчета стоимости деревянного дома и бани','Рассчитать стоимость деревянного дома или бани можно самостоятельно с помощью бесплатного калькулятора. Оставьте комментарий к заявке и наши менеджеры свяжутся с вами.','Калькулятор строительства дома'],
['oplata','Способы оплаты-доставка дома, бани из бруса','Преимущества нашего предложения. Предоплата на дома и бани из бруса всего 5%. Предоплата на заливку фундамента 0%. Принимаем к оплате материнский капитал.','Оплата и доставка срубов'],
['otdelka','Отделка деревянных домов и бань «Сруб-Строй»','Строго соблюдаем технологии, используем качественные материалы. Индивидуальный подход к каждому клиенту. Фотографии отделочных работ реализованных нами проектов домов и бань.','Отделка деревянного дома и бани от компании «Сруб-Строй»'],
['rabochaya-dokumentacziya','Договор на изготовление дома, бани из сруба','Типовые образцы договоров и соглашений на строительство фундамента, на изготовление и поставку срубов для домов и бань. Адрес компании «Сруб-Строй»: г. Москва, ул. Коммунистическая, д.25Г','Договор на изготовление и поставку сруба'],
['tseny-na-derevyannye-doma-i-bani','Цена на строительство деревянного дома и бани, «Сруб-Строй»','Стоимость дома складывается из: размеров коробки, установки коммуникаций, количества этажей, наличия лестниц, террас, материалов для кровли и пола. Прайс-лист- доступные цены на дома с отделкой и без','Цены на строительство деревянных домов и бань'],
['tseny-na-fundamenty','Цена на строительство фундамента деревянного дома, бани под ключ','Стоимость заливки фундамента зависит от количества стен, размеров, глубины заложения. Заливка размером 4х6 (работа+материалы)-125 000 руб. Звоните: +7 (915) 91 000 55','Цены на строительство фундамента под ключ'],
['sb-10-banya-7x7','Проект бани из бревна 7х8, цена проект фото бани','Интересный проект одноэтажной бани с террасой. Кроме парной, душевой и комнаты отдыха в бане имеется санузел и тамбур. Привлекательная цена. «Сруб-Строй»','SB-10: Проект бани из бревна 7х8'],
['sb-11-2-banya-4x4','Проект бани из бревна 4х4, проект фото цена на баню от «Сруб-Строй»','Компактная баня из бревна по доступной цене для маленьких загородных участков. Проектом предусмотрена: душевая, парная и комната отдыха. ☎+7 (495) 997 10 78','SB-11-2: Баня из бревна 4х4'],
['sb-11-3-banya-4x4','Проект бани из бревна 4х4 рубка углов в лапу, цена на баню проект','Небольшая уютная баня с рубкой углов в "лапу". Проектом предусмотрена: парная, душевая и комната отдыха. Баня по доступной цене. г. Москва, ул. Коммунистическая, д.25Г','SB-11-3: Проект бани из бревна 4х4 в лапу'],
['sb-11-banya-4x4','Проект бани 4х4-бани из сруба в Москве и области','Проект бюджетной бани площадью 17 кв. м для небольшой семьи. Есть все необходимое: душевая, парная и комната отдыха. Отличное качество.☎+7 (495) 997 10 78','SB-11: Проект бани из бревна 4х4'],
['sb-12-banya-6x6','Проект двухэтажной бани из оцилиндрованного бревна, цена на баню','Эксклюзивный проект деревянной двухэтажной бани площадью 79 кв. м с мансардой и верандой из рубленного бревна. Парная, душевая и две комнаты отдыха. г. Москва, ул. Коммунистическая, д.25Г','SB-12: Проект бани из бревна 6х6'],
['sb-13-banya-6x8','Сруб бани 6х8, проект цена фото в Москве и области','Добротная деревянная баня размером 7х8 м с верандой. Удобное расположение помещений внутри: парная, душевая и комната отдыха. г. Москва, ул. Коммунистическая, д.25Г ☎+7 (495) 997 10 78','SB-13: Проект бани 6х8'],
['sb-14-2-banya-6x6','Проект бани из бревна 6х6 в Москве и области','Качественная баня площадью 22 кв. м. с верандой для загородного участка. В бане предусмотрена: парная, душевая, комната отдыха. Доступная цена. «Сруб-Строй»☎+7 (495) 997 10 78','SB-14-2: Баня из бревна 6x6'],
['sb-14-banya-6x6','Проект бани из сруба с террасой, фото бани цена «Сруб-Строй»','Отличная баня размером 6х6м с большой верандой. Типовой проект содержит: парную, душевую и комнату отдыха. Приятная цена. Строительство от компании «Сруб-Строй»','SB-14: Баня 6x6'],
['sb-15-banya-6x7','Проект бани 7х7, цена и фото бани «Сруб-Строй»','Прекрасная баня из бревна размером 7х7 м с большой верандой и балконом. В бане есть: парная, душевая и две комнаты отдыха. г. Москва, ул. Коммунистическая, д.25Г ☎+7 (495) 997 10 78','SB-15: Проект бани 7х7'],
['sb-16-2-banya-5x7','Баня из бревна 5х7 стропильная система, проект цена фото бани','Баня из бревна размером 5х7м с верандой по демократичной цене. Отличный выбор для загородного участка. Качество, короткие сроки исполнения. ☎+7 (495) 997 10 78','SB-16-2: Баня из бревна 5x7'],
['sb-16-banya-5x7','Проект бани 5x7 - сборка с кровлей, купить баню, «Сруб-Строй»','Добротная баня из бревна площадью 30 кв.м и размером 5x7 м. Один этаж, на котором расположена веранда, душевая, парная и комната отдыха. Баня по демократичной цене. «Сруб-Строй»','SB-16: Баня 5x7'],
['sb-17-2-banya-7x6','Баня из бревна 7х6 с террасой, проект бани цена и фото','Симпатичная рубленная баня размером 7х6 м с удобной планировкой. В проект входит: терраса, парная, душевая, комната отдыха. Низкая стоимость и быстрое возведение от компании «Сруб-Строй»','SB-17-2: Баня из бревна 7х6'],
['sb-17-banya-7x6','Сруб бани 7х6 с террасой, цена проект фото - бани в Москве и области','Чудесная рубленная одноэтажная банька площадью 35 кв. м. по сравнительно недорогой цене. Удобная планировка: парная, душевая и большая комната отдыха. ☎+7 (495) 997 10 78','SB-17: Баня 7х6'],
['sb-18-2-banya-5x5','Баня из сруба 5х5, доставка разгрузка сборка бани, «Сруб-Строй»','Уютная баня из сруба площадью 23 кв. м для дачного участка. Проектом предусмотрено: веранда, душевая, парная и комната отдыха. Недорого за короткие сроки. Компания «Сруб-Строй»','SB-18-2: Баня из сруба 5х5,5'],
['sb-18-banya-5x5','Проект бани из бревна 5х5 с террасой, цена заказать проект, фото бани','Привлекательная баня из бревна площадью 23 кв. м замечательно впишется на небольшом дачном участке. Удобный проект: веранда, комната отдыха, душевая и парная. Тел.☎+7 (915) 91 000 55 Сруб-Строй','SB-18: Баня 5х5,5'],
['sb-19-2-banya-6x7','Баня из сруба 6х7 с террасой, цена проект фото бани в Москве и области','Замечательная одноэтажная рубленной бани из бревна 6х7 м с террасой по привлекательной цене. Проектом предусмотрено: веранда, тамбур, с/у, парная, душевая, комната отдыха.','SB-19-2: Баня из сруба 6х7'],
['sb-19-banya-6x7','Проект рубленной бани с террасой 6х7 - купить баню, «Сруб-Строй»','Бюджетная баня из бревна площадью 37 кв. м с большой террасой. Для удобства кроме душевой и парной проектом предусмотрен: тамбур, санузел и большая комната отдыха. «Сруб-Строй»','SB-19: Баня 6х7'],
['sb-1-banya-4x6','Проект деревянной бани 4х6, цена фото бани «Сруб-Строй»','Компактная баня из бревна площадью 25 кв. м с верандой по доступной цене. Проектом предусмотрено: парная, душевая и комната отдыха. г. Москва, ул. Коммунистическая, д.25Г ☎+7 (495) 997 10 78','SB-1: Проект бани из бревна 4х6'],
['sb-20-banya-65x5','Проект бани из бревна с мансардой 5х6, цена бани','Добротная баня с мансардой и верандой из оцилиндрованного бревна. Фронтоны обшиты вагонкой. Перегородки каркасные. Для удобства предусмотрен санузел.','SB-20: Баня 6,5 на 5 с мансардой'],
['sb-21-2-banya-55x5','Проект бани из бревна ручной рубки 5х5, цена и фото бани, Москва и область','Небольшая одноэтажная банька площадью 22 кв. м с террасой по доступной цене. Можно приобрести баню в компании «Сруб-Строй» в короткие сроки ☎+7 (495) 997 10 78','SB-21-2: Баня из бревна 5,5х5'],
['sb-21-banya-55x5','Баня из бревна с террасой 5х5: проект, цена, фото','Симпатичная банька из бревна размером 5х5 м с крылечком и террасой для не большого загородного участка. Качество, надежность, доступные цены. г. Москва, ул. Коммунистическая, д.25Г','SB-21: Баня 5,5х5'],
['sb-22-banya-7x6','Баня рубленная с верандой 7х6, купить в Москве и области','Уютная баня из рубленного бревна площадью 34 кв. м под ключ. Проект включает в себя: тамбур, душевую, парилку и комнату отдыха. ☎ +7 (915) 91-000-55','SB-22: Баня 7х6'],
['sb-23-2-banya-6x5','Проект бани из сруба 6х5, цена фото бани - заказать проект','Эффектная одноэтажная баня из сруба 6х5 м для загородного участка. Отличительная особенность бани-это эркер, который делает комнату отдыха просто большой.','SB-23-2: Проект бани из сруба 6х5'],
['sb-23-banya-6x5','Проект бани 6х5 - цена бани доставка «Сруб-Строй»','Оригинальная баня площадью 23 кв. м. с эркером и крыльцом. Планировка бани включает все необходимое: парная, душевая, комната отдыха. г. Москва, ул. Коммунистическая, д.25Г ☎+7 (495) 997 10 78','SB-23: Проект бани 6х5'],
['sb-24-banya-5x65','Проект бани из бревна 5х6, фото цена постройки','Эффектная баня площадью 24 кв. м с красивым входом. В бане вместительная парная и большая комната отдыха. Фундамент ленточный. ☎ +7 (915) 91-000-55','SB-24: Проект бани 5х6,5'],
['sb-25-banya-6x6','Баня с мансардой и балконом 6х8, проект бани цена и фото в Москве','Большая баня из бруса с мансардой и балконом по выгодной цене. На первом этаже расположены: душевая, помывочная, кухня-гостиница-на втором комната отдыха.','SB-25: бани с мансардой и балконом 6х8'],
['sb-26-banya-8x55','Баня из бревна 8х5, цена заказать проект бани «Сруб-Строй»','Уютная бревенчатая баня с красивой открытой террасой. Проектом предусмотрена: большая комната отдыха, парная и душевая. Высокое качество по приемлемой цене. «Сруб-Строй»','SB-26: Баня 8х5,5'],
['sb-27-banya-5x6','Баня из бревна рубка в чашу 5х5, купить баню - заказать проект','Комфортная одноэтажная банька площадью 23 кв. м идеально подойдет для дачного участка. Интересный проект объединенного тамбура и крыльца. г. Москва, ул. Коммунистическая, д.25Г ☎+7 (495) 997 10 78','SB-27: Баня 5х6'],
['sb-28-banya-7x95','Баня из бревна 7х9, доставка разгрузка бани на участке «Сруб-Строй»','Восхитительная баня для любителей отдыхать с комфортом! Проектом предусмотрена бройлерная, санузел, раздевалка, парная, душевая и шикарная комната отдыха.☎ +7 (915) 91-000-55','SB-28: Баня 7х9,5'],
['sb-29-banya-6x5','Баня из бревна 6х5 в Москве и области - заказать типовой проект','Уютная баня площадью 28 кв. м с просторной террасой. Планировка предусматривает душевую, парную и комнату отдыха. Приятная цена, высокое качество от компании «Сруб-Строй»','SB-29: Баня 6х5'],
['sb-2-banya-5x8','Проект бани из бревна 5х8, проект бани цена и фото сооружения','Симпатичная одноэтажная деревянная баня для дачного участка. Продуманная планировка включает в себя тамбур, санузел, большую душевую, парную и просторную комнату отдыха.','SB-2: Проект бани из бревна 5х8'],
['sb-30-banya-6x55','Проект бани из бревна 6х5, доставка бани, заказать проект Москва и область','Прекрасная баня из бревна с просторной верандой, помывочным отделением и комнатой отдыха. Идеально подойдет для загородного участка. Качество на высоком уровне и доступные цены от компании «Сруб-Строй»','SB-30: Баня 6х5,5'],
['sb-31-2-banya-5x7','Баня из сруба 6х7, недорого купить в Москве «Сруб-Строй»','Привлекательная баня из бревна площадью 23 кв. м замечательно впишется на небольшом дачном участке. Удобный проект: веранда, комната отдыха, душевая и парная. Тел.☎+7 (915) 91 000 55 «Сруб-Строй»','SB-31-2: Баня из сруба 5х7'],
['sb-31-banya-5x7','Баня рубленная 5х7 с крыльцом, заказать проект в Москве и области','Удивительная баня для тех, кто любит жар. Большая парилка и душевая, уютная комната отдыха. г. Москва, ул. Коммунистическая, д.25Г ☎+7 (495) 997 10 78','SB-31: Баня 5х7'],
['sb-32-banya-5x6','Баня из бревна 5х6, проект цена фото бани, доставка','Интересный проект русской бани из бревна предусматривает кроме большого отделения для мытья еще и топочную. Отличное качество по приемлемой цене. «Сруб-Строй»','SB-32: Баня 5х6'],
['sb-33-banya-8x5','Баня из бревна 8х5 в Москве и области «Сруб-Строй»','Изящная одноэтажная баня из бревна площадью 38 кв. м с просторной террасой и комнатой отдыха. Такая банька будет радовать своих хозяев качеством и ценой.','SB-33: Баня 8х5'],
['sb-34-banya-5x8','Баня из бревна 5х8, проект цена фото, заказать проект бани','Уютная русская банька из бревна для дачного участка. Проектом предусмотрено: помывочное отделение и большая комната для отдыха. г. Москва, ул. Коммунистическая, д.25Г ☎+7 (495) 997 10 78','SB-34: Баня 5x8'],
['sb-35-banya-7x5','Баня из бревна 7х5, цена проект бани, доставка','Добротная баня из бревна с большим помывочным отделением и большой комнатой отдыха. Для комфорта проектом предусмотрен санузел. ☎ +7 (915) 91-000-55','SB-35: Баня 7х5'],
['sb-36-banya-6x6','Баня из бревна 6х7, цена проект фото бани, купить недорого','Русская одноэтажная рубленная баня с предбанником и крыльцом. Планом предусмотрено: тамбур, комната отдыха и большое отделения для мытья. Отменное качество по хорошей цене.☎+7 (495) 997 10 78','SB-36: Баня 6х7'],
['sb-37-banya-6x8','Баня из бревна 6х8, проект цена купить баню','Изящная баня с большой террасой по демократичной цене. Идеально подойдет для загородных участков вытянутой формы. Для комфорта предусмотрен санузел.','SB-37: Баня 6х8'],
['sb-38-banya-9x7','Баня из лафета 9х7, цена типовой проект, фото бани','Замечательная баня из лафета площадью 55 кв. м с большой террасой. Планом предусмотрена большая парная, санузел и комната отдыха. ☎+7 (495) 997 10 78','SB-38: Баня 9х7'],
['sb-39-1-banya-8x85','Рубленная баня из бревна 8х8, цена фото проект заказать недорого','Прекрасная рубленная баня из бревна 8х8,5 м с открытой террасой для загородного участка по привлекательной цене. В проекте есть тамбур, помывочное отделение, санузел и комната отдыха.','SB-39-1: Рубленная баня 8х8,5'],
['sb-39-banya-8x85','Проект бани из бревна 8х8, доставка и сборка стоимость','Интересная баня из бревна площадью 54 кв. м с большой открытой верандой. В план бани входит: помывочное отделение, санузел, комната отдыха. Все для удобства и комфорта парящихся.☎+7 (495) 997 10 78','SB-39: Баня 8х8,5'],
['sb-3-banya-7x5','Проект бани из бревна 7х5 на заказ «Сруб-Строй», заказать недорого','Уютная и компактная одноэтажная банька 7х5 м с крылечком, тамбуром, санузлом, помывочным отделением и большой комнатой отдыха. Отличное качество материала по сходной цене.☎ +7 (915) 91-000-55','SB-3: Проект бани из бревна 7х5'],
['sb-40-banya-5x9','Баня из сруба 5х9 м с мансардой, проект этажей, цена купить баню','Роскошная русская баня с мансардным этажом и красивым крыльцом из бревна. Эта баня просто гордость хозяина! Проектом предусмотрено-три комнаты и душевая с парной. г. Москва, ул. Коммунистическая, д.25Г','SB-40: Баня с мансардой и крыльцом 5х9'],
['sb-41-banya-6x6','Проект бани из бревна 5x7 с балконом и мансардой, цена фото доставка бани','Дивная банька из бревна с изящным балконом и мансардным этажом. Планом предусмотрено: большая парилка, душевая комната, гостиная и комната отдыха. ☎ +7 (915) 91-000-55','SB-41: Баня с балконом и мансардой 5x7'],
['sb-42-banya-8x11','Баня из бревна с мансардой 7х10 цена купить недорого «Сруб-Строй»','Отличная баня площадью 89 кв. м. для длительного времяпрепровождения вдали от города. На плане изображено: большое помывочное отделение с санузлом, кухня-гостиная, две комнаты отдыха.☎+7 (495) 997 10 78','SB-42: Баня с мансардой и террасой 7х10'],
['sb-43-banya-6x18','Баня из бревна 6х18 с бассейном, выгодная цена проект фото','Эксклюзивный проект бани площадью 130 с большим бассейном и патио. Баня для любителей отдохнуть с роскошью и комфортом вдали от городской суеты. Для этого предусмотрено: парная, душевая, санузел.','SB-43: Баня 6х18'],
['sb-44-banya-6x10','Проект бани из бревна 7х10 с мансардой в Москве, заказать проект','Великолепная рубленная баня из бревна с мансардным этажом, балконом и двумя входами. На первом этаже- тамбур, гостиная, кухня, парная, душевая, санузел. В мансарде- комната отдыха и гардеробная.','SB-44: Баня с мансардой и 2 входами 7х10'],
['sb-45-2-banya-6x5-7','Баня из бревна 6x5, цена проекта, фото бани, выгодно купить «Сруб-Строй»','Маленькая, но комфортная банька из бревна площадью 30 для небольшого земельного участка. Есть все необходимое: открытая веранда, парная, душевая и комната отдыха. ☎+7 (495) 997 10 78','SB-45-2: Баня из бревна 6x5,7'],
['sb-45-banya-6x5-7','Баня из бревна 6x5, доставка сборка дома с кровлей, цена бани','Уютная деревянная банька 6х 5,7 м с верандой по сравнительно недорогой цене. Типовой проект. г. Москва, ул. Коммунистическая, д.25Г ☎+7 (495) 997 10 78','SB-45: Баня из сруба 6x5,7'],
['sb-46-banya-5x7','Проект рубленной бани 5х7, цена проекта бани фото','Прекрасная рубленная баня из сруба размером 5х7м для дачного участка. Отличное качество по демократичной цене от компании «Сруб-Строй» г. Москва, ул. Коммунистическая, д.25Г ☎+7 (495) 997 10 78','SB-46: Проект рубленной бани 5х7'],
['sb-47-banya-6x10','Проект бани из бревна 6х10, доставка сборка бани с кровлей','Типовая деревянная баня из сруба 6х10 м с большой верандой. В набор русской бани входит: тамбур, парная, душевая, санузел и комната отдыха. Превосходное качество, отличный строительный материал.','SB-47: Проект бани из бревна 6х10'],
['sb-48-banya-5x8','Баня из бревна 5х8 два этажа, цена проекта бани «Сруб-Строй»','Дивная русская баня площадью 56 с большой остекленной террасой для частного участка. Гарантия качества и приятные цены. «Сруб-Строй».☎ +7 (915) 91-000-55','SB-48: Баня из сруба 5,2x7,9'],
['sb-49-banya-5x8','Баня из бревна 5х8, проект бани цена и фото, доставка сборка','Симпатичная одноэтажная баня из бревна размером 5х8 м по доступной цене. Простой типовой проект включает в себя веранду, дешевую, парную и комнату отдыха.','SB-49: Баня из бревна 5x8'],
['sb-4-banya-5x5','Проект сруба бани 5х5, купить выгодно, заказать проект бани','Приятная банька из дерева с небольшим крылечком. Удобная планировка: душевая, парная и комната отдыха. Экологически чистый материал. г. Москва, ул. Коммунистическая, д.25Г ☎+7 (495) 997 10 78','SB-4: Проект бани из бревна 5х5'],
['sb-50-banya-6x8','Баня двухэтажная 6х8, сборка доставка бани «Сруб-Строй»','Прекрасная двухэтажная баня из сруба с балконом и верандой по привлекательной цене. Планом бани предусмотрено: душевая, парная, санузел, комната отдыха. На втором этаже-две комнаты.','SB-50: Баня из сруба 6x8'],
['sb-51-1-banya-11x11','Баня из бревна двухэтажная 11х11, цена проекта фото бани, купить недорого','Шикарная двухэтажная баня из сруба большой площадью с двумя входами и балконом. Для любителей комфорта предусмотрена зона барбекю, кухня, парная, душевая, гардеробная, санузел и три комнаты отдыха.','SB-51-1: Баня из бревна 11x11'],
['sb-51-banya-11x11','Баня из сруба 11х11, заказать проект оплата «Сруб-Строй»','Привлекательная двухэтажная баня из бруса большой площади с балконом и двумя входами. Проектом предусмотрено: бассейн, парная, душевая, санузел, кухня, гардероб. На втором этаже три комнаты.','SB-51: Баня из сруба 11x11'],
['sb-52-banya-5x8','Баня из сруба двухэтажная 8х9, цена бани фото, заказать проекты','Добротная двухэтажная баня из бревна площадью 120 для загородного участка. Планировка предусматривает: три комнаты, парную, душевую и кухню-гостиную. Высокое качество материалов.','SB-52: Баня из сруба 8x9'],
['sb-53-banya-5x6','Баня из сруба в два этажа 5х6, доставка сборка бани, заказать проект','Простая, но симпатичная двухэтажная деревянная баня. По плану в бане: отделение для мытья, парилка и комната отдыха. Высокое качество и низкая цена от компании «Сруб-Строй» ☎+7 (495) 997 10 78','SB-53: Проект бани из сруба 5x6'],
['sb-54-banya-7x8','Баня из сруба 7х8, выгодная цена «Сруб-Строй»','Замечательная рубленная баня из бревна с крыльцом и террасой. Все есть для парящихся: тамбур, комната отдыха, душевая, парная и санузел. Демократичная цени и отличное качество.','SB-54: Баня из сруба 7x8'],
['sb-55-banya-5x8','Баня из бревна 5x8, цена бани проект доставка дешево «Сруб-Строй»','Бюджетная деревянная баня из бруса с просторной верандой и зоной барбекю для отличного загородного отдыха. «Сруб-Строй» г. Москва, ул. Коммунистическая, д.25Г ☎+7 (495) 997 10 78','SB-55: Проект бани из бревна 5x8'],
['sb-56-banya-8x10','Проект рубленной бани из бревна 8х10, выгодная цена доставка','Эффектная двухэтажная баня площадью 135 кв. м с верандой и балконом. В плане бани предусмотрено: тамбур, котельная, душевая, парная, два санузла, кухня-столовая и четыре комнаты','SB-56: Проект бани из бревна 8х10'],
['sb-57-banya-8x9','Двухэтажная баня из сруба 8x9, проект фото цена бани, сборка','Статусная баня из сруба в два этажа с балконом и верандой по привлекательной цене в короткие сроки. В проект входит: помывочное отделение с санузлом, три комнаты отдыха','SB-57: Проект бани из сруба 8x9'],
['sb-58-banya-9x10','Проект рубленной бани из бревна 9x10 недорого заказать проект «Сруб-Строй»','Эффектная деревянная баня большой площади высотой в два этажа. Баня имеет два входа, веранду с зоной барбекю, балкон. В самой бане имеется парная, душевая, санузел, кухня, гардероб и комнаты','SB-58: Баня из сруба 9x10'],
['sb-59-banya-7x8','Рубленная баня из бревна 7x8, цена проекта, доставка сборка бани','Великолепная рубленная баня с остекленной верандой и мансардным этажом. Для комфортного отдыха предусмотрено: парная, душевая, санузел и три комнаты отдыха. г. Москва, ул. Коммунистическая, д.25Г','SB-59: Проект бани из бревна 7x8'],
['sb-5-banya-7x7','Баня рубленная из бревна 7х7, цена доставка и сборка бани','Интересный проект бани площадью 42 для загородного участка. Отличительная черта проекта-большая терраса. Привлекательная цена, отменное качество. ☎+7 (495) 997 10 78','SB-5: Бани из бревна 7х7'],
['sb-6-banya-6x8','Проект бани из бревна 6х8, оплата и доставка, сборка бани','Русская банька из бруса с красивым крылечком. Проектом предусмотрено: просторная парная, душевая и большая комната отдыха. Доступная цена, гарантия качества, быстрые сроки.☎ +7 (915) 91-000-55','SB-6: Проект бани из бревна 6х8'],
['sb-7-2-banya-6x5','Проект бани из бревна 6х5, сборка в короткие сроки, заказать проект','Уютная баня из дерева с симпатичным крыльцом для небольшого дачного участка. В план бани входит: веранда, душевая, парная и комната отдыха. Экологически чистые материалы от компании «Сруб-Строй»','SB-7-2: Баня из бревна 6х5,3'],
['sb-7-3-banya-6x5','Сруб бани из бревна в лапу 6х5, цена проекта, купить выгодно доставка','Скромная, но уютная баня с верандой по доступной цене. Рубка сруба в лапу. В план бани входит: парная, душевая и комната отдыха. г. Москва, ул. Коммунистическая, д.25Г ☎+7 (495) 997 10 78','SB-7-3: Сруб деревянной бани в лапу 6х5,3'],
['sb-7-banya-6x5','Сруб бани из бревна 6х5, цена проект фото бани, кутить в Москве','Простая и качественная деревянная баня из бруса площадью 28 кв. м для компактного дачного участка. В проект входит: парная, душевая и комната отдыха. Высокое качество по сходной цене.','SB-7: Сруб бани из бревна 6х5,3'],
['sb-8-2-banya-6x7','Проект бани из бревна 6х7 по выгодной цене «Сруб-Строй»','Замечательная одноэтажная баня из бревна с террасой и двумя входами. Для удобства предусмотрено: большая парная, душевая и комната отдыха. г. Москва, ул. Коммунистическая, д.25Г ☎+7 (495) 997 10 78','SB-8-2: Проект бани из бревна 6х7'],
['sb-8-banya-6x7','Проект бани из бревна 6х7,цена доставка и сборка бани','Прекрасная рубленная баня площадью 34 . с верандой для дачного участка. Отличительная черта бани-два входа и большое помывочное отделение.','SB-8: Проект бани из бревна 6х7'],
['sb-9-2-banya-7x5','Проект рубленой бани из бревна 7х5, цена фото доставка','Симпатичная рубленная баня размером 7х5 м с верандой. Удобная планировка помещений. Проектом предусмотрено: тамбур, душевая, парная, санузел и просторная комната отдыха.','SB-9-2: Проект рубленой бани 7х5'],
['sb-9-banya-7x5','Проект бани из бревна 7х5 заключение договора','Приглядная одноэтажная деревянная баня площадью 30 кв. м. с верандой для любителей загородного отдыха. В план бани входит: душевая, парная, санузел и большая комната отдыха.','SB-9: Проект бани из бревна 7х5'],
['s10-proekt-doma-9x6','Проект дома из бревна под ключ 9х7, цена купить выгодно','Интересный дома из бревна площадью 102 . На мансардном этаже расположены три стальные комнаты. Используемый материал ель или сосна. г. Москва, ул. Коммунистическая, д.25Г ☎+7 (495) 997 10 78','S10: Проект дома из бревна 9х7'],
['s11-proekt-doma-6x10','Проект дома из бревна 6х10, цена планы дома доставка и сборка','Приятный деревянный дом из бревна с мансардой и просторной террасой. Проектом предусмотрено: крыльцо, тамбур, санузел, кухня-гостиная и две комнаты отдыха. ☎+7 (495) 997 10 78','S11: Проект дома из бревна 6х10'],
['s12-proekt-doma-6x9','Купить сруб дома из бревна под ключ 6х9 «Сруб-Строй»','Отличный дом из бруса площадью 81 с мансардой, верандой и балконом для загородного отдыха всей семьей. Комфортное удобство-просторная гостиная и две комнаты. Высокое качество по приятной цене.','S12: Проект дома из бревна 6х9'],
['s13-proekt-doma-7x9','Проект дома из бревна 7х9, купить недорого','Интересный дизайн деревянного дома из бруса. Вход с дом через просторную, светлую веранду площадью 18,8 . Большая кухня-гостиная и две комнаты отдыха на мансарде.☎+7 (495) 997 10 78','S13: Проект дома из бревна 7х9'],
['s14-proekt-doma-8x13','Проект дома из бревна 8х13, низкая цена доставка и сборка «Сруб-Строй»','Прекрасный дом из бруса большой площади с верандой и балконом. На первом этаже предусмотрено: кабинет, санузел, кухня, большая гостиная. На втором расположились кладовая и четыре спальни.','S14: Проект дома из бревна 8х13'],
['s15-proekt-doma-9x10','Проект дома из бревна 9х10, фото цена дома доставка','Добротный дом из бревна с мансардным этажом и небольшой верандой. Базовой комплектацией проекта предусмотрено: тамбур, холл, кухня, санузел, кабинет, гостиная и три спальни на мансарде. «Сруб-Строй»','S15: Проект дома из бревна 9х10'],
['s16-proekt-doma-10x9','Проект дома из бревна 10х9, два этажа «Сруб-Строй»','Роскошный деревянный дом большой площади с двумя входами, террасой и просторным балконом. Шесть комнат. Котельная дает возможность проживать в коттедже круглый год. ☎+7 (495) 997 10 78','S16: Проект дома из бревна 10х9'],
['s17-proekt-doma-9x7','Проект дома из бревна 9х7, цена фото дома - доставка сборка дома','Уютный рубленный дом с мансардой. На первом этаже расположились кухня, санузел, гостиная, спальня. На втором этаже - три комнаты отдыха. Гарантия качества по демократичной цене от «Сруб-Строй»','S17: Проект дома из бревна 9х7'],
['s18-proekt-doma-10x12','Двухэтажный дом из бревна под ключ 10х12 с мансардой, заказать проект','Эффектный деревянный дом из бревна с мансардой и балконом. На первом этаже планом дома предусмотрено помывочное отделение и крытая пристройка. На втором - помещение свободной планировки.','S18: Проект дома из бревна 10х12'],
['s19-proekt-doma-7x7','Проект дома из бревна 7х7 с мансардой, фото и цены на дом «Сруб-Строй»','Компактный загородный дом из бруса площадью 80 с мансардным этажом. Стандартной планировкой предусмотрено: тамбур, кладовая, санузел, кухня, гостиная и две спальни. Доступные цены и высокое качество.','S19: Проект дома из бревна 7х7'],
['s1-proekt-doma-8x11','Проект дома из бревна 8х11, оплата и доставка недорого','Комфортный загородный дом из бруса большой площади с верандой и двумя санузлами. На первом этаже предусмотрено: тамбур, прихожая, гостевая, кухня. На втором этаже расположились четыре комнаты отдыха.','S1: Проект дома из бревна 8х11'],
['s20-proekt-doma-9x10','Проект дома из бревна под ключ 9х10, цена дома фото, доставка и сборка','Дом интересного дизайна из бревна площадью 139 с мансардным этажом, двумя входами, душевой и сауной. Информация о планировке: крыльцо, веранда, санузел, кухня, гостиная и четыре спальни.','S20: Проект дома из бревна 9х10'],
['s21-proekt-doma-14x20','Проект дома из бревна в два этажа 14х20: оплата и доставка','Роскошный деревянный дом из бревна 470 со вторым светом, просторной террасой и балконом. Проектом предусмотрена котельная-кладовая, кухня-столовая, 2 санузла, кабинет, гардеробная и 5 комнат отдыха.','S21: Проект дома из бревна 14х20'],
['s22-proekt-doma-8x8','Проект двухэтажного дома из бревна 8х8 с мансардным этажом','Изящный бревенчатый дом с мансардой, где могут проживать несколько человек. Для удобства продумана большая гостиная, кухня, санузел и три спальни на втором этаже. Экологически чистое дерево.','S22: Проект дома из бревна 8x8'],
['s2-proekt-doma-9x9','Проект дома из бревна под ключ 7х8, цена фото сруба «Сруб-Строй»','Добротный деревянный дом большой площадью с топочной и двумя санузлами. На первом этаже предусмотрено просторное помещение предназначенное под кухню-гостиную, на втором расположились три спальни.','S2: Проект дома из бревна 7х8'],
['s30-proekt-doma-10x11','Проект дома из бревна 10x11, оплата и доставка сборка дома','Дом из бревна ручной рубки современного дизайна для загородного дома размером 10x11 м. План предусматривает веранду, тамбур, кухню, два санузла и восемь комнат. Доступная цена от компании «Сруб-Строй»','S30: Проект дома из бревна 10x11'],
['s31-proekt-doma-9x10','Дом из бревна 9x10, проект дома цена фото «Сруб-Строй»','Комфортабельный дом из бревна площадью 90 с мансардой, балконом и двумя входами. Отличительная особенность проекта - котельная, два санузла, две гардеробные и шесть комнат.☎ +7 (915) 91-000-55','S31: Дом из бревна 9x10'],
['s32-proekt-doma-8x10','Проект деревянного дома из бревна под ключ 8x10','Необычный дом оригинального дизайна. Отличием проекта является наличие топочной. Для удобства проживания предусмотрено два санузла, большая кухня-гостиная, кладовая и две комнаты для отдыха. «Сруб-Строй»','S32: Дом из бревна 8x10'],
['s33-proekt-doma-7x7','Проект дома из рубленного бревна под ключ 7x7','Дивный дом ручной рубки площадью 90 с мансардным этажом и топочной. На первом этаже расположилась большая гостиная-кухня. Для удобства проживания предусмотрено два санузла и три комнаты на мансарде.','S33: Проект дома из бревна 7x7'],
['s34-proekt-doma-9x10','Проект дома из бревна 9x10, цена фото, заказать проект «Сруб-Строй»','Уютный деревянный одноэтажный дом стандартной планировки для загородного отдыха всей семьей. По плану предусмотрено: холл, санузел, кухня, гостиная и две комнаты. Высокое качество по доступной цене.','S34: Проект дома из бревна 9x10'],
['s3-proekt-doma-8x9','Проект дома из бревна под ключ 8х9, купить дом «Сруб-Строй»','Прекрасный дом из бруса площадью 126 с мансардой, верандой и балконом. По проекту предусмотрено: санузел, кабинет, кухня, гостиная и две спальни по 15 г. Москва, ул. Коммунистическая, д.25Г','S3: Проект дома из бревна 8х9'],
['s4-proekt-doma-9x9','Проект дома из бревна 9х9, купить дом в Москве','Прекрасный деревянный дом ручной рубки с небольшой верандой. Для комфортного проживания предусмотрено: топочная, два санузла, большое помещение свободной планировки для кухни-столовой-гостиной.','S4: Проект дома из бревна 9х9'],
['s5-proekt-doma-5x7','Проект дома из бревна 5х7 с мансардой, оплата и доставка дома','Уютный дом из бревна с мансардой, балконом и навесом для машины. Планировка продумана до мелочей: терраса, тамбур, санузел, кухня, гостиная. На верхнем этаже расположились две спальни и холл. «Сруб-Строй»','S5: Проект дома из бревна 5х7'],
['s6-proekt-doma-6x6','Проект дома из бревна в два этажа 6х6 , заказать проект «Сруб-Строй»','Современный дом из бревна площадью 99 с крыльцом для отдыха небольшой семьи за городом. Планом предусмотрено: тамбур, санузел, кухня, гостиная На мансарде расположились две спальни и кладовая.','S6: Проект дома из бревна 6х6'],
['s7-proekt-doma-9x8','Проект дом из бревна 9х8, сборка дома с кровлей «Сруб-Строй»','Благоустроенный деревянный дом площадью 133 с просторной верандой и балконом. На первом этаже предусмотрено: большая гостиница-кухня (43,5 ) и санузел. На мансардном этаже-три спальни.','S7: Проект дома из бревна 9х8'],
['s8-proekt-doma-8x8','Заказать проект дома из бревна 8х8 выгодная цена','Дом из бревна площадью 122 классического дизайна с мансардой, большой верандой и балконом. Для комфортного времяпрепровождения имеется просторная кухня-гостиная, два санузла и две спальни.','S8: Проект дома из бревна 8х8'],
['s9-proekt-doma-6x9','Купить дом из бревна 6х9, цена фото, заказать проект «Сруб-Строй»','Симпатичный дом ручной рубки с мансардой, верандой и балконом для загородного отдыха. В доме три комнаты, прихожая и санузел. Высокое качество материалов по доступной цена от компании «Сруб-Строй».','S9: Проект дома из бревна 6х9'],
['db-10-dom-iz-brusa-9x85','Проект двухэтажного дома из бруса 9х8, планы цена, заказать проект','Приятный дом из бруса площадью 120 с интересным оформлением фасада. Планом дома предусмотрена светлая гостиница и просторная кухня. На мансардном этаже расположились 3 спальни.+7 (915) 91 000 55','DB-10: Проект дома из бруса 9х8,5'],
['db-11-dom-iz-brusa-9x9','Проект дома из бруса под ключ 9х9, оплата доставка','Комфортабельный загородный дом из бруса с эркером и мансардным этажом. Этот дом для всесезонного проживания, так как планом предусмотрена топочная и три комнаты отдыха.☎+7 (495) 997 10 78','DB-11: Проект дома из бруса 9х9'],
['db-12-dom-iz-brusa-8x6','Проект дома из бруса 8х6, цена фото план «Сруб-Строй»','Симпатичный дом из профилированного бруса площадью 72 . с мансардой, верандой и балконом. Отличает этот проект-большая спальня на мансардном этаже (21 .) Экологически чистый материал от «Сруб-Строй»','DB-12: Проект дома из бруса 8х6'],
['db-13-dom-iz-brusa-5x6','Проект дома из бруса 5х6 по доступной цене','Симпатичный деревянный дом из бруса с мансардой для загородного отдыха. Типовой проект предусматривает: тамбур, санузел, кухню, гостиную и помещение свободной планировки на мансарде. ☎+7 (495) 997 10 78','DB-13: Проект дома из бруса 5х6'],
['db-14-dom-iz-brusa-5x4','Проект дома из бруса 5х4, фото цена доставка в Москве и области','Скромный дачный дом из дерева площадью 38 . с мансардой и крыльцом по доступной цене. В доме имеется: тамбур, санузел, вместительная кухня, гостиница и большая спальня.','DB-14: Проект дома из бруса 5х4'],
['db-15-dom-iz-brusa-6x5','Проект дома из бруса под ключ 6х5 купить дом «Сруб-Строй»','Миленький деревянный дом ручной рубки с мансардным этажом для отдыха за городом небольшой семьи. Площадь дома - 52 . В плане присутствует: тамбур, санузел, кухня, гостиная и спальня (22.5 )','DB-15: Проект дома из бруса 6х5'],
['db-16-dom-iz-brusa-7x5','Заказать проект дома из бруса 7х5, цена и фото дома','Скромный и недорогой деревянный дом из бруса с мансардой и верандой. В доме имеется все для отдыха: тамбур, санузел, кухня, гостиная и две спальни. г. Москва, ул. Коммунистическая, д.25Г','DB-16: Проект дома из бруса 7х5'],
['db-17-dom-iz-brusa-8x125','Проект дома из бруса с гаражом под ключ 8х12','Отличный готовый дом из бруса с мансардой и большим гаражом (28 ). На плане предусмотрено: холл, кладовая, два санузла, один из которых внушительных размеров (15 ), кухня и пять комнат.','DB-17: Проект дома из бруса 8х12,5'],
['db-18-dom-iz-brusa-9x125','Проект дома из бруса в два этажа 9х12, цена и фото дома','Прекрасный деревянный дом из бруса с мансардой, террасой, балконом. Проектом на первом этаже предусмотрено:2 входа, 2 тамбура, кухня, гостиная, кладовая, санузел. На втором этаже-ванная и 4 спальни.','DB-18: Проект дома из бруса 9х12,5'],
['db-19-dom-iz-brusa-8x11','Проект дома из профилированного бруса 8х11, цена фото заказать проект','Добротный дом из бруса с мансардой, эркером и балконом. Один из входов ведет в топочную. Большая светлая гостиная, санузел, ванная комната (12 ), вместительная кухня, кладовая и три спальни.','DB-19: Проект дома из бруса 8х11'],
['db-1-dom-iz-brusa-8x9','Проект дома из бруса с мансардой 8х9, выгодная цена, фото дома','Комфортный загородный деревянный дом с мансардным этажом. Планировка предусматривает: небольшой тамбур, кладовую, кухню, санузел, большой холл на втором этаже и четыре комнаты. Доступные цены.','DB-1: Проект дома из бруса 8х9'],
['db-20-dom-iz-brusa-10x7-5','Проект дачного дома из бруса 10х7, заказать проект «Сруб-Строй»','Интересный дом ручной рубки площадью 96 с мансардой и большой открытой верандой. В проект дома входит: холл, санузел, кухня и три комнаты. Доступные цены по привлекательной цене от «Сруб-Строй»','DB-20: Проект дома из бруса 10х7,5'],
['db-21-dom-iz-brusa-9x12','Проект дома из бруса с мансардой 9х12, заказать проект цена фото','Загородный деревянный дом с необычным дизайном интерьера площадью 144 с мансардой и балконом. Планом предусмотрено: веранда, санузел, больших размеров кухня и гостиная, две спальни и холл.','DB-21: Проект дома из бруса 9х12'],
['db-22-dom-iz-brusa-6x6','Проект дома из бруса 6х6, доставка и оплата деревянного дома','Довольно милый и недорогой дом из бруса с мансардным этажом, балконом и крыльцом для загородного отдыха. Типовой проект включает в себя: холл, кухню-гостиную и просторную спальню. ☎+7 (495) 997 10 78','DB-22: Проект дома из бруса 6х6'],
['db-23-dom-iz-brusa-6x9','Проект дома из бруса под ключ 6х9 «Сруб-Строй»','Благовидный деревянный дом с мансардой и крыльцом для отдыха всей семьей за городом. Проект отличает-большой холл с лестницей на первом этаже (20,5 ) и две уютные спальни на мансарде.','DB-23: Проект дома из бруса 6х9'],
['db-24-dom-iz-brusa-6x6','Проект дачного дома из бруса 6х6, цена дома сборка дома с кровлей','Скромный, но миленький дом из бруса небольших размеров с мансардой и вместительной террасой. В этом доме располагается кухня, гостиная и комната отдыха на мансардном этаже. Отличное качество древесины!','DB-24: Проект дома из бруса 6х6'],
['db-25-dom-iz-brusa-7x8','Проект дома из бруса 7х8 купить выгодно','Замечательный дачный деревянный дом из бруса с мансардой и открытой террасой. По проекту предусмотрено: прихожая, два холла, санузел-ванная, кухня, светлая гостиная и две спальни. ☎+7 (495) 997 10 78','DB-25: Проект дома из бруса 7х8'],
['db-26-dom-iz-brusa-9x8','Заказать проект дома из бруса 9х8, заказать проект «Сруб-Строй»','Комфортабельный деревянный дом площадью 79 с эркером и мансардой. Очень большая веранда, гостиная, огромная кухня-столовая с лестницей на второй этаж. На мансарде расположились две спальни.','DB-26: Проект дома из бруса 9х8'],
['db-27-dom-iz-brusa-8x8','Проект дома из бруса под ключ 8х8, доставка и сборка дама','Уютный дачный дом небольших размеров с мансардой и крытой террасой на два фасада. Планировкой предусмотрено: тамбур, санузел, просторная гостиная, холл и комната для отдыха. Демократичная цена!','DB-27: Проект дома из бруса 8х8'],
['db-28-dom-iz-brusa-12x9','Проект дома из бруса 12х9, планы и цена «Сруб-Строй»','Прекрасный брусовой дом площадью 144 с мансардой и большой верандой для загородного участка. В доме располагается: большой холл, светлая гостиница, санузел, кухня и две комнаты отдыха. «Сруб-Строй»','DB-28: Проект дома из бруса 12х9'],
['db-29-dom-iz-brusa-9x6','Проект брусового дома под ключ 9х6 купить дом недорого','Привлекательный деревянный дом из бруса площадью 102 с мансардой и крыльцом. Для комфортного проживания предусмотрено: три холла, санузел-душ, кухня и три спальни. Высокое качество от «Сруб-Строй»','DB-29: Проект дома из бруса 9х6'],
['db-2-dom-iz-brusa-10x6','Проект дома из бруса 10х6, доставка и оплата','Эстетичный загородный дом из бруса с мансардной частью, верандой, и балконом. Для комфортного отдыха продумано: тамбур, два холла, санузел, больших габаритов кухня-гостиная и три спальни на мансарде.','DB-2: Проект дома из бруса 10х6'],
['db-30-dom-iz-brusa-8x7','Проект дачного дома из бруса 8х7, сборка дома с кровлей','Интересный недорогой деревянный дом с мансардой и крытой террасой. Отличительная особенность проекта-огромная кухня по совместительству гостиная. В мансардной части расположились две спальни.','DB-30: Проект дома из бруса 8х7'],
['db-31-dom-iz-brusa-8x9','Проект дома из бруса под ключ 8х9, цена план фото дома','Изумительный одноэтажный деревянный дом из бруса с летним садом и крыльцом. В доме расположились: прихожая, кухня-столовая, гостиная, санузел и две спальни. Экологически чистый материал дерева.','DB-31: Проект дома из бруса 8х9'],
['db-32-dom-iz-brusa-6x6-m','Проект дома из бруса с мансардой 6х6 «Сруб-Строй»','Хорошенький дом из бруса маленькой площади с мансардой, крыльцом и балконом по скромной цене. Типовой проект предусматривает: кухню, санузел, гостиную и две спальни в мансардной части. «Сруб-Строй»','DB-32 Проект дома из бруса 6х6'],
['db-33-dom-iz-brusa-5x7','Проект дома из бруса 5х7, фото цена доставка и сборка','Бюджетный загородный деревянный дом площадью всего 60 с открытой верандой. Планировкой предусмотрено: санузел, гостиная, кухня с лестницей на мансардный этаж и две спальни с отдельными входами.','DB-33 Проект дома из бруса 5х7'],
['db-34-dom-iz-brusa-8x9','Проект деревянного дома под ключ 8х9, доступная цена «Сруб-Строй»','Деревянный дом с необычным фасадом. Грамотная планировка-тамбур, санузел, кухня, холл, вместительная гостиная и две спальни. Также предусмотрен балкон. г. Москва, ул. Коммунистическая, д.25Г','DB-34 Проект дома из бруса 8х9'],
['db-35-dom-iz-brusa-6x6','Проект дома из бруса 6х6, цена доставка и сборка дома','Дачный деревянный дом из бруса небольшой площади с мансардой и крыльцом. Отличительная черта проекта-очень большая спальня (27 ) на мансардном этаже. Отличное качество и доступная цена.+7 (495) 997 10 78','DB-35 Проект дома из бруса 6х6'],
['db-36-dom-iz-brusa-6x6','Проект дома из бруса 6х6 оплата и доставка дома','Недорогой деревянный дом из бруса площадью 58 с мансардой и крыльцом для загородного отдыха. На первом этаже расположено: кухня, санузел и гостиная. На верхнем этаже - две спальни с выходом на балкон.','DB-36 Проект дома из бруса 6х6'],
['db-37-dom-iz-brusa-10-5x7-5','Проект дома из бруса с гаражом 10х7, заказать проект «Сруб-Строй»','Симпатичный дом под ключ с мансардой и гаражом (12 ). Планировка предусматривает отдельный выход из столовой-гостиной на крытую веранду, а также небольшую кухню и две спальни.+7 (915) 91 000 55','DB-37 Проект дома из бруса 10,5х7,5'],
['db-38-dom-iz-brusa-7-5x10-5','Проект дома из бруса под ключ 7х10, цена и дома фото','Загородный дом из бруса площадью 126 с гаражом (12 ) и мансардой. Для комфортного отдыха предусмотрен отдельный выход из гостиной на небольшую веранду. На верхнем этаже - две спальни.','DB-38 Проект дома из бруса 7,5х10,5'],
['db-39-dom-iz-brusa-6x6','Проект дома из бруса с мансардой 6х6, заказать «Сруб-Строй»','Приятный загородный деревянный дом небольших размеров с мансардой. Здание имеет два входа. На мансардном этаже огромная спальня площадью 30 . г. Москва, ул. Коммунистическая, д.25Г +7 (495) 997 10 78','DB-39 Проект дома из бруса 6х6'],
['db-3-dom-iz-brusa-6x75','Дом из бруса 6х7, заказать проект дома цена планировка','Добротный дом из бруса с мансардой и красивой верандой. В доме есть большая гостиная с эркером, маленький санузел, кухня и две спальни с отдельными входами. Высокое качество и доступные цены. «Сруб-Строй»','DB-3: Проект дома из бруса 6х7,5'],
['db-40-dom-iz-brusa-13x10-5','Проект дома из профилированного бруса 13х10, цена доставка и сборка','Эффектный деревянный дом большой площади с мансардой, крыльцом и верандой. Очень большая кухня-гостиная (31,5 кв. м), холл с лестницей на второй этаж. На балкон можно попасть из холла и спальни.','DB-40 Проект дома из бруса 13х10,5'],
['db-41-dom-iz-brusa-14x12','Проект дома из бруса 14х12, сборка дома с кровлей','Шикарный загородный дом из бруса с мансардой. Внутри дома находится остекленная терраса, 4 санузла, огромных размеров кухня-гостиная (57 ), кладовая, игровая комната, большой холл и 7 комнат.','DB-41 Проект дома из бруса 14х12'],
['db-42-dom-iz-brusa-9x95','Проект брусового дома 9х9, цена дома фото доставка','Замечательный деревянный дом с мансардным этажом, двумя входами, террасой и топочной для круглогодичного проживания. Проектом предусмотрено: светлая гостиная с эркером, кухня, 2 санузла и 5 комнат.','DB-42 Проект дома из бруса 9х9,5'],
['db-43-dom-iz-brusa-22x18','Проект дома из бруса под ключ 22x18, цена фот доставка','Роскошный дом из бревна со статусным дизайном площадью 200 с мансардой, большой террасой и красивым балконом. В план коттеджа входит: топочная, огромная гостиная, кухня, 3 санузла и 6 комнат','DB-43: Проект дома из бруса 22x18'],
['db-44-dom-iz-brusa-7x8','Дом из бруса под ключ 7x8, заказать проект недорогая цена фото','Интересно оформленный двухэтажный дом из бруса с большими окнами площадью 70 . Проектом дома предусмотрено: кухня, гостиная, санузел, холл с лестницей на второй этаж, гардеробная и две спальни.','DB-44: Проект дома из бруса 7x8'],
['db-4-dom-iz-brusa-12x9','Проект дома из бруса 12х9 купить по низкой цене «Сруб-Строй»','Замечательный деревянный дом площадью 198 с мансардой. Два входа в дом: через веранду и с крыльца. На балкон второго этажа можно попасть из разных комнат. В коттедже большая кухня и 6 комнат.','DB-4: Проект дома из бруса 12х9'],
['db-5-dom-iz-brusa-12x14','Проект дома из бруса под ключ 12х14, оплата и доставка','Привлекательный дом из бруса площадью 197 современного дизайна со вторым светом. Планировкой предусмотрено: 4 веранды, 3 входа, топочная, санузел и ванная, кухня, кладовая и комнаты отдыха.','DB-5: Проект дома из бруса 12х14'],
['db-6-dom-iz-brusa-8x8','Проект дома из бруса с мансардой 8х8, купить дом в Москве','Интересный загородный дом из бруса с мансардным этажом и крыльцом. Грамотная планировка включает в себя: тамбур, санузел, вместительную кухню, уютную гостиную, холл с лестницей и 3 комнаты на мансарде.','DB-6: Проект дома из бруса 8х8'],
['db-7-dom-iz-brusa-11x8','Проект дома из бруса 11х8, купить недорого, заказать проект','Прекрасный деревянный дом из бревна площадью средних размеров с мансардой, верандой и балконом. Отличает проект эркер, который делает гостиную более светлой и огромная комната (36 ) на втором этаже.','DB-7: Проект дома из бруса 11х8'],
['db-8-dom-iz-brusa-6x85','Проект дома из профилированного бруса 6х8, цена дома фото','Привлекательный дачный дом с мансардой, большим крыльцом и балконом. На первом этаже имеется: холл, кухня, гостиная, санузел. На втором этаже - две спальни с независимыми выходами на общий балкон.','DB-8: Проект дома из бруса 6х8,5'],
['db-9-dom-iz-brusa-9x6','Проект дома из бруса 9х6, цена и планы «Сруб-Строй»','Бюджетный загородный деревянный дом с мансардным этажом и крыльцом. Для комфортного отдыха предусмотрено: тамбур, гостиная, санузел, кухня, холл с лестницей на мансарду и две огромные спальни.','DB-9: Проект дома из бруса 9х6'],
['s10l-proekt-doma-9x6','Проект дома из лафета 9х6, цена доставка сборка дома «Сруб-Строй»','Приятный деревянный дом из лафета площадью 102 с мансардным этажом. Готовый проект дома с двухскатной крышей, с крылечком, кухней, санузлом, гостиной и тремя комнатами отдыха по цене 845 500 р','S10L: Проект дома из лафета 9х6'],
['s11l-proekt-doma-6x10','Проект дома из лафета под ключ 6х10: планы, цена, фото','Симпатичный деревянный дом из лафета с мансардой для загородного участка по приемлемой цене. Планом предусмотрено: крыльцо, тамбур, терраса, санузел, кухня и две комнаты.«Сруб-Строй»+7 (915)91 000 55','S11L: Проект дома из лафета 6х10'],
['s12l-proekt-doma-6x9','Типовой проект деревянного дома из лафета 6х9: доставка и сборка','Добротный дом из лафета с мансардным этажом и балконом размером 6х9 м. Такой дом гармонично впишется в окружающий ландшафт. " Сруб-Строй" г. Москва, ул. Коммунистическая, д.25Г ☎+7 (495) 997 10 78','S12L: Проект дома из лафета 6х9'],
['s13l-proekt-doma-7x9','Проект дома из лафета 7х9-заказть проект в Москве «Сруб-Строй»','Оригинальный дизайн деревянного дома из лафета площадью 89 с мансардным этажом. Вход в дом через веранду эркерной формы. В плене дома: кухня-гостиная, санузел и две комнаты.','S13L: Проект дома из лафета 7х9'],
['s14L-proekt-doma-8x13','Дом из бревна под ключ 8х13: цена, проект, фото','Привлекательный двухэтажный дом из лафета большой площадью с верандой и балконом для большой семьи. Планировкой коттеджа предусмотрено: тамбур, прихожая, кухня, кабинет, санузел и шесть комнат.','S14L: Проект дома из лафета 8х13'],
['s16L-proekt-doma-10x9','Проект 2х этажного дома из лафета 10х9: цена доставка, сборка','Замечательный деревянный дом из лафета размером 10х9 м. На первом этаже предусмотрено: два входа, просторная веранда, тамбур, котельная, санузел, кухня. На втором этаже-кладовая, четыре спальни и балкон.','S16L: Проект дома из лафета 10х9'],
['s17L-proekt-doma-9x7','Проект дома из лафета под ключ 9х7 заказать Москве и области','Красивый двухэтажный деревянный дом из лафета с небольшой верандой, но просторной гостиной и четырьмя комнатами для отдыха. Доступная цена и высокое качество.☎+7 (495) 997 10 78','S17L: Проект дома из лафета 9х7'],
['s18L-proekt-doma-10x12','Проект рубленого дома из лафета 10х12 «Сруб-Строй»','Эффектный деревянный дом из лафета интересного архитектурного решения для загородного отдыха. На первом этаже расположено парное отделение, санузел. На втором - комната отдыха с выходом на балкон.','S18L: Проект дома из лафета 10х12'],
['s1l-proekt-doma-8x11','Проект дома из лафета 8х11: доставка, сборка дома с кровлей','Прекрасный проект дома из лафета базовой комплектации по цене 1348 500 р. Проектом коттеджа предусмотрено: два санузла, большая гостиная, кухня-столовая и шесть комнат. Звоните +7 (915)91 000 55','S1L: Проект дома из лафета 8х11'],
['s2l-proekt-doma-9x9','Проект деревянного дома под ключ 9х9: доставка, сборка','Шикарный деревянный дом из лафета большой площадью для круглогодичного проживания. Здание в два этажа. Грамотная планировка включает в себя топочную, два санузла и просторные комнаты.','S2L: Проект дома из лафета 9х9'],
['s3l-proekt-doma-8x9','Проект дома из лафета 8х9: цена, фото, доставка «Сруб-Строй»','Прекрасный дом из лафета площадью 126 с просторной верандой и балконом. Планом первого этажа предусмотрено: большая гостиная, холл, кабинет, кухня и санузел. На втором этаже - две спальни.','S3L: Проект дома из лафета 8х9'],
['s4l-proekt-doma-9x9','Проект деревянного дома из лафета 9х9 заказать','Роскошный деревянный коттедж большой площади с топочной и огромной гостиной на первом этаже. На мансардном этаже предусмотрено три большие спальни с раздельными входами.','S4L: Проект дома из лафета 9х9'],
['s5l-proekt-doma-5x7','Проект дома из лафета под ключ 5х7: цена и доставка','Уютный дом из лафета привлекательного дизайна с мансардой, балконом и навесом для стоянки машины. Проектом предусмотрено: терраса, тамбур, санузел, кухня, гостиная и две раздельные спальни.','S5L: Проект дома из лафета 5х7'],
['s6l-proekt-doma-6x6','Проект дома из лафета с мансардой 6х6: цена, фото','Комфортабельный дом из лафета с мансардным этажом и крыльцом для загородного отдыха всей семьей. Планировка предусматривает: тамбур, санузел, кухню, гостиную, кладовую и две спальни.','S6L: Проект дома из лафета 6х6'],
['s7l-proekt-doma-9x8','Дом из лафета 9х8: проект, цена, доставка «Сруб-Строй»','Восхитительный дом из лафета площадью 133 с большой верандой и просто огромной гостиницей-кухней. На мансардном этаже расположены три спальни и просторный балкон.«Сруб-Строй»+7 (915)91 000 55','S7L: Проект дома из лафета 9х8'],
['s8l-proekt-doma-8x8','Проект дома из лафета 8х8: доставка, сборка','Отличный деревянный дом из лафета с мансардным этажом, открытой верандой и просторным балконом для отдыха всей семьей за городом вдали от мегаполиса. г. Москва, ул. Коммунистическая, д.25Г ☎+7 (495) 997 10 78','S8L: Проект дома из лафета 8х8'],
['s9l-proekt-doma-6x9','Проект дома из лафета под ключ 6х9: цена, фото','Прекрасный загородный дом из лафета с верандой и балконом. Планировка предусматривает: прихожую, санузел, кухню-гостиную и две спальни. Экологически чистая древесина от компании «Сруб-Строй»','S9L: Проект дома из лафета 6х9'],
['db-10p-dom-iz-brusa-9x85','Проект дома из профилированного бруса 9х8: цена, фото','Интересный дом из профилированного бруса площадью 120 с мансардой и крыльцом. Для комфортного времяпрепровождения имеется: тамбур, санузел, кухня, светлая гостиная, холл и три спальни.','DB-10P: Дом из проф.бруса 9х8,5'],
['db-11p-dom-iz-brusa-9x9','Проект дома из профилированного бруса под ключ 9х9: доставка и оплата','Красивый деревянный дом с эркером, топочной и мансардным этажом для всесезонного проживания. Отличительная особенность проекта- большие и светлые помещения на первом этаже и огромные на втором.','DB-11P: Дом из проф.бруса 9х9'],
['db-12p-dom-iz-brusa-8x6','Проект дома из профилированного бруса 8х6 доставка и оплата «Сруб-Строй»','Бюджетный загородный дом из бруса интересного дизайна в два этажа с верандой и балконом. В доме имеется: холл, санузел, кухня, гостиная с лестницей и большой спальней. Высокое качество древесины.','DB-12P: Дом из проф.бруса 8х6'],
['db-13p-dom-iz-brusa-5x6','Проект дома из профилированного бруса 5х6, доставка цена дома фото','Уютный дом из профилированного бруса площадью 60 по доступной цене. Планировка предусматривает: тамбур, санузел, вместительную кухню, гостиную и огромную спальню. «Сруб-Строй»+7 (915)91 000 55','DB-13P: Дом из проф.бруса 5х6'],
['db-14p-dom-iz-brusa-5x4','Проект дома из профилированного бруса 5х4: доставка и оплата','Скромный деревянный дом из профилированного бруса с крыльцом по доступной цене. Дом примечателен большой комнатой на втором этаже (20 ).г. Москва, ул. Коммунистическая, д.25Г ☎+7 (495) 997 10 78','DB-14P: Дом из проф.бруса 5х4'],
['db-15p-dom-iz-brusa-6x5','Дом из профилированного бруса 6х5, цена планы помещений фото «Сруб-Строй»','Уютный дачный дом из бруса площадью 52 высотой в два этажа. Грамотная планировка помещений позволяет разместиться всей семьей. На втором этаже расположилась огромная спальня-22,5 кв.м. «Сруб-Строй»','DB-15P: Дом из проф.бруса 6х5'],
['db-16p-dom-iz-brusa-7x5','Проект дома из профилированного бруса 7х5, доставка сборка и оплата','Компактный дом из профилированного бруса с мансардой и просторной верандой. Планом предусмотрено: тамбур, санузел, вместительная гостиная, кухня с лестницей, холл и две спальни. ☎+7 (495) 997 10 78','DB-16P: Дом из проф.бруса 7х5'],
['db-17p-dom-iz-brusa-8x125','Проект дома из профилированного бруса под ключ 8х12 «Сруб-Строй»','Прекрасный дом из профилированного бруса с мансардной и двускатной крышей. Проектом предусмотрен гараж 28 . Выгодное расположение комнат. В доме имеется: 2 санузла, кладовая, кухня и 5 комнат.','DB-17P: Дом из проф.бруса 8х12,5'],
['db-18p-dom-iz-brusa-9x125','Дом из профилированного бруса в два этажа 9х12, дома цена и доставка','Изящный дом изысканного дизайна площадью 175 , в 2 этажа, с балконом, террасой. Два входа в дом. Планировка предусматривает: кухню, большую гостиную, кладовую, санузел, ванную и 4 спальни.','DB-18P: Дом из проф.бруса 9х12,5'],
['db-19p-dom-iz-brusa-8x11','Проект дома из профилированного бруса 8х11, цена фото доставка Москва','Эффектный деревянный дом с мансардой, топочной, двумя входами и балконом для проживания круглый год. Комфортная планировка-светлая гостиная с эркером, санузел , ванная, кладовая и три спальни.','DB-19P: Дом из проф.бруса 8х11'],
['db-1p-dom-iz-brusa-8x9','Проект дома из профилированного бруса с мансардой 8х9','Симпатичный загородный дом площадью 150 с двухскатной крышей и мансардой. Планом предусмотрено: тамбур, холл, кладовая, просторный санузел, кухня, гостиная с лестницей и три большие спальни.','DB-1P: Дом из проф.бруса 8х9'],
['db-20p-dom-iz-brusa-10x7-5','Проект дома из профилированного бруса 10х7, доставка и оплата','Отличный деревянный дом из профилированного бруса с мансардой и верандой. Планировка предусматривает: холл, санузел, кухню, большую гостиную с лестницей и две огромных спальни (28,5 и 24 )','DB-20P: Дом из проф.бруса 10х7,5'],
['db-21p-dom-iz-brusa-9x12','Проект деревянного дома из профилированного бруса 9х12, сборка дома с кровлей','Дом с необычно оформленным фасадом площадью 144 . Проектом предусмотрено: большая веранда, большая кухня, огромная гостиница, холл с лестницей на мансардный этаж, где расположились 2 спальни и балкон.','DB-21P: Дом из проф.бруса9х12'],
['db-22p-dom-iz-brusa-6x6','Проект дома из профилированного бруса 6х6, цена и фото дома доставка','Компактный и недорогой дом из бруса с мансардой, крыльцом и балконом. К особенностям планировки дома относятся две больших и светлые комнаты. Экологически чистая древесина от «Сруб-Строй» ☎+7 (495) 997 10 78','DB-22P: Дом из проф.бруса 6х6'],
['db-23p-dom-iz-brusa-6x9','Проект дома из профилированного бруса 6х9, доставка и сборка','Комфортный деревянный дом площадью 80 с мансардой и крыльцом по доступной цене. На первом этаже расположено: кухня-столовая, санузел, просторный холл с лестницей и две дополнительные комнаты отдыха.','DB-23P: Дом из проф.бруса 6х9'],
['db-24p-dom-iz-brusa-6x6','Проект дачного дома из профилированного бруса 6х6 «Сруб-Строй»','Простой и уютный дачный дом из профилированного бруса с мансардным этажом и большой террасой. На первом этаже: две комнаты (кухня и гостиная), на втором-просторная спальня. Гарантия качества и доступные цены.','DB-24P: Дом из проф.бруса 6х6'],
['db-25p-dom-iz-brusa-7x8','Дом из профилированного бруса 7х8, типовой проект цена','Прекрасный дом с мансардой для загородного отдыха. Вход в дом с крытой террасы. Планировка предусматривает: прихожую, холл, санузел/ванная, вместительную кухню, гостиную с лестницей, два спальные комнаты.','DB-25P: Дом из проф.бруса 7х8'],
['db-26p-dom-iz-brusa-9x8','Проект дома из бруса под ключ 9х8, доставка и сборка','Загородный дом из профилированного бруса площадью 79 с мансардным этажом, эркером и большой террасой. Планом предусмотрено: гостиная, кухня, столовая и две спальни средних размеров. «Сруб-Строй».','DB-26P: Дом из проф.бруса 9х8'],
['db-27p-dom-iz-brusa-8x8','Проект брусового дома под ключ 8х8, доставка Москва и область','Интересный дом из профилированного бруса с мансардой и террасой на два фасада. Выгодная планировка: тамбур, санузел, гостиная, кухня с лестницей и вместительная комната отдыха. Высокое качество материалов.','DB-27P: Дом из проф.бруса 8х8'],
['db-28p-dom-iz-brusa-12x9','Проект дома из профилированного бруса 12х9 «Сруб-Строй»','Симпатичный загородный дом площадью 144 с мансардой, верандой и балконом по выгодной цене. Коттедж отличается большой площадью комнат. г. Москва, ул. Коммунистическая, д.25Г ☎+7 (495) 997 10 78','DB-28P: Дом из проф.бруса 12х9'],
['db-29p-dom-iz-brusa-9x6','Проект дома из бруса под ключ 9х6, низкая цена оплата доставка','Замечательный деревянный дом с мансардой и крыльцом для загородного отдыха всей семьей. В плане предусмотрено: три холла, санузел-ванная, кухня, гостиная и две спальни с раздельными входами.','DB-29P: Дом из проф.бруса 9х6'],
['db-2p-dom-iz-brusa-10x6','Проект дома из профилированного бруса 10х6, доступная цена и фото','Привлекательный дом из профилированного бруса с мансардой, верандой и балконом. Грамотная планировка: тамбур, холл, кухня-гостиная и четыре комнаты. Отличное качество дерева и демократичные цены.','DB-2P: Дом из проф.бруса 10х6'],
['db-30p-dom-iz-brusa-8x7','Дом из профилированного бруса 8х7, проект дома цена фото','Красивый дом из дерева с двускатной крышей, мансардой и верандой по двум фасадам. По плану на первом этаже находится: холл, санузел-ванная, большая гостиная-кухня (28 .). На втором этаже-2 спальни.','DB-30P: Дом из проф.бруса 8х7'],
['db-31p-dom-iz-brusa-8x9','Дом из профилированного бруса под ключ 8х9, цена доставка сборка','Одноэтажный загородный дом современного дизайна с летним садом. По плану предусмотрено: прихожая, санузел, кухня-столовая, вместительная гостиная и две спальни. Экологически чистый материал.','DB-31P: Дом из проф.бруса 8х9'],
['db-32p-dom-iz-brusa-6x6-m','Дом из профилированного бруса 6х6, оплата и доставка дома','Недорогой дом из профилированного бруса площадью 58 с мансардой, крыльцом и балконом. Планировкой предусмотрено: светлая кухня, санузел, гостиная с лестницей на второй этаж, две спальни.','DB-32P: Дом из проф.бруса 6х6'],
['db-33p-dom-iz-brusa-5x7','Дом из профилированного бруса под ключ 5х7 в Москве и области','Компактный деревянный дом небольших размеров с мансардой и верандой для загородного участка. Удобная планировка: санузел, гостиная , кухня с лестницей и две спальни с независимыми входами.','DB-33P: Дом из проф.бруса 5х7'],
['db-34p-dom-iz-brusa-8x9','Проект деревянного дома 8х9, цена планы дома фото «Сруб-Строй»','Деревянный дом элегантного дизайна площадью 108 с мансардным этажом и балконом. На первом этаже расположились тамбур, кухня, санузел, гостиная, холл с лестницей и две спальные комнаты.','DB-34P: Дом из проф.бруса 8х9'],
['db-35p-dom-iz-brusa-6x6','Проект деревянного дома 6х6, оплата доставка сборка','Уютный дом из профилированного бруса в два этажа с крыльцом. Комфортная планировка: светлая гостиная, кухня, холл с лестницей на второй этаж, где находится огромная комната для отдыха. «Сруб-Строй»','DB-35P: Дом из проф.бруса 6х6'],
['db-36p-dom-iz-brusa-6x6','Дом из профилированного бруса с мансардой 6х6, доставка заказать проект','Изящный недорогой деревянный дом с мансардой, крыльцом и балконом для загородного отдыха всей семьей. Отличие этого коттеджа- общий балкон на две спальни. г. Москва, ул. Коммунистическая, д.25Г','DB-36P: Дом из проф.бруса 6х6'],
['db-37p-dom-iz-brusa-10-5x7-5','Проект дома из профилированного бруса 10х7 «Сруб-Строй»','Изумительный одноэтажный дом из бруса площадью 68 . Для комфортного отдыха предусмотрен гараж (12 ). Выход на крытую веранду из столовой-гостиной. Также в доме есть: санузел, кухня и две спальни.','DB-37P: Дом из проф.бруса 10,5х7,5'],
['db-38p-dom-iz-brusa-7-5x10-5','Дом из профилированного бруса с гаражом 7х10, проект цена купить','Добротный дом из профилированного бруса с мансардным этажом и верандой. Необычная планировка предусматривает: гараж, кухню, санузел, большую гостиную-столовую с лестницей и две огромные спальни.','DB-38P: Дом из проф.бруса 7,5х10,5'],
['db-39p-dom-iz-brusa-6x6','Дом из профилированного бруса под ключ 6х6, доставка и оплата','Бюджетный садовый дом из профилированного бруса с мансардой. Комфортной планировкой предусмотрено: два входа, кухня, санузел, гостиная, холл с лестницей на мансарду с большой спальной (30 )','DB-39P: Дом из проф.бруса 6х6'],
['db-3p-dom-iz-brusa-6x75','Дом из профилированного бруса 6х7, низкая цена проект и фото','Отличный загородный деревянный дом с эркером, мансардой и просторной верандой. Планировка дома предусматривает: холл, санузел, кухню, очень светлую гостиную и 2 комнаты отдыха. ☎+7 (495) 997 10 78','DB-3P: Дом из проф.бруса 6х7,5'],
['db-40p-dom-iz-brusa-13x10-5','Проект дома из профилированного бруса 13х10 «Сруб-Строй»','Идеальный дом из бруса с мансардой, крыльцом, верандой и балконом для отдыха за городом всей семьей. Планировка: 2 входа в дом, 2 санузла, тамбур, подсобные помещения, холл, огромная кухня и 4 комнаты.','DB-40P: Дом из проф.бруса 13х10,5'],
['db-41p-dom-iz-brusa-14x12','Проект дома из профилированного бруса 14х12, цена фото доставка','Восхитительный двухэтажный деревянный дом с крыльцом и остекленной террасой. Отличительная особенность: наличие четырех санузлов, роскошная кухня-гостиная (57 ) и большое количество комнат (девять)','DB-41P: Дом из проф.бруса 14х12'],
['db-42p-dom-iz-brusa-9x95','Проект дома из профилированного бруса 9х9, доставка и сборка,','Изящный дом из профилированного бруса с мансардным этажом, эркером, топочной и террасой для всесезонного проживания за городом. Грамотная планировка: 2 санузла, кухня, тамбур, холл и 6 комнат.','DB-42P: Дом из проф.бруса 9х9,5'],
['db-4p-dom-iz-brusa-12x9','Дом из профилированного бруса 12х9, заказать проект цена и фото','Прекрасный загородный деревянный дом площадью 198 с мансардой, верандой, балконом. Планом дома предусмотрено: 2 входа, тамбур, санузел, холл, гостиная, большая кухня-столовая и 5 комнат отдыха.','DB-4P: Дом из проф.бруса 12х9'],
['db-5p-dom-iz-brusa-12x14','Проект дома из профилированного бруса 12х14, гарантии качество материала','Изумительный дом современного дизайна со вторым светом, мансардой и топочной для круглогодичного проживания. Интересная планировка: 3 веранды, санузел, ванная, кладовая, гостиная (48 ), кухня и 3 комнаты.','DB-5P: Дом из проф.бруса 12х14'],
['db-6p-dom-iz-brusa-8x8','Дом из профилированного бруса 8х8, проект приемлемая цена доставка','Комфортный деревянный дом из бруса с двускатной крышей, мансардным этажом и крытым крыльцом. План дома включает: тамбур, санузел, вместительную гостиницу, холл с лестницей на мансарду и 3 спальни.','DB-6P: Дом из проф.бруса 8х8'],
['db-7p-dom-iz-brusa-11x8','Проект дома из профилированного бруса под ключ 11х8, доставка и сборка','Нарядный дом из бруса с эркером, мансардой, просторной верандой и балконом. Проектом предусмотрено: тамбур, санузел, вместительная кухня, светлая гостиная с лестницей и две комнаты. Доступная цена.','DB-7P: Дом из проф.бруса 11х8'],
['db-8p-dom-iz-brusa-6x85','Дом из профилированного бруса 6х8: оплата, доставка, сборка','Добротный загородный дом из бруса с мансардой, просторным крыльцом и общим балконом на две спальни. Типовая планировка: санузел, холл, кухня и 3 комнаты.☎+7 (495) 997 10 78 «Сруб-Строй»','DB-8P: Дом из проф.бруса 6х8,5'],
['db-9p-dom-iz-brusa-9x6','Проект дома из профилированного бруса 9х6, цена дома фото планы','Красивый деревянный дом площадью 108 с мансардным этажом и крытым крыльцом. На первом этаже находится: тамбур, кухня, большая гостиная, санузел, холл с лестницей. На втором-две просторные спальни.','DB-9P: Дом из проф.бруса 9х6'],
['akciya-vse-proekty-pri-10','Акции, скидки на деревянные дома и бани «Сруб-Строй»','Компания «Сруб-Строй» проводит беспрецедентную акцию: скидка -10% на все дома и бани из сруба по проектам из каталога до 31 декабря 2018г. ☎+7 (495) 997 10 78','Акция - все проекты при минус 10.'],
['limitirovannaya-akciya-20-skidki-na-priobretenie-bani-iz-sruba','Бани из сруба со скидкой «Сруб-Строй»','Лимитированная акция! Только 50 бань из сруба размером до 7 м можно приобрести со скидкой 20%. Не упустите свой шанс приобрести баню своей мечты по специальной цене!☎+7 (495) 997 10 78','Лимитированная акция: 20% скидки на приобретение бани из сруба'],
['armirovanie-fundamenta','Армирование фундамента, вентиляция фундамента, статьи «Сруб-Строй»','В этой статье рассказывается, что такое армирование фундамента и зачем нужна его вентиляция. Компания «Сруб-Строй» +7 (915)91 000 55.','Армирование и вентиляция фундамента'],
['bani-raznyh-narodov','Особенности планировки и строительства бани','В этой статье мы рассказываем о строительстве и особенностях планировки бань различных народов мира. Обзор основных видов национальных бань и нюансы их использования.','Бани разных народов. Особенности планировки и строительства'],
['banya-iz-dereva','Баня из дерева, постройка бани ручной рубки','Раздел посвящён деревянной бане. Самое важное в постройке бани-это выбор древесины. Ведь смысл ее посещения заключается в оздоровлении организма человека.','Баня из дерева'],
['betonomeshalka-iz-bochki','Бетономешалка из бочки своими руками: фото инструкция','Статья полезна тем, кто хотел бы своими руками сделать бетономешалку из бочки в домашних условиях. Подробная инструкция от компании «Сруб-Строй»','Бетономешалка из бочки'],
['czelebnye-svojstva-kedra-i-listvenniczy','Лечебные свойства лиственницы и кедра','В статье говорится о целебных свойствах древесины лиственницы и кедра. В деревянных строениях реже возникает боль, головокружение, стресс. В домах из бруса лучше себя чувствуют астматики, гипертоники.','Целебные свойства кедра и лиственницы'],
['derevyannye-doma-mify-i-zabluzhdeniya','Мифы и заблуждения о деревянных домах','Эта статья развеивает предрассудки о домах из дерева. Дом из бруса служит не меньше времени, чем дом из другого материала. При соответствующей обработке дома, плесень и грибок вам не страшны.','Деревянные дома: мифы и заблуждения'],
['derevyannyj-dom-srub-v-chashu','Деревянный дом, сруб в чашу или теплый угол','В этой статье вы узнаете о том, что правильная укладка бревен сруба в чашу исключает щели. Существенно экономит деньги на отделке. По этой технологии строили дома в древней Руси.','Деревянный дом: сруб в чашу'],
['dlya-chego-neobxodima-gidroizolyacziya-fundamenta','Гидроизоляции фундамента деревянного дома','Статья рассказывает об основных способах гидроизоляции фундамента в частном доме: метод всесторонней обработка, изолирования, напыления. Вертикальная гидроизоляция фундамента нужна для защиты от снега и влаги.','Для чего необходима гидроизоляция фундамента?'],
['doma-iz-brusa-ob-otoplenii','Отопление в доме из бруса, статья','Статья посвящена выбору отопления в деревянном доме: водяное, воздушное, печное или теплый пол. Определиться с выбором отопления стоит до начала возведения дома.','Дома из бруса - об отоплении'],
['doma-iz-brusa-ob-usadke','Усадка дома из бруса, статья «Сруб-Строй»','В этой статье мы рассказываем о том, как избежать сильной усадки дома из бруса. Грамотное решение проблемы при строительстве.+7 (915)91 000 55.','Дома из бруса - об усадке'],
['doma-iz-rublennogo-brevna','Особенности возведения домов из рубленного бревна','В статье мы рассказываем о строительстве дома из рубленного бревна, материал которого минимально подвергается обработке и не требует внутренней отделки. Критерии отбора древесины.','Дома из рубленного бревна и особенности их возведения'],
['dostoinstva-derevyannyh-domov','Достоинство деревянных домов «Сруб-Строй»','В этой статье мы разбираем основные преимущества деревянного дома. Эстетичный вид, долговечный материал, экологически чистый продукт, а также доступная стоимость пиломатериалов.','Достоинства деревянных домов'],
['fundament2','Фундамент для деревянного дома, особенности строительства','Статья содержит в себе основные правила строительства фундамента - как избежать и устранить дефекты фундаментов, защита от неблагоприятного воздействия влаги.','Правильный фундамент'],
['iz-chego-stroit-kakuyu-drevesinu-vybrat','Советы по выбору древесины для строительства дома из бруса','Эта статья поможет вам определиться с выбором древесины при строительстве дома. Различные породы деревьев имеют свои особенности.','Из чего строить? Какую древесину выбрать?'],
['kak-bezopasno-razzhigat-pech','Советы по безопасному розжигу печи в деревянном доме','Познавательная статья с советами печника как правильно пользоваться печью: разжигать, прочищать, регулировать тягу, топить.','Как безопасно разжигать печь – советы специалиста.'],
['kak-kupit-dom-na-materinskij-kapital-v-2017-godu-usloviya-i-trebovaniya','Материнский капитал на покупку деревянного дома','Тема статьи-покупка и возведение дома из бруса на материнский капитал: условия, требования и алгоритм действий.','Как купить дом на материнский капитал в 2017 году: условия и требования'],
['kak-otdelat-steny-derevyannogo-doma','Как отделать стены деревянного дома?','Материал посвящен вариантам отделки стен деревянного дома и какие инструменты для этого понадобятся.','Как отделать стены деревянного дома?'],
['kak-pristroit-verandu','Пристройка веранды к дому-проект веранды дома','В статье даются рекомендации как правильно пристроить веранду к дому. Разобраны примеры пристройки.','Как пристроить веранду'],
['kakuyu-krovlyu-dlya-doma-vybrat','Правильный выбор кровли для деревянного дома','Встали перед выбором какую кровлю выбрать для вашего дома? Эта статья поможет вам с этим разобраться.','Какую кровлю для дома выбрать?'],
['kanalizacziya-v-zagorodnom-doma','Варианты устройства канализации в загородном доме','На странице рассмотрены варианты автономной канализации в загородном доме - септик, выгребная яма, биологическая установка глубокой очистки, материалы, требования, предпочтения.','Канализация в загородном доме'],
['kleenyj-brus','Клееный профилированный брус-технологии производства бруса','В материале речь идет о достоинствах клееного профилированного бруса и технологиях его производства. Компания «Сруб-Строй»','Клееный профилированный брус'],
['kleenyj-brus-v-maloetazhnom-stroitelstve','Клеевой брус в малоэтажном строительстве','Раздел посвящен применению клеевого бруса при строительстве деревянных домов. Клеевой брус экологически безопасен, может быть обычным и утепленным.','Клееный брус в малоэтажном строительстве'],
['konopatka-doma-iz-brusa-ili-brevna','Конопатка сруба дома из бревна «Сруб-Строй»','Статья рассказывает что такое конопатка, когда надо использовать паклю, а когда герметик, какие инструменты использовать.','Конопатка дома из бруса или бревна'],
['krovelnye-materialy','Кровельные материал для деревянного дома, бани','На странице приведены различные виды кровельных материалов, даются советы по выбору и установке крыши.','Кровельные материалы'],
['neobychnye-doma','Необычные дома из дерева в мире «Сруб-Строй»','Эта статья посвящена необычным деревянным домам замысловатой формы. Приведены примеры как проектировщики видоизменяют здания, чтобы получить настоящий шедевр.','Необычные деревянные дома'],
['odin-iz-samykh-perspektivnykh-vidov-biznesa-na-segodnyashnij-den-prodazha-srubov','Продажа срубов как перспективный вид бизнеса','Материал содержит полезные советы и рекомендации тем, кто задумывается заняться таким бизнесом как продажа срубов.','Один из самых перспективных видов бизнеса на сегодняшний день - продажа срубов'],
['opalubka-fundamenta','Опалубка фундамента деревянного дома','Статья содержит некоторые сведения по опалубке фундамента.','Опалубка фундамента'],
['otbelivanie-drevisiny','Восстановление и отбеливание древесины','Статья рассказывает как сохранить древесину при помощи отбеливания. Отбеливание помогает удалить грибы и плесень.','Отбеливание древесины'],
['plastikovye-okna-vkratce-ob-osnovnyh-preimushchestvah-i-nedostatkah','Пластиковые окна в домах из бруса «Сруб-Строй»','В этом разделе мы рассказываем о преимуществах и недостатках пластиковых окон.','Пластиковые окна: вкратце об основных преимуществах и недостатках'],
['pochemu-dom-iz-brusa-ot-kompanii-qsrub-strojq','Дом из бруса от компании «Сруб-Строй», преимущества гарантии','На этой странице мы рассказываем о наших конкурентных преимуществах. Индивидуальный подход, гарантия качества, многолетний опыт. ☎+7 (495) 997 10 78','Почему дом из бруса от компании «Сруб-Строй»?'],
['podushka-fundamenta','Песчаная подушка под фундамент «Сруб-Строй»','В статье говорится о функциях песчаной подушки в устройстве фундамента. Рассказываем зачем нужна подушка, технология работ.','Песчаная подушка'],
['preimushhestva-domov-iz-obychnogo-i-profilirovannogo-brusa','Преимущества домов из обычного и профильного бруса','В разделе перечислены достоинства постройки домов из обычного и профилированного бруса-доступная цена, долговечность, не требует дополнительной отделки.','Преимущества домов из обычного и профилированного бруса'],
['preimushhestva-domov-iz-sruba','Преимущества деревянных домов «Сруб-Строй»','На странице рассказывается о значимости деревянных домов в жизни современного человека. Перечислены основные преимущества.','Преимущества срубов'],
['pri-stroitelstve-doma-zabor-poyavlyaetsya-ranshe-vsego-ostalnogo-rassmotrim-osnovnye-etapy-vozdvizheniya-zabora','Этапы возведения забора из дерева кирпича','Этот материал посвящен основным этапам строительства основы забора и выбору материала его верхней части.','Основные этапы строительства забора'],
['proekt-chtoby-ne-razrushit-a-postroit','Индивидуальный и типовой проект деревянного дома, статья','В статье рассказывается о важности составления проекта при строительстве дома. Польза от составления проекта дома. Каким проект бывает и из каких документов состоит.','Проект: чтобы не разрушить, а построить'],
['razmetka-fundamenta','Правильная разметка фундамента под деревянный дом','Раздел посвящен технологиям разметки фундамента , а так же как правильно разметить фундамент под строительство дома.','Разметка фундамента'],
['sekrety-otlichnyh-polov','Выбираем полы для бани «Сруб-Строй»','Статья рассказывает о возможных вариантах изготовления полов на даче и бане из различных материалов. Приведены примеры не протекающих и протекающих полов при строительстве бань.','Секреты отличных полов'],
['septik-konservacziya-i-zamerzanie',' Замерзание и консервация септика','Материал посвящен функциям и использованию септиков на летней даче. Рассказано как исключить замерзание септика в зимнее время года.','Септик - консервация и замерзание'],
['spasaem-stroeniya-ot-syrosti','Защита деревянного строения от сырости','В разделе делимся советами по гидроизоляции бани и бассейнов с внешних и внутренних сторон от воздействия воды.','Спасаем строения от сырости'],
['stili-oformleniya-derevyannyh-domov','Различные стили оформления деревянных домов','На странице рассматриваются всевозможные стили оформления интерьера в деревянном доме.','Стили оформления деревянных домов'],
['stroitelstvo-doma-iz-brusa-vybor-nagelej','Выбор нагеля при строительстве дома из бруса','Статья поможет сделать выбор между деревянными и металлическими нагелями при строительстве дома из бруса.','Строительство дома из бруса: выбор нагелей'],
['stroitelstvo-iz-profilirovannyh-brusev','Преимущества строительства из профилированных брусьев','Материал посвящен ценным свойствам брусового жилья. Экологически чистая древесина, комфорт, тепло и уют.','Преимущество строительства из профилированных брусьев'],
['strojka-v-osenne-zimnij-period','Особенности строительства деревянного дома осенью и зимой','На странице рассказываем на что следует обратить внимание при строительстве дома в осенне-зимний период. Планирование и этапы строительства дома из бруса.','Стройка в осенне-зимний период'],
['vidy-i-stroitelstvo-ban','Виды бань из сруба, консультация по выбору и строительству бани','Статья посвящена тому, какой информацией вы должны обладать прежде, чем начнете строительство деревянной бани.','Виды и строительство бань'],
['vnutrennyaya-otdelka-bani','Материалы для внутренней отделки бани «Сруб-Строй»','В материале рассматриваются различные материалы и их свойства для отделки помещений внутри бани и сауны.','Внутренняя отделка бани'],
['v-poslednee-vremya-proizoshli-znachitelnye-izmeneniya-i-vkusy-lyubitelej-zagorodnyx-domov','Выбор стиля загородного дома из сруба','В статье разбираются стили загородных деревянных домов и почему дома из бруса так популярны.','Загородные дома'],
['vybiraem-czement','Выбор цемента при строительстве частного дома','В статье даются советы по правильному выбору и покупке цемента при строительстве или ремонте частного дома.','Выбираем цемент'],
['vybiraem-proekt-dlya-bani','Различные варианты проектов для строительства бань','На странице сайта даются рекомендации на что следует обратить внимание при выборе бани из дерева.','Выбираем проект для бани'],
['zalivka-fundamenta','Особенности заливки фундамента, полезные статьи','В статье рассказываем о специфике заливки фундамента. Чем достигается оперативность, возможность сэкономить.','Заливка фундамента'],
['zima-les','Преимущества срубов из зимнего леса «Сруб-Строй»','Материал посвящен значимости сруба из зимнего леса. Какими ценными качествами обладает зимняя древесина.','Срубы из зимнего леса'],
['brusdom','Преимущества строительства дома из бруса','В статье рассматриваем положительные качества строительства домов из бруса. Таким домам присуща доступная цена, надежность и комфортабельность ☎ +7 (915) 91-000-55','Строительство домов из бруса'],
['doma-iz-breven-bolshogo-diametra','Преимущества строительства деревянных домов из больших бревен','В данном материале разбираем положительные моменты строительства дома из больших бревен: долговечность, экологичность, отличная теплопроводность.','Деревянные дома из больших бревен'],
['doma-iz-lafeta','Достоинства строительства домов из лафета | Компания «Сруб-Строй»','Раздел посвящен такому строительному материалу как лафет. В статье рассказано почему строительство из лафета выгодно.☎ +7 (915) 91-000-55','Дома из лафета'],
['srubban','Преимущества бань ручной рубки, полезные статьи','На странице рассматриваются положительные качества бани из рубленного бревна. Долговечность и надежность от профессионалов компании "Сруб-Строй. ☎ +7 (915) 91-000-55','Рубленные бани под ключ'],
['srubdom','Преимущества домов из рубленного дерева, полезные статьи','На этой странице компания "Строй Сруб" рассказывает о тонкостях строительства домов из рубленного бревна, о достоинства и недостатки данного материала. Адрес: г. Москва, ул. Коммунистическая, д.25Г','Дома из рубленного бревна'],
['sruby-iz-listvenniczy','Преимущества домов из сруба лиственницы, полезные статьи','В статье приведены причины по которым стоит построить дом из лиственницы: высокое содержание смол, высокая огнестойкость, долговечность, красивый природный материал. ☎ +7 (915) 91-000-55','Срубы домов из лиственницы'],
['zoomzoom','Преимущества домов из бревна ручной рубки «Сруб-Строй»','В разделе рассказывается о технологиях строительства домов из бревна ручной сборки. На фотографиях представлен весь технологический процесс от компании «Сруб-Строй»','Дома из бревна ручной рубки'],
['chem-strogannoe-brevno-luchshe-otsilindrovki','Преимущества строганого бревна над оцилиндрованным','Страница содержит ответ о преимущества строганого бревна, его физических свойствах.','Чем строганное бревно лучше оцилиндровки?'],
['chem-zashhitit-dom-ot-vlagi-i-gnieniya','Методы защиты деревянных домов от влаги и гниения','Поделимся с вами советами по защите деревянных сооружений от гниения и влаги.','Чем защитить дом от влаги и гниения?'],
['kak-pravilno-zashhitit-drevesinu-ot-gribka-i-pleseni','Методы и способы защиты древесины от грибка и плесени, полезные статьи','На странице содержится ответ на вопрос о защитите древесины от грибка и плесени при строительстве дома. Рассматриваем методы защиты древесины от спор и грибковой инфекции.','Как правильно защитить древесину от грибка и плесени?'],
['kak-zashhitit-dom-iznutri','Методы защита деревянного дом изнутри, полезные статьи','Статья содержит подробные предложения по защите дома изнутри от грибка, плесени, насекомых и жучков. Советы по выбору способов и материалов защиты.','Как защитить дом изнутри?'],
['stroite-li-vy-doma-na-materinskij-kapital','Использование материнского капитала на строительство деревянного дома','В этом разделе мы отвечаем на вопрос, связанный с приобретением или постройкой жилья из бруса на материнский капитал. Ответы на все основные вопросы по этой теме.','Строите ли Вы дома на материнский капитал?'],
['vybor-kamennogo-i-derevyannogo-zaborov','Выбор забора для частного дома загородом «Сруб-Строй»','Статья полезна тем, кто сомневается из какого материала построить забор для частного дома. Критерии выбора, достоинства и недостатки.','Какой забор выбрать для дачи или частного дома?'],
['zabor-iz-kirpicha-ili-kamnya','Преимущества строительства кирпичного и каменного забора','В материале представлены основные достоинства кирпичного или каменного забора. Рассмотрены этапы работ. ☎+7 (915) 91 000 55','Cстроительство кирпичных заборов'],
['zabor-iz-profnastila','Преимущества установки забора из профлиста «Сруб-Строй»','В статье рассмотрены основные причины выбора постройки забора из профилированного листа: обилие фактур, огнестойкость, прочность, долговечность. ☎ +7 (915) 91 000 55','Установка забора из профлиста под ключ'],
['zabory-iz-dereva','Преимущества установки забора из дерева «Сруб-Строй»','Статья интересна тем, кто выбрал строительство забора из дерева. Основные достоинства деревянного забора: эстетичность, экологичность, простота монтажа и ухода.','Строительство заборов из дерева'],
];
        foreach ($item_arr as $row){
            $items = Item::find()->where(['alias_item' => $row[0]])->one();
            $newTitle = $row[1];
            $newDesc = $row[2];
            $newH = $row[3];

            $items->title_seo = $newTitle;
            $items->description_seo = $newDesc;
            $items->title = $newH;
            $items->save();


        }*/

        /*$cat_arr = [['fundament','Возведение различных видов фундамента под ключ: компания «Сруб-Строй»','Выбираем оптимальный фундамент под деревянный дом и баню в зависимости от вида почвы . Большой выбор фундамента: с ростверком✔ ленточный✔ столбчатый✔ ленточный мелкозаглубленный✔','Возведение фундамента'],
            ['gallery','Фотогалерея деревянных домов и бань, «Сруб-Строй»','В галерее представлены различные фото готовых проектов домов и бань из сруба, бруса, лафета от компании Сруб-Строй. ☎ +7 (915) 91 000 55','Фотогалерея'],
            ['kontakt','Контакты: адрес и телефон компании «Сруб-Строй»','Вы можете связаться с нами любым удобным для вас способом, по телефону, viber, vk, e-mail, прийти в офис. Все контакты представлены на этой странице.','Контакты'],
            ['novosti','Новости компании по строительству деревянных домов и бань «Сруб-Строй»','Компания «Сруб-Строй» рассказывает о достижениях своей компании, а также делится новостями в области строительства деревянных домов.','Новости компании'],
            ['otzyvy','Отзывы о деревянных домах и банях строительной компании Сруб-Строй','Мы реагируем на отзывы наших клиентов и даем объективные ответы. Компания «Сруб-Строй» заботится о своей репутации.','Ваши отзывы'],
            ['price','Строительство деревянных домов под ключ Цены','С помощью калькулятора вы сможете сами рассчитать стоимость вашего будущего дома или узнать стоимость готового проекта. ☎ +7 (915) 91-000-55','Цены на строительство деревянных домов под ключ'],
            ['proekti-ban-iz-brevna','Бани из оцилиндрованного бревна под ключ, фото цена в Москве и области','Различные проекты бань из бревна с террасой, мансардой, балконом. Экологичная древесина. Сруб легко собирается, имеет привлекательный и аккуратный вид. +7 (495) 997 10 78','Бани из оцилиндрованного бревна'],
            ['proekti-domov-iz-brevna','Проекты домов из бревна, цены на бани, заказать проекты фото','В разделе представлены всевозможные модели двухэтажных домов из бревна на любой вкус. От недорого домика до элитного жилья. В Компании «Сруб-Строй» можно заказать дом по типовому или индивидуальному проекту.','Проекты домов из бревна'],
            ['proekti-domov-iz-brusa','Дома из бруса под ключ, низкие цены проекты фото «Сруб-Строй»','На странице каталога представлены модели деревянных домов из бруса классического дизайна. Рассмотрены преимущества брусовых домов. Высокая скорость постройки✔ Работаем 7 дней в неделю с 09:00-20:00!','Проекты домов из бруса под ключ'],
            ['proekti-domov-iz-lafeta','Дома из лафета под ключ, доступные цены и качество','На странице представлен каталог проектов деревянных домов построенных по скандинавской технологии - лафета. Доступные цены, высокое качество и экологически чистая древесина. ☎+7 (495) 997 10 78','Дома из лафета'],
            ['proekti-domov-iz-prof-brusa','Дома из профилированного бруса под ключ: проекты, цены «Сруб-Строй»','В разделе представлен каталог проектов домов из профилированного бруса с высотой в два этажа, разной площадью и количеством комнат. Компания «Сруб-Строй». Звоните +7 (915)91 000 55 ','Дома из профилированного бруса'],
            ['skidki','Скидки и акции на дома из бревна «Сруб-Строй»','Акции и скидки от компании «Сруб-Строй». При заказе проекта дома и бани из сруба диаметром 30-40 см скидка 12 %. Звоните +7 (915)91 000 55.','Скидки и акции'],
            ['stati','Статьи о деревянных домах «Сруб-Строй»','В этом разделе мы публикуем полезные материалы о строительстве деревянных домов и бань, строительство из сруба, лафета и бруса. Компания «Сруб-Строй»','Полезные статьи'],
            ['stroitelstvo-domov-i-ban','Строительство домов и бань из различных материалов из дерева «Сруб-Строй»','В статье дается обзор строительных материалов из которых делаются деревянные дома и бани, а также технологии их строительства.','Строительство домов и бань из дерева'],
            ['vopros-otvet','Ответы на вопросы о домах и банях из дерева «Сруб-Строй»91=На странице даны ответы на самые распространенные вопросы. Отвечает компания "Сруб -Строй" ','Ответы на ваши вопросы'],
            ['zabory','Строительство и установка заборов из различных материалов, статьи','Строительная компания «Сруб-Строй» изготовит забор из: профилированных металлических листов, кирпича или камня, а также из дерева. +7 (915) 91 000 55. ','Строительство и установка заборов под ключ'],
        ];
        foreach ($cat_arr as $row){
            $items = Category::find()->where(['alias_category' => $row[0]])->one();
            $newTitle = $row[1];
            $newDesc = $row[2];
            $newH = $row[3];

            $items->title_seo = $newTitle;
            $items->description_seo = $newDesc;
            $items->title = $newH;
            $items->save();


        }*/
        $teg_arr = [['proekti-ban-iz-brevna','5x5m','Бани из бревна 5х5 проекты, фото, цена от «Сруб-Строй» в Москве и области','Здесь представлены готовые проекты бань размером 5х5 м. из оцилиндрованного бревна от 331 000 р. Можем выполнить проекты из ели, сосны, лиственницы. ☎+7 (495) 997 10 78','Бани 5x5 из оцилиндрованного бревна'],
            ['proekti-ban-iz-brevna','5x6m','Бани из бревна 6х5 под ключ, проекты бани, фото и цена','Индивидуальные и типовые проекты бань 6х5 из оцилиндрованного бревна от 274 200 р. Сроки изготовления от 20 до 45 дней в зависимости от сложности проекта. ☎+7 (495) 997 10 78','Бани 6x5 из оцилиндрованного бревна'],
            ['proekti-ban-iz-brevna','6x6m','Бани 6x6 из бревна, проекты фото цена в Москве и области','Здесь представлены проекты одноэтажных и двухэтажных бань из бревна. Купить сруб можно в комплектации с отделкой. Доставки и сборка входит в стоимость услуг. г. Москва, ул. Коммунистическая, д.25Г','Бани 6x6 из бревна'],
            ['proekti-ban-iz-brevna','dvuhetazhnye','Двухэтажные бани из бревна проекты, цена для строительства от «Сруб-Строй»','Готовые проекты двухэтажных бань из оцилиндрованного бревна под ключ по цене от 421 500 р. Звоните +7 (495) 997 10 78','Проекты двухэтажных бань из бревна'],
            ['proekti-ban-iz-brevna','elitnye-dorogie','Элитные бани из бревна: проекты, фото, цена в Москве и области «Сруб-Строй»','Элитные бани из оцилиндрованного бревна под ключ отличаются своей индивидуальностью, площадью, количеством этажей и комнат. +7(495)997-10-78.','Элитные бани из бревна'],
            ['proekti-ban-iz-brevna','nedorogie','Недорогие бани из бревна под ключ, проекты цена фото Москва и область','В данном разделе представлены проекты недорогих бань. Их отличительная особенность - это компактный размер 4х4 м, при этом есть все необходимое: парная, душевая, комната отдыха. ☎+7 (495) 997 10 78','Недорогие бани из бревна'],
            ['proekti-ban-iz-brevna','odnoetazhnye','Одноэтажные бани из бревна, проекты цена фото от «Сруб-Строй»','В каталоге представлены проекты одноэтажных бань из бревна, разной площадью, но похожей планировки. Высокое качество материала и выгодные цены. Звоните +7 (495) 997 10 78','Одноэтажные бани из бревна'],
            ['proekti-ban-iz-brevna','s-balkonom','Проекты бань с балконом, цены фото, заказать проект бани «Сруб-Строй»','На странице представлены двухэтажные бани из бревна с балконом. Разобраны достоинства бань с балконом. Ручная рубка, экологически чистая древесина. Достойные цены от 421 500₽. ☎+7 (495) 997 10 78.','Проекты бань с балконом'],
            ['proekti-ban-iz-brevna','s-mansardoj','Бани из бревна с мансардой, проекты цена фото сооружения','В разделе представлены различные проекты деревянных бань с мансардой. Разобраны преимущества таких бань для загородного участка. Единая зона для парилки и жилой зоны.','Баня из бревна с мансардой'],
            ['proekti-ban-iz-brevna','s-terrasoj','Бани из бревна с террасой, цены проекты фото бань «Сруб-Строй»','Страница представляет собой каталог проектов готовых бань из бревна с террасой. Рассмотрены достоинства террасы: теплоизоляционная преграда, частичная защита для комнат. ☎+7 (495) 997 10 78.','Бани из бревна с террасой'],
            ['proekti-domov-iz-brevna','6x9m','Дома из бревна под ключ 6х9, проекты цена на дома фото','На странице представлены проекты компактных деревянных домов небольших размеров. Высокое качество материалов и доступная цена от компании «Сруб-Строй» г. Москва, ул. Коммунистическая, д.25Г ☎+7 (495) 997 10 78','Дома из бревна 6 на 9 под ключ: проекты и цены'],
            ['proekti-domov-iz-brevna','8x8m','Дома из бревна под ключ 8х8, цены фото заказать проект от «Сруб-Строй»','Страница представляет собой каталог бревенчатых домов размером 8х8 м разной площади. Привлекательный дизайн и продуманный план дома. Гарантия качества по бюджетной цене. ☎+7 (495) 997 10 78','Дома из бревна 8х8 под ключ: проекты и цены'],
            ['proekti-domov-iz-brevna','bolee-150-kv-m','Проекты домов из бревна от 150 до 200 кв. м, заказать проект «Сруб-Строй»','Каталог оригинальных моделей двухэтажные домов из бревна для всесезонного проживания. Если Вы не привыкли отказывать себе в роскоши и предпочитаете мегаполису тихую и спокойную жизнь за пределами города','Проекты домов от 150'],
            ['proekti-domov-iz-brevna','do-100-kv-m','Проекты домов из оцилиндрованного бревна площадью до 100 кв. м','В каталоге представлены разнообразные проекты малобюджетных, но качественных домов из бревна. Дома с гаражом, мансардой, верандой, балконами. г. Москва, ул. Коммунистическая, д.25Г ☎+7 (495) 997 10 78','Проекты срубовых домов до 100 кв. м из оцилиндрованного бревна'],
            ['proekti-domov-iz-brevna','ot-100-do-150-kv-m','Проекты домов из бревна от 100 до 150 кв. м, цена фото «Сруб-Строй»','Раздел посвящен моделям домов для всесезонного проживания площадью от 100 до 150 кв. м. В таком доме вам будет уютно и тепло. ☎+7 (495) 997 10 78','Проекты домов от 100 до 150 .'],
            ['proekti-domov-iz-brevna','s-balkonom','Проекты домов с балконом из бревна, проекты и цены «Сруб-Строй»','На странице представлен каталог готовых проектов двухэтажных домов из бревна с балконом. Большой выбор, ручная рубка, экологически чистая древесина. Брусовые дома недорого под ключ','Проекты домов из бревна с балконом'],
            ['proekti-domov-iz-brevna','s-kryltzom','Дома из бревна с крыльцом, заказать проекты и цены «Сруб-Строй»','Большой каталог готовых проектов домов ручной рубки из бревна с крыльцом. Высота сооружений-два этажа. Разнообразные и эксклюзивные проекты. Гарантия качества.','Проекты домов из бревна с крыльцом'],
            ['proekti-domov-iz-brevna','s-mansardoj','Проекты домов с мансардой из бруса, каталог, цена на дома «Сруб-Строй»','В разделе представлены модели деревянных домов из бревна с мансардным этажом. Современный и продуманный дизайн не оставит никого равнодушным. Высокое качество по привлекательной цене.','Проекты домов из бревна с мансардой'],
            ['proekti-domov-iz-brusa','5x6m','Дома из бруса 5х6, заказать проект низкие цены «Сруб-Строй»','В разделе представлен каталог готовых проектов деревянных домов под ключ для дачных и загородных участков. Подробная информация о комплектации сооружений. ☎+7 (495) 997 10 78','Дома из бруса 5 на 6: проекты и цены'],
            ['proekti-domov-iz-brusa','6x6m','Дома из бруса 6х6, цены выгодные проекты фото','Каталог загородных деревянных домов из бруса. Классический дизайн - идеальный вариант для загородного домостроения. Приемлемые цены и отменное качество материала от компании «Сруб-Строй»','Дома из бруса 6 на 6 под ключ: проекты и цены'],
            ['proekti-domov-iz-brusa','6x9m','Дома из бруса 6х9, интересные проекты цены «Сруб-Строй»','На странице представлены трехмерные визуализационные проекты загородных домов из бруса по демократичной цене. Различные размеры и конфигурации. Тел.☎+7 (915) 91 000 55 «Сруб-Строй»','Дома из бруса 6 на 9: проекты и цены'],
            ['proekti-domov-iz-brusa','8x8m','Проекты домов из бруса под ключ 8х8, цены фото ','Каталог двухэтажных деревянных домов из бруса для загородного времяпровождения. Дома под ключ, доступная цена, гарантия качества. г. Москва, ул. Коммунистическая, д.25Г ☎+7 (495) 997 10 78 ','Дома из бруса 8 на 8 под ключ: проекты и цены'],
            ['proekti-domov-iz-brusa','9x9m','Дома из бруса 9х9, проекты фото и цены на дома «Сруб-Строй»','На странице каталога представлены готовые проекты двухэтажных домов из бруса разной конфигурации и размеров для загородного участка от компании «Сруб-Строй»','Дома из бруса 9 на 9: проекты и цены'],
            ['proekti-domov-iz-brusa','bolee-150-kv-m','Проекты домов из бруса от 150 кв. м под ключ, доступные цены','В разделе представлен каталог моделей деревянных домов больших площадей. В таком доме можно проживать круглый год. Качественный брус большого сечения (не строганый, профилированный)Тел.☎+7 (915) 91 000 55 ','Проекты домов из бруса от 150'],
            ['proekti-domov-iz-brusa','dachnye-doma','Дачные дома из бруса, заказать проекты, цены и фото домов','На странице сайта представлены уютные дома для отдыха всей семьей на даче. Надежность и качество от компании «Сруб-Строй». г. Москва, ул. Коммунистическая, д.25Г ☎+7 (495) 997 10 78','Дачные дома из бруса'],
            ['proekti-domov-iz-brusa','dlya-postoyannogo-projivaniya','Дома из бруса для постоянного проживания, проекты и цена дома «Сруб-Строй»','Страница содержит каталог домов из бруса для круглогодичного проживания. Дома из экологически чистого материала: сосны, лиственницы, кедра. +7 (915) 91 000 55 «Сруб-Строй»','Дома из бруса для постоянного проживания'],
            ['proekti-domov-iz-brusa','do-100-kv-m','Проекты домов до 100 кв. м-дачные дома, цены и фото «Сруб-Строй»','В разделе представлен каталог проектов домов из бруса различной этажностью и количеством комнат. Дома по бюджетной стоимости, но с высоким качеством материалов.','Проекты домов до 100 .'],
            ['proekti-domov-iz-brusa','dvuhetazhnye','Двухэтажные дома из бруса, проекты и доступные цены «Сруб-Строй»','На странице представлены модели готовых домов из профилированного и не строганного бруса. Большой выбор, ручная рубка, экологически чистая древесина от компании Сруб-Строй.','Проекты двухэтажных домов из бруса'],
            ['proekti-domov-iz-brusa','odnoetazhnye','Проекты одноэтажных домов из бруса под ключ, проекты домов цена','Каталог содержит готовые проекты деревянных домов высотой в один этаж. Сооружения имеют отличные размеры и конфигурации, но объединяет их высокое качество древесины и исполнения.','Проекты одноэтажных домов из бруса'],
            ['proekti-domov-iz-brusa','ot-100-do-150-kv-m',' Проекты домов из бруса от 100 до 150 кв. м, цена и фото домов','Каталог содержит модели загородных домов с мансардой из бруса площадью до 150 для круглогодичного проживания. " Сруб-Строй" г. Москва, ул. Коммунистическая, д.25Г ☎+7 (495) 997 10 78','Проекты домов от 100 до 150'],
            ['proekti-domov-iz-brusa','s-balkonom','Проекты домов из бруса с балконом, приемлемые цены и фото','В каталоге представлены двухэтажные загородные дома с различными видами балконов. В зависимости от конфигурации дома балконы бывают открытыми или закрытыми. ','Проекты домов из бруса с балконом'],
            ['proekti-domov-iz-brusa','s-erkerom','Проекты домов из бруса с эркером под ключ «Сруб-Строй»','На странице представлены классические проекты деревянных домов из бруса с эркером. Рассмотрены плюсы и минусы на которые стоит обратить внимание при строительстве такого дома.','Проекты домов из бруса с эркером'],
            ['proekti-domov-iz-brusa','s-garazhom','Проекты домов из бруса с гаражом проекты и низкие цены','В разделе представлены модели деревянных домов из бруса с гаражом различных конфигураций и размеров. Удобно, компактно, практично. Отличное качество и бюджетные цены от компании «Сруб-Строй»','Проекты домов из бруса с гаражом'],
            ['proekti-domov-iz-brusa','s-kukushkoj','Проекты домов с кукушкой из профильного бруса, цены и фото','Страница представляет собой каталог готовых проектов домов из нестроганого и профилированного бруса с окном на двускатной крыше. Кукушка дает возможность максимально использовать весь объем мансарды.','Проекты домов из бруса с «кукушкой»'],
            ['proekti-domov-iz-brusa','s-mansardoj','Дома из бруса с мансардой, проекты низкие цены доставка «Сруб-Строй»','Каталог содержит модели деревянных домов из бруса с помещением чердачного типа-мансардой. Интересные дизайнерские решения, гарантия качества строительного материала по доступной цене.☎+7 (495) 997 10 78','Проекты домов из бруса с мансардой'],
        ];
        foreach ($teg_arr as $row) {
            $items = Tags::find()->where(['alias_category' => $row[0]])->andWhere(['alias_tags' => $row[1]])->one();;
            $newTitle = $row[2];
            $newDesc = $row[3];
            $newH = $row[4];

            $items->title_seo = $newTitle;
            $items->description_seo = $newDesc;
            $items->title = $newH;
            $items->save();
        }

    }
    public static function getHotPrice()
    {

        /*$r = [];
        $item = Item::find()->where(['category_id' => 6])->all();
        foreach ($item as $row){
            $newprice = $row->position;
            $newprice = (number_format((($newprice/90)*100)/100,0,',',''))*100;
            $row->position = $newprice;
            $row->save();
            $r[] = $row->id;
        }
        $detail = Details::find()->where(['item_id' => $r])->all();
        foreach ($detail as $row){
            $newprice = $row->original_price;
            $newprice = (number_format((($newprice/90)*100)/100,0,',',''))*100;
            $row->original_price = $newprice;
            $row->save();
        }*/

        $item_arr = [
            [23,997800,'DB-1'],
            [64,1017900,'DB-42'],
            [26,984200,'DB-4'],
            [40,1074500,'DB-18'],
            [62,1088500,'DB-40'],
            [27,1046800,'DB-5'],
            [63,1595000,'DB-41'],
            [297,2287100,'DB-43'],
            [84,1053900,'DB-4P'],
            [85,1219000,'DB-5P'],
            [98,1099500,'DB-18P'],
            [120,1179200,'DB-40P'],
            [122,1144500,'DB-42P'],
            [121,1637200,'DB-41P'],
            [329,1557200,'S-47'],
            [36,507000,'DB-14'],
            [94,559100,'DB-14P'],
            [330,595000,'DB-45'],
            //[,647900,'DB-45P'],
            [331,1500000,'DB-46'],
            //[,1500000,'DB-46P'],
            [332,1033700,'DB-47'],
            //[,1137720,'DB-47P'],
        ];
        //$cnt = 0;
        foreach ($item_arr as $row){
            $items = Item::find()->where(['id' => $row[0]])->one();
            $details = Details::find()->where(['item_id' => $row[0]])->one();

            $newprice = (number_format((($row[1]/90)*100)/100,0,',',''))*100;
            //$newprice = (number_format(($row[1])/100,0,',',''))*100;
            
            $items->position = $newprice;
            $items->save();

            $details->original_price = $newprice;
            $details->save();

        }
    }
    public static function getTag($alias)
    {
        $tags = Tags::findAll([
            'alias_category' => $alias,
            'sitemap' => 1,
        ]);
        if($tags){
            foreach ($tags as $row)
            {
                if($row->type == 'size'){
                    $size[] = $row;
                }elseif ($row->type == 'square'){
                    $square[] = $row;
                }elseif ($row->type == 'features'){
                    $features[] = $row;
                }elseif ($row->type == 'price'){
                    $price[] = $row;
                }elseif ($row->type == 'floor'){
                    $floor[] = $row;
                }elseif ($row->type == 'type'){
                    $type[] = $row;
                }else{
                    continue;
                }
            }
            return [
                'size' => $size,
                'square' => $square,
                'features' => $features,
                'price' => $price,
                'floor' => $floor,
                'type' => $type,
            ];
        }
        return false;

    }
    public static function getBlack($ip,$person,$phone,$email,$text)
    {
        $black = Ips::findOne(['host' => $ip]);
        if($black){
            if($black->black > 2){
                $black->updateCounters(['black' => 1]);
                return false;
            }else if($black->black <= 2 && $black->black != 0){
                $black->updateCounters(['black' => 1]);
                return true;
            }else if($black->black == 0){
                return true;
            }
        }else{
            $model = new Ips();
            $model->host = $ip;
            $model->person = HtmlPurifier::process($person);
            $model->phone = HtmlPurifier::process($phone);
            $model->email = HtmlPurifier::process($email);
            $model->description = HtmlPurifier::process($text);
            $model->black = 1;
            $model->save();
            return true;
        }
    }

}