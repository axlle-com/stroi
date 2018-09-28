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
    public function sendMail($subject,$text,$emailFrom='mail@srub-stroi.ru',$nameFrom='ООО "Сруб-Строй"'){
        if(\Yii::$app->mail->compose()
            ->setFrom(['www@srub-stroi.ru' => 'Сообщение с сайта'])
            ->setTo([$emailFrom => $nameFrom])
            ->setSubject($subject)
            ->setHtmlBody($text)
            ->send()){
            return true;
        }
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
    public static function getNews($data,$sort = 1)
    {
        if($sort == 1){
            $items = Item::find()->where(['in', 'category_id', $data]) ->andWhere(['sitemap' => 1])->limit(7)->orderBy(['date_pub'=>SORT_DESC])->all();
        }else{
            $items = Item::find()->where(['in', 'category_id', $data]) ->andWhere(['sitemap' => 1])->limit(7)->orderBy(['hits'=>SORT_DESC])->all();
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
                <li><a href="/">Главная</a></li><li><a href="/'.$alias_category.'.htm">'.$category->title_short.'</a></li>'
                .'<li>'.$item->title.'</li></ol></div></div></div></div>';
        }elseif ($tags && $category){
            $cat_title = $category->title_short;
            return '<div class="page-header custom larger"><div class="container"><div class="row"><div class="col-md-6">
                <p>'.$cat_title.'</p></div><div class="col-md-6"><ol class="breadcrumb">
                <li><a href="/">Главная</a></li><li><a href="/'.$alias_category.'.htm">'.$category->title_short.'</a></li>'
            .'<li>'.$tags->title_short.'</li></ol></div></div></div></div>';
        }elseif (!$item && $category)
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
            <li><a href="/">Главная</a></li><li>'.$category->title_short.'</li></ol></div>
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
            [298,1275640],[301,1249960],[306,1016900],[305,1257900],[307,917540],
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