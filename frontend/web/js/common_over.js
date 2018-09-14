
function HomeSlider(box) {
    this.box = document.querySelector(box);
}
HomeSlider.prototype.item = function () {
    if(this.box){
        this.items = this.box.querySelectorAll('.item');
    }
};
HomeSlider.prototype.load = function () {
    this.item();
    if(this.items){
        this.items[0].onload = this.item_active();
    }
};
HomeSlider.prototype.item_active = function () {
    for (var i = 0,len = this.items.length; i<len; i++){
        this.items[i].classList.remove('item-vis');
    }
    this.items[0].classList.add('active');
};

function ToTop(id) {
    this.link = document.querySelector(id);
}
ToTop.prototype.to_up = function () {
    var timer_id = setTimeout(function tick() {
        var top = Math.max(document.body.scrollTop,document.documentElement.scrollTop);
        if(top > 0) {
            window.scrollBy(0,-80);
            timer_id = setTimeout(tick, 20);
        }else{
            clearTimeout(timer_id);
        }
    }, 20);
};
ToTop.prototype.click = function () {
    var self = this;
    this.link.addEventListener('click', this.to_up);
    this.link.addEventListener('click',function (event) {
        event.preventDefault();
    });
    window.addEventListener('scroll',this.scroll.bind(this));
    var is_scrolling = false;
    function th_scroll(e) {
        if (is_scrolling == false ) {
            window.requestAnimationFrame(function() {
                self.scroll(e);
                is_scrolling = false;
            });
        }
        is_scrolling = true;
    }

    //window.addEventListener('scroll',th_scroll, false);
};
ToTop.prototype.scroll = function () {
    var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    var my_height = document.documentElement.clientHeight;
    if(scrollTop > (my_height)){
        this.link.classList.add('fixed');
    }else {
        this.link.classList.remove('fixed');
    }
    //this.click();
};

function OpenLink(data,target) {
    this.links = document.querySelectorAll('['+data+']');
    this.mouse_click = function (elem) {
        window.open(elem.getAttribute(data),target);
    };
    this.add_events = function (elem) {
        var self = this;
        if(elem.length != 0){
            for (var i = 0, len = elem.length; i < len; i++) {
                elem[i].addEventListener('click',function(e) {
                    return function(){self.mouse_click(e)};
                }(elem[i]),false);
            }
        }
    };
    this.go = function () {
        this.add_events(this.links);
    }
}

