<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $Site->title() ?></title>
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
        <?php Theme::css('normalize.css') ?>
        <?php Theme::css('janna.css') ?>
        <?php Theme::javascript('janna.js') ?>
        <?php Theme::plugins('siteHead'); ?>
    </head>
    <body>
        <?php Theme::plugins('siteBodyBegin') ?>

        <div class="frame">
            <!-- nav -->
            <div class="navigation-container">

<style>

   .title {   
    animation-name: spin;
    animation-duration: 100000ms;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
    position: fixed;
  }
  @keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
  }
  </style>
<p class="title">janna<br>banning</p>



                <?php
                    $parents = $pagesParents[NO_PARENT_CHAR];
                    foreach($parents as $Parent):
                        if ( ($Site->homepage() != $Parent->slug()) && ( $Parent->slug() != 'impressum' ) ): 
                            if ( strpos($Url->slug(), $Parent->slug() ) !== false) {
                                $class = 'active';
                            } else {
                                $class = '';
                            }
                ?>
                        <div class="navigation-item">
                            <a href="<?php echo $Parent->permalink() ?>">
                            <div class="navigation-content <?php echo $class ?>">
                                    <?php echo $Parent->title(); ?>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>

                <div id="work" class="navigation-item">
                    <a href="<?php echo $Site->uriFilters('blog')?>">
                    <div class="navigation-content <?php if ( $Url->whereAmI() == 'blog' || $Url->whereAmI() == 'tag') {echo 'active';} ?>">
                            WORKS
                        </div>
                    </a>
                </div>
                <div id="news" class="navigation-item">
                    <a href="<?php echo $Site->url() ?>news">
                    <div class="navigation-content <?php if ( $Url->slug() == 'news') {echo 'active';} ?>">
                            NEWS & EXPOS
                        </div>
                    </a>
                </div>
                <div style="clear: both;"></div>
            </div>
            <!-- nav end -->


                <?php 
                    /*
                    echo $Url->whereAmI();
                        home | page | blog | post | tag
                    */

                    if ($Url->slug() == "news"){
                        include(THEME_DIR_PHP.'news.php');
                    }elseif ($Url->whereAmI() == 'page') {
                        include(THEME_DIR_PHP.'page.php');
                    } elseif ($Url->whereAmI() == 'post')  {
                        include(THEME_DIR_PHP.'post.php');
                    } elseif ( ($Url->whereAmI()=='blog') || ($Url->whereAmI()=='tag') )  {
                        include(THEME_DIR_PHP.'works.php');
                    }
                ?>


            <a href="<?php echo $Site->url() ?>impressum">
                <span style="float: right; padding: 2rem;">IMPRESSUM</span>
            </a>
        </div>
        
        <?php Theme::plugins('siteBodyEnd') ?>

    </body>
</html>
