<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $site->title() ?></title>
        <?php echo Theme::favicon('img/favicon.ico'); ?>
	    <?php echo Theme::css('css/janna.css'); ?>
        <?php Theme::plugins('siteHead'); ?>
    </head>
    <body>
        <?php Theme::plugins('siteBodyBegin') ?>

        <div class="frame">
            <!-- nav -->
            <nav class="navigation-container">

                <div class="home-item title">
                    <a href="<?php echo $site->url();?>">
                        JANNA BANNING
                    </a>
                </div>
                <div style="clear: right;"></div>
                <div id="news" class="navigation-item">
                    <a href="/news">
                    <div class="navigation-content <?php if ( $url->slug() == 'news') {echo 'active';} ?>">
                            NEWS & EXPOS
                        </div>
                    </a>
                </div>
                <div id="work" class="navigation-item">
                    <a href="<?php echo $site->uriFilters('blog')?>">
                    <div class="navigation-content <?php if ( $url->whereAmI() == 'blog' || $url->whereAmI() == 'tag') {echo 'active';} ?>">
                            WORKS
                        </div>
                    </a>
                </div>


                <?php
                    foreach($staticContent as $Parent):
                        if ( ($site->homepage() != $Parent->slug()) && ( $Parent->slug() != 'impressum' ) ): 
                            if ( strpos($url->slug(), $Parent->slug() ) !== false) {
                                $class = 'active';
                            } else {
                                $class = '';
                            }
                ?>
                        <div class="navigation-item">
                            <a href="<?php echo $Parent->permalink() ?>">
                            <div class="<?php echo $class ?>">
                                    <?php echo $Parent->title(); ?>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>

            </nav>
            <!-- nav end -->


                <?php 
                    /*
                    echo $url->whereAmI();
                        home | page | blog | post | tag
                    */

                    if ($url->slug() == "news"){
                        include(THEME_DIR_PHP.'news.php');
                    }elseif ($url->whereAmI() == 'page') {
                        include(THEME_DIR_PHP.'page.php');
                    } elseif ($url->whereAmI() == 'post')  {
                        include(THEME_DIR_PHP.'post.php');
                    } elseif ( ($url->whereAmI()=='blog') || ($url->whereAmI()=='tag') )  {
                        include(THEME_DIR_PHP.'works.php');
                    }
                ?>

            <!-- aside>
                <a href="mailto:post@jannabanning.de" targe=_blank rel=noopener>
                    EMAIL me.
                </a>
                <a href="https://instagram.com/janna_banning" targe=_blank rel=noopener>
                    INSTAGRAM
                </a>
            </aside -->

            <footer>
                <a href="<?php echo $site->url() ?>impressum">
                    IMPRESSUM
                </a>
            </footer>
        </div>
        <?php Theme::plugins('siteBodyEnd') ?>
    </body>
</html>
