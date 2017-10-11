<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\Carousel;
$this->title = 'Taurus GYM';
?>
<div class="site-index">
    <div>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
            <div class="item active">
              <?= Html::img("images/banner.jpg") ?>
            </div>
            <div class="item">
              <?= Html::img("images/banner2.jpg") ?>
            </div>
            <div class="item">
              <?= Html::img("images/banner3.jpg") ?>
            </div>
            <div class="item">
              <?= Html::img("images/banner4.jpg") ?>
            </div>
          </div>

          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        <div id="divMapa">
            <iframe id="mapa" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3784.7626058553597!2d-96.3549079599771!3d18.44908471181623!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c38911b0336af7%3A0x5b8b52b180f88891!2sTaurus+Gym+Platinum!5e0!3m2!1sen!2smx!4v1506977819576" width="800" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
        <div class="carousels">
            <?=
                Carousel::widget([
                    'items' => [
                        
                    ]
                ]);
            ?>
            
        </div>
    </div>
</div>

<?php
    $this->registerCss("
        .wrap > .container {
            padding: 20px 15px 20px !important;
        }

    ");

    $this->registerJs(
        "$('.carousel').carousel({
          interval: 2000
        })
        "
    );

    
?>