function OwlCarousel (box) {
    this.selector = 'data-owl-carousel';
    this.box = box;
    this.products = [];
    this.carousel_box = [];
    this.carousel_stage = [];
    this.owl_items = [];
    this.translation = 0;
    this.point = 0;
    this.my_width =0;
    this.carousel_stage_size = 0;
    this.margin = 20;
}
OwlCarousel.prototype.product = function () {
    if(this.box){
        this.list = this.box.getAttribute(this.selector);
        this.products = this.box.querySelectorAll('.'+this.list+'');
        if(this.box.hasAttribute('data-responsive')){
            this.responsive = this.box.getAttribute('data-responsive');
            this.responsive = this.responsive.split('-');
        }
        this.show();
    }
};
OwlCarousel.prototype.paint = function () {
    if(!this.carousel_box.length){

        this.carousel_box = document.createElement('div');
        this.carousel_box.classList.add('owl-stage-outer');
        this.box.appendChild(this.carousel_box);

        this.carousel_stage = document.createElement('div');
        this.carousel_stage.classList.add('owl-stage');
        this.carousel_box.appendChild(this.carousel_stage);

        this.controls_box = document.createElement('div');
        this.controls_box.classList.add('owl-controls');
        this.box.appendChild(this.controls_box);

        this.nav_box = document.createElement('div');
        this.nav_box.classList.add('owl-nav');
        this.controls_box.appendChild(this.nav_box);

        this.prev_box = document.createElement('div');
        this.prev_box.classList.add('owl-prev');
        this.nav_box.appendChild(this.prev_box);

        this.prev_box_i = document.createElement('i');
        this.prev_box_i.classList.add('fa','fa-angle-left');
        this.prev_box.appendChild(this.prev_box_i);

        this.next_box = document.createElement('div');
        this.next_box.classList.add('owl-next');
        this.nav_box.appendChild(this.next_box);

        this.next_box_i = document.createElement('i');
        this.next_box_i.classList.add('fa','fa-angle-right');
        this.next_box.appendChild(this.next_box_i);

        for (var i = 0,len = this.products.length; i<len; i++){
            this.owl_items[i] = document.createElement('div');
            this.owl_items[i].classList.add('owl-item');
            this.owl_items[i].appendChild(this.products[i]);
            this.carousel_stage.appendChild(this.owl_items[i]);

        }
        this.size();
        this.add_events();
    }
};
OwlCarousel.prototype.carousel_size = function () {
    this.carousel_stage_size = this.carousel_stage.getBoundingClientRect().left;
};
OwlCarousel.prototype.size = function () {
    this.translation = 0;
    this.shift_left = 0;
    this.my_width = document.documentElement.clientWidth;
    var my_height = document.documentElement.clientHeight;
    this.carousel_size();
    this.cnt = 4;
    if(this.my_width >= 1200){
        this.cnt = parseInt(this.responsive[0]);
    }else if(this.my_width < 1200 && this.my_width > 769){
        this.cnt = parseInt(this.responsive[1]);
    }else if(this.my_width <= 769 && this.my_width > 425){
        this.cnt = parseInt(this.responsive[2]);
    }else {
        this.cnt = parseInt(this.responsive[3]);
    }
    var style = getComputedStyle(this.carousel_box);
    var width = parseInt(style.width);
    this.item = ((width+this.margin)/this.cnt);
    var items_width = ((width+this.margin)/this.cnt)-this.margin;
    if(this.owl_items.length > 0){
        for (var i = 0,len = this.products.length; i<len; i++){
            this.owl_items[i].style.width = items_width + 'px';
            this.owl_items[i].style.marginRight = this.margin + 'px';
            this.owl_items[i].classList.remove('active');

        }
        for (var i = this.translation; i<this.cnt+this.translation; i++){
            this.owl_items[i].classList.add('active');
        }
    }
    this.add_class(this.item);
};
OwlCarousel.prototype.add_class = function (box) {
    this.carousel_stage.style.width = box*this.owl_items.length + 'px';
    this.carousel_stage.style.transform = 'translate3d('+(-box*this.translation)+'px, 0px, 0px)';
    this.carousel_stage.style.transition = '0.25s';
};
OwlCarousel.prototype.add_events = function () {
    var prev = this.box.querySelector('.owl-prev');
    var next = this.box.querySelector('.owl-next');

    prev.addEventListener('click',this.carousel.bind(this,'prev'));
    next.addEventListener('click',this.carousel.bind(this,'next'));
    window.addEventListener('resize',current_size);
    var self = this;
    function current_size () {
        self.size();
    }
    function drag_on(e) {
        //e.preventDefault();
        e.stopPropagation();
        self.drag(e);
    }
    this.carousel_stage.addEventListener('mousedown',drag_on,false);
    this.carousel_stage.addEventListener('touchstart',drag_on,false);
};
OwlCarousel.prototype.carousel =function (elem) {
    if(elem == 'prev'){
        if(this.translation != 0){
            this.translation = this.translation - 1;
        }else{
            console.log('%c Error #1-Start ','background-color: #49137e; color: #fff;');
        }
    }else if(elem == 'next'){
        if(this.translation < (this.owl_items.length - this.cnt)){
            this.translation = this.translation + 1;
            if(this.translation == (this.owl_items.length - this.cnt)){
                console.log('%c Error #1-End ','background-color: #49137e; color: #fff;');
            }
        }else{
            console.log('%c Error #1-End ','background-color: #49137e; color: #fff;');
        }
    }
    this.add_class(this.item);
};
OwlCarousel.prototype.show = function () {
    this.box.classList.add('owl-loaded');
    for (var i = 0,len = this.products.length; i<len; i++){
        this.products[i].parentNode.removeChild(this.products[i]);
    }
    this.paint();

};
OwlCarousel.prototype.drag = function (e) {
    this.carousel_stage.ondragstart = function() {
        return false;
    };
    var self = this;
    this.carousel_stage.addEventListener('mousemove',move_box,false);
    this.carousel_stage.addEventListener('touchmove',move_box,false);
    document.addEventListener('mouseup',move_box_end,false);
    document.addEventListener('touchend',move_box_end,false);
    var x_start;
    e.type === 'mousedown' ? x_start = e.pageX : x_start = e.touches[0].pageX;
    var box_start = self.carousel_stage.getBoundingClientRect();
    var left_start = box_start.left - this.carousel_box.getBoundingClientRect().left;
    var left_move,right_move,x;
    function move_box(e) {
        //e.preventDefault();
        e.stopPropagation();
        var box_move = self.carousel_stage.getBoundingClientRect();
        left_move = box_move.left - self.carousel_box.getBoundingClientRect().left;
        right_move = box_move.right- self.margin;
        e.type === 'mousemove' ? x = e.pageX-x_start : x = e.touches[0].pageX-x_start;
        var coof = 1.2;
        if(left_move >= 0 && x > 0){
            self.carousel_stage.style.transform = 'translate3d(0px, 0px, 0px)';
            self.carousel_stage.style.transition = '0.25s';
        }else if(right_move == self.carousel_box.getBoundingClientRect().right && x < 0){
            self.carousel_stage.style.transform = 'translate3d('+(left_move)+'px, 0px, 0px)';
            self.carousel_stage.style.transition = '0.25s';
        }else{
            self.carousel_stage.style.transform = 'translate3d('+(left_start + x/coof)+'px, 0px, 0px)';
            self.carousel_stage.style.transition = '0.0s';
        }
    }
    function move_box_end(e) {
        //e.preventDefault();
        e.stopPropagation();
        var cnt = Math.abs(left_move/self.item);
        if(x < 0){
            if(cnt > (self.owl_items.length - self.cnt)){
                self.translation = (self.owl_items.length - self.cnt);
            }else {
                self.translation = Math.ceil(cnt);
            }
            //self.carousel('next');
        }else {
            if(left_move>= 0){
                self.translation = 0;
            }else {
                self.translation = Math.floor(cnt);
            }
            //self.carousel('prev');
        }
        self.carousel_stage.removeEventListener('mousemove',move_box);
        self.carousel_stage.removeEventListener('touchmove',move_box);
        document.removeEventListener('mouseup',move_box_end);
        document.removeEventListener('touchend',move_box_end);
        self.add_class(self.item);
    }
};

