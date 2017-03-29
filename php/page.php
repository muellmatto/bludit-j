
    <?php
        $content = $Page->content();
        $title = $Page->title();
        // error_log($title);
        if ( $title == 'START' ) {
            // get content line by line (each line will be an image)
            $contentArray = explode(PHP_EOL, $content);
            echo '<style>';
            echo 'img { width: 100%; }';
            echo '</style>';
            echo '<div class="content startpage-content">';
            // add just ONE random image
            echo $contentArray[array_rand($contentArray)];
            echo '</div>';
        } elseif ($title == 'NEWS &amp; EXPOS'){
            // maybe obsolete ....
            // get all posts
            $totalPublishedPosts = $dbPosts->numberPost(true);
            $posts = buildPostsForPage(0, $totalPublishedPosts, true, false);
            // build 2 arrays of filtered posts
            $exhiPosts = [];
            $newsPosts = [];
            foreach ($posts as $Post) {
                if (strpos($Post->tags(), 'Exhi') !== false) {
                    $exhiPosts[] = $Post;
                }
                if (strpos($Post->tags(), 'News') !== false) {
                    $newsPosts[] = $Post;
                }
            }
            // now we have two arrays, one with news, one with exhibitions

            // push newspage content into page
            // echo '<div class="leftCol">';
            // echo $content;
            // fill in news posts
            foreach ($newsPosts as $n) {
                echo '<div class="workslist rosa">';
                // echo '<div class="">';
                echo '<a href="'.$n->permalink() .'">';
                echo '<h3>'.$n->title().'</h3>';
                if($n->coverImage()) {
                    echo '<img src="'.$n->coverImage().'" alt="Cover Image">';
                }
                echo '</a>';
                echo $n->content();
                echo '</div>';
            }
            // echo '</div>';

            // fill site with exhibitions
            // echo '<div class="rightCol">';
            foreach ($exhiPosts as $e) {
                echo '<div class="workslist">';
                // echo '<div class="">';
                echo '<a href="'.$e->permalink() .'">';
                echo '<h3>'.$e->title().'</h3>';
                if($e->coverImage()) {
                    echo '<img src="'.$e->coverImage().'" alt="Cover Image">';
                }
                echo '</a>';
                echo '</div>';
            }
            // echo '</div>';



                    echo '<div style="clear: both;"></div>';
            echo '<div style="clear: both;"></div>';
        } else {
            echo '<h2>'.$title.'</h2>';
            echo '<div class="content">'.$content.'</div>';
        }
    ?>
