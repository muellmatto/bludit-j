<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
        <!-- link href="https://fonts.googleapis.com/css?family=Nunito|Open+Sans+Condensed:300|PT+Sans+Narrow|Quicksand|Raleway" rel="stylesheet" -->
        <link rel="stylesheet" href="<?php echo HTML_PATH_THEME_CSS.'normalize.css' ?>" \>
        <link rel="stylesheet" href="<?php echo HTML_PATH_THEME_CSS.'janna.css' ?>" \>
        <script type="text/javascript" src="<?php echo HTML_PATH_THEME_JS.'janna.js' ?>"></script>
    </head>
    <body>
        <div class="frame">
            <!-- nav -->
            <div class="navigation-container">
                <div id="wildz" class="navigation-item">
                    <a href="<?php echo $Site->url() ?>wild-stuff">
                        <div class="navigation-content">
                            WILD STUFF
                        </div>
                    </a>
                </div>
                <div id="cv" class="navigation-item">
                    <a href="<?php echo $Site->url() ?>cv">
                        <div class="navigation-content">
                            CV
                        </div>
                    </a>
                </div>
                <div id="work" class="navigation-item">
                    <a href="<?php echo $Site->url() ?>works">
                        <div class="navigation-content">
                            WORKS
                        </div>
                    </a>
                </div>
                <div id="news" class="navigation-item">
                    <a href="<?php echo $Site->url() ?>news">
                        <div class="navigation-content">
                            NEWS & EXPOS
                        </div>
                    </a>
                </div>
                <div id="home" class="home-item">
                    <a href="<?php echo $Site->url() ?>">
                        <div class="navigation-content">
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

    </body>
</html>
