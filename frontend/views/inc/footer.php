<!-- footer -->
<footer id="footer" class="footer-inverse">
    <div id="footer-inner" class="no-padding-bt-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 main-widget">
                    <div class="widget">
                        <div class="corporate-widget">
                            <span class="footer-logo"><img src="/images/backgrounds/log_1.png" class="img-responsive img-logo" alt="Логотип"></span><!-- End .footer-logo -->
                            <p>Вся представленная на сайте информация носит информационный характер и ни при каких условиях не является публичной офертой, определяемой положениями Статьи 437(2) Гражданского кодекса РФ.</p>

                            <address>
                                <ul class="phone">
                                    <li><i class="fa fa-phone" aria-hidden="true"></i><span data-company-tel="1"> +7 (915) 91 000 55</span></li>
                                    <li><i class="fa fa-fax" aria-hidden="true"></i><span data-company-tel="2"> +7 (495) 997 10 78</span></li>
                                    <li><a href="mailto:info@srub-stroi.ru"><i class="fa fa-envelope" aria-hidden="true"></i><span data-company-mail="1">  info@srub-stroi.ru</span></a></li>
                                </ul>
                            </address>

                            <span class="social-icons-label">Присоединяйтесь:</span>
                            <div class="social-icons">
                                <span data-link="https://api.whatsapp.com/send?phone=79159100055" class="social-icon icon-whatsapp hidden-link" title="whatsapp">
                                    <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                </span>
                                <span data-link="https://vk.com/club142581712" class="social-icon icon-vk hidden-link" title="VK">
                                    <i class="fa fa-vk" aria-hidden="true"></i>
                                </span>
                                <span data-link="https://www.instagram.com/srub_stroi/" class="social-icon icon-instagram hidden-link" title="Instagram">
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                </span>
                                <span data-link="https://ok.ru/srubstroy" class="social-icon icon-ok hidden-link" title="Odnoklassniki">
                                    <i class="fa fa-odnoklassniki" aria-hidden="true"></i>
                                </span>
                                <span data-link="https://www.facebook.com/%D0%9E%D0%9E%D0%9E-%D0%A1%D1%80%D1%83%D0%B1-%D0%A1%D1%82%D1%80%D0%BE%D0%B9-2023617047869850" class="social-icon icon-facebook hidden-link" title="Facebook">
                                    <i class="fa fa-facebook"></i>
                                </span>
                                <span data-link="https://www.youtube.com/channel/UCFxN1jZRwXW5qmWOjxEiMtw" class="social-icon icon-youtube hidden-link" title="Youtube">
                                    <i class="fa fa-youtube" aria-hidden="true"></i>
                                </span>
                            </div><!-- End .social-icons -->
                        </div><!-- End corporate-widget -->
                    </div><!-- End .widget -->
                </div><!-- End .col-md-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h4>Мы ВКонтакте</h4>
                        <!-- VK Widget -->
                        <div id="vk_groups"></div>
                    </div><!-- End .widget -->
                </div><!-- End .col-md-3 -->

                <div class="clearfix visible-sm"></div><!-- End .clearfix -->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h4>Мы в Instagram</h4>
                        <div class="inwidget">
                            <!--<iframe>-->
                        </div><!-- End .widget -->
                    </div><!-- End -->
                </div><!-- End .col-md-3 -->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h4>популярное</h4>
                        <div class="rel-posts-list">
                            <ol>
                            <?php foreach(\common\components\Common::getNews([11,12,15],2,12) as $row):?>

                                <li><i class="fa fa-bookmark-o" aria-hidden="true"></i><a href="<?=\common\components\Common::createdLink($row)?>"><?=$row->title_short?></a></li>

                            <?php endforeach;?>
                            </ol>
                        </div><!-- End -->
                    </div><!-- End .widget -->
                </div><!-- End .col-md-3 -->

            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End #footer-inner -->
    <div id="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-push-6">
                    <ul class="footer-menu">
                        <li><a href="/otzyvy.htm">Отзывы</a></li>
                        <li><a href="/vopros-otvet.htm">Вопрос - Ответ</a></li>
                        <li><a href="/price/rabochaya-dokumentacziya.htm">Документы</a></li>
                        <li><a href="/kontakt.htm">Контакты</a></li>
                    </ul>
                </div><!-- End .col-md-6 -->
                <div class="col-md-6 col-md-pull-6">
                    <p class="copyright">ООО "Сруб-Строй" &copy;.  All rights reserved.  <a id="axlle" href="https://axlle.com" target="_blank">Создание и продвижение сайтов "axlle.com"</a></p>
                </div><!-- End .col-md-6 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End #footer-bottom -->
</footer><!-- End #footer -->
<!-- // footer-end -->
<!--  hot-price -->
<!--<div id="hot-price" class="hot-price">
    <div class="hot-price-block">
        <h2>Баня в подарок</h2>
        <p class="hot">Беспрецедентная акция!</p>
        <p>Теперь баню можно получить абсолютно <span>бесплатно.</span></p>
        <a href="/skidki/banya-v-podarok.htm" class="btn btn-success btn-border">Подробней</a>
        <a href="/skidki.htm" class="btn btn-success btn-border">Все акции</a>
    </div>
    
    <span class="close-hot"><i class="fa fa-times" aria-hidden="true"></i></span>
</div>-->
<!-- cnt -->
<script>(function(w,d,c){var s=d.createElement('script'),h=d.getElementsByTagName('script')[0],e=d.documentElement;if((' '+e.className+' ').indexOf(' ya-page_js_yes ')===-1){e.className+=' ya-page_js_yes';}s.type='text/javascript';s.async=true;s.charset='utf-8';s.src=(d.location.protocol==='https:'?'https:':'http:')+'//site.yandex.net/v2.0/js/all.js';h.parentNode.insertBefore(s,h);(w[c]||(w[c]=[])).push(function(){Ya.Site.Form.init()})})(window,document,'yandex_site_callbacks');</script>
<!-- Yandex.Metrika counter -->
<script> (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(44431060, "init", { id:44431060, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/44431060" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-98120011-1', 'auto');
    ga('send', 'pageview');

</script>
<!-- // cnt -->
<!-- Begin LeadBack code {literal} -->
<script>
    var _emv = _emv || [];
    _emv['campaign'] = '12f2b19fb872d89ff6f7c724';

    (function() {
        var em = document.createElement('script'); em.type = 'text/javascript'; em.async = true;
        em.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'leadback.ru/js/leadback.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(em, s);
    })();
</script>
<!-- End LeadBack code {/literal} -->