function MyCookie(name, value, options) {
    this.name = name;
    this.value = value;
    this.options = options;
}
MyCookie.prototype.get_cookie = function () {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + this.name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
};
MyCookie.prototype.set_cookie = function () {
    this.options = this.options || {};
    var expires = this.options.expires;
    if (typeof expires == "number" && expires) {
        var d = new Date();
        d.setDate(d.getDate() + expires);
        expires = this.options.expires = d;
    }
    if (expires && expires.toUTCString) {
        this.options.expires = expires.toUTCString();
    }
    this.value = encodeURIComponent(this.value);
    var updatedCookie = this.name + "=" + this.value;
    for (var propName in this.options) {
        updatedCookie += "; " + propName;
        var propValue = this.options[propName];
        if (propValue !== true) {
            updatedCookie += "=" + propValue;
        }
    }
    document.cookie = updatedCookie;
};

function HotPrice(selector) {
    this.selector = selector;
    this.hot_box = [];
    this.name_cookie = 'htprc';
    this.value = 1;
    this.time = 30000;
    this.day = 7;
}
HotPrice.prototype.hot_block = function () {
    this.hot_box = document.querySelector(this.selector);
};
HotPrice.prototype.add_events = function () {
    var span = this.hot_box.querySelector('.close-hot');
    var a = this.hot_box.querySelectorAll('a');
    span.addEventListener('click',this.add_class.bind(this));
    for (var i =0, len = a.length; i < len; i++){
        a[i].addEventListener('click',this.add_class.bind(this));
    }

};
HotPrice.prototype.add_class = function () {
    this.hot_box.classList.remove('right','active');
    this.hot_box.classList.add('left');
    this.cookie.set_cookie();
};
HotPrice.prototype.start = function () {
    this.cookie = new MyCookie(this.name_cookie,this.value,{expires:this.day,path:'/'});
    this.hot_block();
    var self = this;
    if(this.cookie.get_cookie() == 1){
        this.hot_box.parentNode.removeChild(this.hot_box);
    }else{

        if(this.hot_box){
            this.hot_box.classList.add('right');
            this.add_events();
            setTimeout(function(){
                self.hot_box.classList.add('active');
            },self.time);
        }
    }
};

