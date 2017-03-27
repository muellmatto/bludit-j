
    <?php
        $content = $Page->content();
        $title = $Page->title();
        error_log($title);
        if ( $title == 'START' ) {
            $contentArray = explode(PHP_EOL, $content);
            echo '<div class="content startpage-content">';
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
    ?>
