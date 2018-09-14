<div class="hot-properties hidden-xs">
    <h4>Hot Properties</h4>

    <?
      foreach($result as $res ):
    ?>
    <div class="row">
        <div class="col-lg-4 col-sm-5"><img src="<?=\frontend\components\Common::getImageAdvert($res)[0] ?>"  class="img-responsive img-circle" alt="properties"/></div>
        <div class="col-lg-8 col-sm-7">
            <h5><a href="<?=\frontend\components\Common::getUrlAdvert($res) ?>" ><?=\frontend\components\Common::getTitleAdvert($res) ?></a></h5>
            <p class="price">$<?=$res['price'] ?></p> </div>
    </div>

    <?
     endforeach;
    ?>

</div>