function Footer(){
    this.footer = [];
    this.inwidget = [];

}
Footer.prototype.start = function () {
    this.footer = document.querySelector('#footer');
    this.inwidget = this.footer.querySelector('.inwidget');
    this.my_scroll();
};
Footer.prototype.inwidget_add = function () {
    if(!this.visibility){
        var widget = document.createElement('iframe');
        widget.setAttribute('scrolling','no');
        widget.setAttribute('frameborder','no');
        widget.setAttribute('style','border:none;width:260px;height:330px;overflow:hidden;');
        widget.setAttribute('src','/inwidget/index.php');
        this.inwidget.appendChild(widget);
    }
};
Footer.prototype.vk = function () {
    if(!this.visibility){
        var self = this;
        this.body = document.body;
        var script_vk_1 = document.createElement('script');
        script_vk_1.setAttribute('src','//vk.com/js/api/openapi.js?146');
        var script_vk_2 = document.createElement('script');
        script_vk_2.setAttribute('src','/js/vk.js');
        this.body.appendChild(script_vk_1);
        script_vk_1.onload = function () {
            self.body.appendChild(script_vk_2);
        };
        self.visibility = true;
    }
};
Footer.prototype.my_scroll = function () {
    var top = this.footer.getBoundingClientRect().top - document.documentElement.clientHeight;
    var self = this;
    self.visibility = false;
    function add_scroll() {
        if (window.pageYOffset >= top && !self.visibility) {
            self.inwidget_add();
            self.vk();
        }else if(self.visibility){
            remove_scroll();
        }
    }
    var is_scrolling = false;
    function throt_scroll(e) {
        if (is_scrolling == false ) {
            window.requestAnimationFrame(function() {
                add_scroll(e);
                is_scrolling = false;
            });
        }
        is_scrolling = true;
    }
    window.addEventListener('scroll',throt_scroll, false);
    function remove_scroll() {
        window.removeEventListener('scroll',add_scroll);
    }
};

function Favorite() {
    this.favorite_selector = 'data-favorite';
    this.name_cookie = 'srbstrfvrt';
    //this.value = '';
    this.day = 30;
    this.cookie = new MyCookie(this.name_cookie,this.value,{expires:this.day,path:'/'});
    this.items = [];
}
Favorite.prototype.set_value = function () {
    this.value = JSON.stringify(this.items);
};
Favorite.prototype.get_value = function () {
    return this.items = JSON.parse(this.value);
};
Favorite.prototype.get_cookie = function () {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + this.name_cookie.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    this.value = matches ? decodeURIComponent(matches[1]) : undefined;
};
Favorite.prototype.paint_items = function () {
    if(this.value){
        this.get_value();
        var cnt = this.items.length;
        for (var i = 0,len = this.items.length; i < len; i++){
            var item = document.querySelector('['+this.favorite_selector+'="'+this.items[i]+'"]');
            if(item){
                if(item.tagName.toLowerCase() == 'a'){
                    item.innerHTML = '<i class="fa fa-heart" aria-hidden="true"></i>В избранном';
                }else{
                    item.innerHTML = '<i class="fa fa-heart" aria-hidden="true"></i>';
                }

            }

        }
        this.favorite_box();
    }
};
Favorite.prototype.set_cookie = function () {
    this.cookie = new MyCookie(this.name_cookie,this.value,{expires:this.day,path:'/'});
    this.cookie.set_cookie();


};
Favorite.prototype.add_events = function () {
    this.favorite_items = document.querySelectorAll('['+this.favorite_selector+']');
    var self = this;
    function set_favorite(e) {
        e.preventDefault();
        e.stopPropagation();
        var target = e.target;
        while (target != self) {
            if (target.tagName == 'SPAN' || target.tagName == 'A') {
                // нашли элемент, который нас интересует!
                self.check_favorite(target);
                return;
            }
            target = target.parentNode;
        }
        yaCounter44431060.reachGoal('favorite');
        self.check_favorite(target);
    }
    for (var i = 0, len = this.favorite_items.length; i < len; i++){
        this.favorite_items[i].addEventListener('click',set_favorite,false);
        //this.favorite_items[i].addEventListener('click',this.check_favorite.bind(this,this.favorite_items[i]));
        //this.favorite_items[i].addEventListener('click',yaCounter44431060.reachGoal('favorite'));
    }
    this.paint_items();

};
Favorite.prototype.check_favorite = function (e) {
    var id = e.getAttribute(this.favorite_selector);
    if(this.items.indexOf(id) == -1){
        this.items = this.items.concat(id);
        if(e.tagName.toLowerCase() == 'a'){
            e.innerHTML = '<i class="fa fa-heart" aria-hidden="true"></i>В избранном';
        }else{
            e.innerHTML = '<i class="fa fa-heart" aria-hidden="true"></i>';
        }
        //e.innerHTML = '<i class="fa fa-heart" aria-hidden="true"></i>';
    }else{
        this.items.splice(this.items.indexOf(id),1);
        if(e.tagName.toLowerCase() == 'a'){
            e.innerHTML = '<i class="fa fa-heart-o" aria-hidden="true"></i>Добавить в избранное';
        }else{
            e.innerHTML = '<i class="fa fa-heart-o" aria-hidden="true"></i>';
        }
        //e.innerHTML = '<i class="fa fa-heart-o" aria-hidden="true"></i>';
    }
    var url = window.location.href;
    if(url.indexOf('favorite') != -1){
        location.reload()
    }

    this.set_value();
    this.set_cookie();
    this.favorite_box();

};
Favorite.prototype.favorite_box = function () {
    var cnt = this.items.length;
    var box = document.querySelectorAll('[data-favorite-box]');
    if(cnt > 0){
        for (var i = 0,len = box.length; i < len; i++){
            box[i].querySelector('span').innerHTML = cnt;
        }
    }else {
        for (var i = 0,len = box.length; i < len; i++){
            box[i].querySelector('span').innerHTML = '';
        }
    }
};

