<?php
            echo $plugins['all']['treadmill']->get();

            // get all posts
            $totalPublishedPosts = $dbPosts->numberPost(true);
            $posts = buildPostsForPage(0, $totalPublishedPosts, true, false);
            
            // build a list of filtered posts
            $newsExhiPosts = [];
            foreach ($posts as $Post) {
                if ( (strpos($Post->tags(), 'Exhi') !== false) || (strpos($Post->tags(), 'News') !== false)) {
                    $newsExhiPosts[] = $Post;
                }
            }
            
            // now we have a filtered list with Posts of both tags
            foreach ($newsExhiPosts as $i) {
                if ( strpos($i->tags(), 'News') !== false ) {
                    $class = "news";
                } else {
                    $class = "exhibitions";
                }
                echo '<div class="workslist '.$class.'">';
                echo '<a href="'.$i->permalink() .'">';
                echo '<h3>'.$i->title().'</h3>';
                echo '<h5>'.$i->date().'</h5>';
                if($i->coverImage()) {
                    echo '<img src="'.$i->coverImage().'" alt="Cover Image">';
                }
                echo '</a>';
                echo '</div>';
            }
            echo '<div style="clear: both;"></div>';
?>
