function ImageBox(selector_block) {
    this.search_box = selector_block;//коллекция всех элементов где есть картинки
    this.image_big_selector = '.product-top';//.product-top || #box_lightbox
    this.selector_lightbox = 0;// 1 || 0
    this.data_tumb = 'data-tumb';//атрибут маленьких изображений по которому ищем их
    this.data_big = 'data-big';//атрибут изображений в главном окне по которому ищем их
    this.images_tumb = [];//коллекция всех маленьких картинок
    this.image_big = [];//коллекция всех div больших картинок на странице товара
    this.image = [];
    this.slide_selector = []; //коллекция всех элементов управления слайдера
    this.lightbox_selector = []; //коллекция всех элементов управления лайтбокса
    this.box_image = []; // бокс где находится главная картинка на странице товара .product-top
    this.box_overlay = [];// бокс где находится главная картинка на странице лайтбокса
    this.time = 500;
}
ImageBox.prototype.start = function () {
    this.box_image = this.search_box.querySelector(''+this.image_big_selector+'');//.product-top
    if(this.box_image){
        this.selector_lightbox = 1;
    }
    this.box_overlay = this.search_box.querySelector('.box_overlay');
    this.tumb_collection();
    this.image_box_fil();
    this.block_height();
    this.links_collection();
};
ImageBox.prototype.image_big_fill =function () {
    if(this.selector_lightbox) {
        this.image_big = this.box_image.querySelectorAll('[' + this.data_big + ']');
    }
};
ImageBox.prototype.image_box_fil = function (e) {
    this.image_big_fill();
    if(this.selector_lightbox){
        for (var i = 0, len = this.image_big.length; i < len; i++){
            this.image_big[i].setAttribute(this.data_big,i);
            this.image[i] = this.image_big[i].querySelector('img');
            if(this.image[i].getAttribute('src') != this.images_tumb[i].getAttribute(this.data_tumb)){
                this.image[i].setAttribute('src',this.images_tumb[i].getAttribute(this.data_tumb));
            }
        }
    }else {
        console.log('%c Error #1-no product ','background-color: #49137e; color: #fff;');
    }
};
ImageBox.prototype.tumb_collection = function () {
    return this.images_tumb = this.search_box.querySelectorAll('['+this.data_tumb+']');
};
ImageBox.prototype.slide_selector_collection = function () {
    if(this.box_image){
        this.slide_selector = this.box_image.querySelectorAll('[data-box-slide]');
    }
};
ImageBox.prototype.block_height = function () {
    if(this.box_image){
        var style = getComputedStyle(this.box_image);
        var width = parseInt(style.width);
        width = Math.round(width/1.5 * 100) / 100;
        this.box_image.style.height = width+'px';
        var tumb_style = getComputedStyle(this.images_tumb[0]);
        var tumb_width = parseInt(tumb_style.width);
        tumb_width = Math.round(tumb_width/1.5 * 100) / 100;
        for(i = 0, len = this.images_tumb.length; i < len; i++){
            this.images_tumb[i].style.height = tumb_width+'px';
        }
    }
};
ImageBox.prototype.links_collection = function (elem) {
    this.slide_selector_collection();

    var self = this;
    var click = false;
    function show_slider() {
        if(!click){
            click = true;
            self.show_slider(self,this);
            setTimeout(function(){click = false},self.time);
        }
    }
    function show_big_image() {
        if(!click){
            click = true;
            var j;
            for (var i = 0, len = self.images_tumb.length; i < len; i++){
                if(self.images_tumb[i] == this){j = i}
            }
            if(self.box_image){
                self.show_big_image(self,self.box_image,this,j);
            }
            if(self.box_overlay){
                self.show_big_image(self,self.box_overlay,this,j);
            }
            setTimeout(function(){click = false},self.time);
        }
    }
    if(this.selector_lightbox){
        for (var i = 0,len = this.images_tumb.length; i<len; i++){
            this.images_tumb[i].addEventListener('click',show_big_image);
        }
    }else {
        for (var i = 0,len = this.images_tumb.length; i<len; i++){
            this.images_tumb[i].addEventListener('click',function (event) {
                event.preventDefault();
            });
            this.images_tumb[i].addEventListener('click',show_big_image);
            this.images_tumb[i].addEventListener('click',this.show_overlay.bind(this,i));//
        }
    }

    for (var j = 0,len_slide = this.slide_selector.length; j<len_slide; j++){
        this.slide_selector[j].addEventListener('click',show_slider);//(this,this.box_image,this.slide_selector[j])
    }
    if(this.images_tumb[0]){
        this.images_tumb[0].classList.add('tumb-active');
    }
    window.addEventListener('resize',this.block_height.bind(this));
};
// не используется
ImageBox.prototype.show_box_image = function (elem,n) {
    this.image_big = this.search_box.querySelectorAll('['+this.data_big+']');
    this.image_big[0].setAttribute('src',elem.getAttribute(this.data_tumb));
    this.image_big[0].setAttribute(''+this.data_big+'',n);
    for (var i = 0,len = this.images_tumb.length; i<len; i++){
        if(this.images_tumb[i] == elem){
            continue;
        }
        this.images_tumb[i].classList.remove('tumb-active');
    }
    elem.classList.add('tumb-active');
};
// не используется
ImageBox.prototype.show_slider = function (e,elem) {
    this.image_big_fill();
    var selector ='';
    if(elem.hasAttribute('data-box-slide')){
        selector = elem.getAttribute('data-box-slide');
    }else if (elem.hasAttribute('data-lightbox-slide')){
        selector = elem.getAttribute('data-lightbox-slide');
    }
    var img;
    if(this.selector_lightbox){
        img = this.box_image.querySelector('.image-active');
    }else {
        img = this.box_overlay.querySelector('.image-active');
    }
    var i = img.getAttribute(''+this.data_big+'');
    if(selector == 'prev'){
        if(i == 0){
            i = this.images_tumb.length - 1;
        }else {
            i--;
        }
        if(this.selector_lightbox){
            this.show_big_image(this,this.box_image,this.images_tumb[i],i,selector);
        }
        if(this.box_overlay){
            this.show_big_image(this,this.box_overlay,this.images_tumb[i],i,selector);
        }else{
            console.log('%c Error #4.0-not box-overlay ','background-color: #49137e; color: #fff;');
        }
    }else if(selector == 'next'){
        if(i == this.images_tumb.length - 1){
            i = 0;
        }else {
            i++;
        }
        if(this.selector_lightbox){
            this.show_big_image(this,this.box_image,this.images_tumb[i],i,selector);
        }
        if(this.box_overlay){
            this.show_big_image(this,this.box_overlay,this.images_tumb[i],i,selector);
        }else{
            console.log('%c Error #4.1-not box-overlay ','background-color: #49137e; color: #fff;');
        }
    }else if(selector == 'loupe'){
        this.show_overlay(i);

    }else  if(selector == 'close'){
        this.close_overlay();
    }else{
        console.log('%c  Если вы увидели ошибку напишите,пожалуйста, на E-mail: axlle@mail.ru ! ','background-color: #49137e; color: #fff;');
    }
};
ImageBox.prototype.show_big_image = function (e,box,elem,n,selector) {
    if(box){
        //console.log(elem,n);
        var div_img = box.querySelector('['+this.data_big+'="'+n+'"]');
        var div_active = box.querySelector('.image-active');  //текущая активная картинка в окне
        if(!div_img){
            var div_clone = document.createElement('div');
            //console.log(elem);
            div_clone.setAttribute(this.data_big,n);
            div_clone.classList.add('box-image');

            var image = document.createElement('img');
            image.setAttribute('src',elem.getAttribute(this.data_tumb));
            image.classList.add('img-responsive');
            div_clone.appendChild(image);
            //div_clone.classList.add('image-active');
            //console.log(div_clone);
            for(var cnt = 0,box_len = this.images_tumb.length; cnt<box_len ; cnt++){
                var img_base = box.querySelector('['+this.data_big+'="'+(n-cnt)+'"]');
                var img_base_1 = box.querySelector('['+this.data_big+'="'+(n+cnt)+'"]');
                if(img_base){
                    //div_active.classList.toggle('image-active');
                    img_base.parentNode.insertBefore(div_clone, img_base.nextSibling);
                    //div_clone.classList.toggle('image-active');
                    this.add_class(div_active,div_clone,selector);
                    break;
                }else if(img_base_1){
                    //div_active.classList.toggle('image-active');
                    img_base_1.parentNode.insertBefore(div_clone,img_base_1);
                    //div_clone.classList.toggle('image-active');
                    this.add_class(div_active,div_clone,selector);
                    break;
                }else {
                    continue;
                }
            }
        }else{
            //div_active.classList.toggle('image-active');
            //img.classList.toggle('image-active');
            this.add_class(div_active,div_img,selector);
        }
        for (var i = 0,len = this.images_tumb.length; i<len; i++){
            if(this.images_tumb[i] == elem){
                continue;
            }
            this.images_tumb[i].classList.remove('tumb-active');
        }
        elem.classList.add('tumb-active');
    }else {
        console.log('%c Error #5 ','background-color: #49137e; color: #fff;');
    }
};
ImageBox.prototype.add_class = function (div_active,div_img,selector) {
    var current_data = Number(div_active.getAttribute(this.data_big));
    var next_data = Number(div_img.getAttribute(this.data_big));
    var self = this;
    if(selector){
        if(selector == 'next'){
            div_img.classList.add('next');
            setTimeout(function () {
                div_active.classList.add('left');
                div_img.classList.add('left');
            },4);
            setTimeout(function () {
                div_active.className = 'box-image';
                div_img.className = 'box-image image-active';
                //div_active.classList.remove('left','image-active');
                //div_img.classList.add('image-active');
                //div_img.classList.remove('next','left');
            },self.time);
        }else if(selector == 'prev'){
            div_img.classList.add('prev');
            setTimeout(function () {
                div_active.classList.add('right');
                div_img.classList.add('right');
            },4);
            setTimeout(function () {
                div_active.className = 'box-image';
                div_img.className = 'box-image image-active';
                //div_active.classList.remove('right','image-active');
                //div_img.classList.add('image-active');
                //div_img.classList.remove('prev','right');
            },self.time);
        }

    }else{
        if(current_data < next_data){//next
            div_img.classList.add('next');
            setTimeout(function () {
                div_active.classList.add('left');
                div_img.classList.add('left');
            },4);
            setTimeout(function () {
                div_active.className = 'box-image';
                div_img.className = 'box-image image-active';
                //div_active.classList.remove('left','image-active');
                //div_img.classList.add('image-active');
                //div_img.classList.remove('next','left');
            },self.time);
        }else if(current_data > next_data){//prev
            div_img.classList.add('prev');
            setTimeout(function () {
                div_active.classList.add('right');
                div_img.classList.add('right');
            },4);
            setTimeout(function () {
                div_active.className = 'box-image';
                div_img.className = 'box-image image-active';
                //div_active.classList.remove('right','image-active');
                //div_img.classList.add('image-active');
                //div_img.classList.remove('prev','right');
            },self.time);
        }
    }
    //div_active.classList.toggle('image-active');
    //div_img.classList.toggle('image-active');
};
ImageBox.prototype.show_overlay = function (n) {
    //this.image_box_fil();
    if(!this.box_overlay){
        //var body = document.querySelector('body');
        this.box_overlay = document.createElement('div');
        this.box_overlay.setAttribute('class','box_overlay');
        //this.box_overlay.setAttribute('class','active');
        //this.box_overlay.style.display = 'block';
        //this.box_overlay.setAttribute('style','display:block');
        this.search_box.appendChild(this.box_overlay);

        var box_lightbox = document.createElement('div');
        box_lightbox.setAttribute('class','box_lightbox');
        this.box_overlay.appendChild(box_lightbox);

        var div_img = document.createElement('div');
        div_img.setAttribute('data-big',n);
        div_img.classList.add('box-image');
        div_img.classList.add('image-active');
        box_lightbox.appendChild(div_img);

        var img = document.createElement('img');
        img.setAttribute('class','img-responsive');
        img.setAttribute('src',this.images_tumb[n].getAttribute(this.data_tumb));

        div_img.appendChild(img);


        var span_box = document.createElement('div');
        span_box.setAttribute('class','span-box');
        box_lightbox.appendChild(span_box);

        var span_prev = document.createElement('span');
        span_prev.setAttribute('data-lightbox-slide','prev');
        span_prev.setAttribute('class','lightbox-prev');
        span_box.appendChild(span_prev);

        var i_prev = document.createElement('i');
        i_prev.setAttribute('class','fa fa-angle-left');
        i_prev.setAttribute('aria-hidden','true');
        span_prev.appendChild(i_prev);

        var span_next = document.createElement('span');
        span_next.setAttribute('data-lightbox-slide','next');
        span_next.setAttribute('class','lightbox-next');
        span_box.appendChild(span_next);

        var i_next = document.createElement('i');
        i_next.setAttribute('class','fa fa-angle-right');
        i_next.setAttribute('aria-hidden','true');
        span_next.appendChild(i_next);

        var span_close = document.createElement('span');
        span_close.setAttribute('data-lightbox-slide','close');
        span_close.setAttribute('class','lightbox-close');
        span_box.appendChild(span_close);

        var i_close = document.createElement('i');
        i_close.setAttribute('class','fa fa-times');
        i_close.setAttribute('aria-hidden','true');
        span_close.appendChild(i_close);

        var self = this;
        this.add_events();
        img.onload = this.lightbox_size.bind(this,this.box_overlay);

        setTimeout(function () {
            self.box_overlay.classList.add('active');
        },100);

    }else{
        this.box_overlay.classList.add('active');
        //this.box_overlay.style.display = 'block';
    }
    this.stop_scroll(1);
};
ImageBox.prototype.add_events = function () {
    this.lightbox_selector = this.box_overlay.querySelectorAll('[data-lightbox-slide]');
    var self = this;
    var click = false;
    function show_slider() {
        if(!click){
            click = true;
            self.show_slider(self,this);
            setTimeout(function(){click = false},self.time);
        }
    }
    for (var i = 0, len = this.lightbox_selector.length; i < len; i++){
        this.lightbox_selector[i].addEventListener('click',show_slider);
    }
    window.addEventListener('resize',this.lightbox_size.bind(this,this.box_overlay));
    this.box_overlay.addEventListener('click',function (event) {
        event = event || window.event;
        var target = event.target || event.srcElement;
        event.stopPropagation ? event.stopPropagation() : (event.cancelBubble=true);
        if (target == self.box_overlay){
            self.close_overlay();
        }
    });
};
ImageBox.prototype.stop_scroll = function (e) {
    if(e){
        document.onmousewheel=document.onwheel=function(){
            return false;
        };
        document.addEventListener("MozMousePixelScroll",function(){return false},false);
        document.onkeydown=function(e) {
            if (e.keyCode>=33&&e.keyCode<=40) return false;
        }
    }else{
        document.onmousewheel=document.onwheel=function(){
            return true;
        };
        document.addEventListener("MozMousePixelScroll",function(){return true},true);
        document.onkeydown=function(e) {
            if (e.keyCode>=33&&e.keyCode<=40) return true;
        }
    }
};
ImageBox.prototype.close_overlay = function (){

    this.box_overlay.classList.remove('active');
    this.stop_scroll(0);
};
ImageBox.prototype.lightbox_size = function (box) {
    var image = box.querySelector('img');
    //image = image.querySelector('img');
    var box_lightbox = box.querySelector('.box_lightbox');

    var my_width = document.documentElement.clientWidth;
    var my_height = document.documentElement.clientHeight;

    var image_nat_width = image.naturalWidth;
    var image_nat_height = image.naturalHeight;


    var my_monitor = my_width/my_height;
    if(my_monitor > 1.49 ){
        if(image_nat_height > my_height){
            box_lightbox.style.height = my_height-40+'px';
            box_lightbox.style.width = (my_height-40)*1.5+'px';
            box_lightbox.style.margin = 20+'px auto';
        }else {
            box_lightbox.style.height = image_nat_height-40+'px';
            box_lightbox.style.width = image_nat_width-40+'px';
            box_lightbox.style.margin = 20+'px auto';
        }
    }else{
        if(image_nat_width > my_width){
            box_lightbox.style.height = (my_width-40)/1.5+'px';
            box_lightbox.style.width = my_width-40+'px';
            box_lightbox.style.margin = 20+'px auto';
        }else {
            box_lightbox.style.height = image_nat_height-40+'px';
            box_lightbox.style.width = image_nat_width-40+'px';
            box_lightbox.style.margin = 20+'px auto';
        }
    }
};


function gallery_box() {
    var box = document.querySelectorAll('.popup-gallery');
    if(box.length > 0){
        var showBox = {};
        function ShowBox(selector_block) {
            ImageBox.apply(this, arguments);
        }
        ShowBox.prototype = Object.create(ImageBox.prototype);
        ShowBox.prototype.constructor = ShowBox;

        for (var i = 0, len = box.length; i < len; i++){
            showBox['showbox_' + i] = new ImageBox(box[i]);
            showBox['showbox_' + i].start();
        }
    }
}
window.onload = gallery_box();