function GetAnimation() {
    this.boxes = [];
}
GetAnimation.prototype.get_box = function () {
    this.boxes = document.querySelectorAll('[data-box-animation]');
    if(this.boxes.length > 0){
        window.addEventListener("scroll", this.scroll.bind(this), false);
        for(var i = 0, len = this.boxes.length; i < len; i++){
            this.boxes[i].classList.add(this.boxes[i].getAttribute('data-box-animation'))
        }
    }
};
GetAnimation.prototype.check_vis = function (el) {
    if(!el.classList.contains('active')){
        var parentNode = el.parentNode;
        var size = parentNode.getBoundingClientRect();
        var top = size.top;
        var bottom = size.bottom;
        var height = size.height;
        return ((top + height >= 0) && (height + window.innerHeight >= bottom));
    }

};
GetAnimation.prototype.scroll = function () {
    for(var i = 0, len = this.boxes.length; i < len; i++){
        if(this.check_vis(this.boxes[i])){
            this.boxes[i].classList.add('active');
        }
    }
};

function common() {
    var getAnimation = new GetAnimation();
    getAnimation.get_box();

    var favorite = new Favorite();
    favorite.get_cookie();
    favorite.add_events();

    var footer = new  Footer();
    footer.start();


    var hot_price = new HotPrice('#hot-price');
    hot_price.start();

    var srbstr = new MyCookie('srbstr',1,{path:'/'});
    if(srbstr.get_cookie() == 1){}else {srbstr.set_cookie();}

    var link = new OpenLink('data-link-sort','_self');
    link.go();

    var link_head = new OpenLink('data-link','_blank');
    link_head.go();

    var owl_carousel_box = document.querySelectorAll('[data-owl-carousel]');
    if(owl_carousel_box.length > 0){
        var owlCar ={};
        function OwlCar(selector_block) {
            OwlCarousel.apply(this, arguments);
        }
        OwlCar.prototype = Object.create(OwlCarousel.prototype);
        OwlCar.prototype.constructor = OwlCar;
        for (var j = 0, len_car = owl_carousel_box.length; j < len_car; j++){
            owlCar['owlCar' + j] = new OwlCarousel(owl_carousel_box[j]);
            owlCar['owlCar' + j].product();
        }
    }

    var slider = new HomeSlider('#carousel');
    slider.load();

    var scroll;
    function Scroll() {
        ToTop.apply(this,arguments);
    }
    Scroll.prototype = Object.create(ToTop.prototype);
    Scroll.prototype.constructor = Scroll;
    scroll = new ToTop('#scroll-top');
    scroll.click();
}
window.onload = common();
(function() {
    // helpers
    var regExp = function(name) {
        return new RegExp('(^| )'+ name +'( |$)');
    };
    var forEach = function(list, fn, scope) {
        for (var i = 0; i < list.length; i++) {
            fn.call(scope, list[i]);
        }
    };

    // class list object with basic methods
    function ClassList(element) {
        this.element = element;
    }

    ClassList.prototype = {
        add: function() {
            forEach(arguments, function(name) {
                if (!this.contains(name)) {
                    this.element.className += ' '+ name;
                }
            }, this);
        },
        remove: function() {
            forEach(arguments, function(name) {
                this.element.className =
                    this.element.className.replace(regExp(name), '');
            }, this);
        },
        toggle: function(name) {
            return this.contains(name)
                ? (this.remove(name), false) : (this.add(name), true);
        },
        contains: function(name) {
            return regExp(name).test(this.element.className);
        },
        // bonus..
        replace: function(oldName, newName) {
            this.remove(oldName), this.add(newName);
        }
    };

    // IE8/9, Safari
    if (!('classList' in Element.prototype)) {
        Object.defineProperty(Element.prototype, 'classList', {
            get: function() {
                return new ClassList(this);
            }
        });
    }

    // replace() support for others
    if (window.DOMTokenList && DOMTokenList.prototype.replace == null) {
        DOMTokenList.prototype.replace = ClassList.prototype.replace;
    }
})();