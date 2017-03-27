<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo HTML_PATH_THEME_CSS.'normalize.css' ?>" \>
        <link rel="stylesheet" href="<?php echo HTML_PATH_THEME_CSS.'janna.css' ?>" \>
        <script type="text/javascript" src="<?php echo HTML_PATH_THEME_JS.'janna.js' ?>"></script>
    </head>
    <body>
        <div class="frame">
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
                    <a href="<?php echo $Site->url() ?>news-expos">
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


<?php 
    /*
    echo $Url->whereAmI();
        home | page | blog | post | tag
    */

    if ($Url->whereAmI() == 'page') {
        $content = $Page->content();
        $title = $Page->title();
        error_log($title);
        if ( $title == 'START' ) {
            $contentArray = explode(PHP_EOL, $content);
            echo '<div class="content">';
            echo $contentArray[array_rand($contentArray)];
            echo '</div>';
        } elseif ($title == 'NEWS &amp; EXPOS'){
            echo '<div class="leftCol">'.$content.'</div>';
            // echo '<div class="rightCol">';
                        // list all posts
                        $totalPublishedPosts = $dbPosts->numberPost(true);
                        $posts = buildPostsForPage(0, $totalPublishedPosts, true, false);
                    foreach ($posts as $Post) {
                        if (strpos($Post->tags(), 'Expo') !== false) {
                            echo '<div class="workslist">';
                            echo '<a href="'.$Post->permalink() .'">';
                            echo '<h3>'.$Post->title().'</h3>';
                            if($Post->coverImage()) {
                                echo '<img src="'.$Post->coverImage().'" alt="Cover Image">';
                            }
                            echo '</a>';
                            echo '</div>';
                        }
                    }
                    echo '<div style="clear: both;"></div>';
            // echo '</div>';
            echo '<div style="clear: both;"></div>';
        } else {
            echo '<h2>'.$title.'</h2>';
            echo '<div class="content">'.$content.'</div>';
        }
    } elseif ($Url->whereAmI() == 'post')  {
        echo '<h1>'.$Post->title().'</h1>';
        echo '<br>';
        echo '<em>'.$Post->description().'</em>';
        echo '<br>';
	    echo $Post->content();
        $currentTag = explode(',' , $Post->tags())[0];
        echo $currentTag;
        // now we need next und prev post!
        // lets start with a list of all posts

    } elseif ( ($Url->whereAmI()=='blog') || ($Url->whereAmI()=='tag') )  {
        
        // list all tags
        global $dbTags;
        global $Url;

        $db = $dbTags->db['postsIndex'];
        $filter = $Url->filters('tag');

        $tagArray = array();

        foreach($db as $tagKey=>$fields)
        {
           $tagArray[] = array('tagKey'=>$tagKey, 'count'=>$dbTags->countPostsByTag($tagKey), 'name'=>$fields['name']);
        }

        usort($tagArray, function($a, $b) {
           return $b['count'] - $a['count'];
        });

        echo '<h3 style="float: right;">WORKS</h3>';
        echo '<ul class="taglist">';
        echo '<li><a href="'.$Site->url().'works">all</a></li>';
        foreach($tagArray as $tagKey=>$fields)
        {
           // Print the parent
           echo '<li><a href="'.HTML_PATH_ROOT.$filter.'/'.$fields['tagKey'].'">'.$fields['name'].' ('.$fields['count'].')</a></li>';
        }
        echo '</ul>';

        if ($Url->whereAmI() == 'blog') {
            // list all posts
            $totalPublishedPosts = $dbPosts->numberPost(true);
            $posts = buildPostsForPage(0, $totalPublishedPosts, true, false);
        }
        foreach ($posts as $Post) {
            echo '<div class="workslist">';
            echo '<a href="'.$Post->permalink() .'">';
            echo '<h3>'.$Post->title().'</h3>';
		if($Post->coverImage()) {
			echo '<img src="'.$Post->coverImage().'" alt="Cover Image">';
		}
            echo '</a>';
            echo '</div>';
        }
        echo '<div style="clear: both;"></div>';
    }


?>



        </div>

    </body>
</html>
