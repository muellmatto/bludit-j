<marquee behavior="scroll" direction="left" class="scrollingText">.........Hier läuft viel Text rum!.....</marquee>
<?php
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
                echo '<div class="workslist news">';
                echo '<a href="'.$n->permalink() .'">';
                echo '<h3>'.$n->title().'</h3>';
                echo '<h5>'.$n->date().'</h5>';
                if($n->coverImage()) {
                    echo '<img src="'.$n->coverImage().'" alt="Cover Image">';
                }
                echo '</a>';
                echo '</div>';
            }
            // echo '</div>';

            // fill site with exhibitions
            // echo '<div class="rightCol">';
            foreach ($exhiPosts as $e) {
                echo '<div class="workslist exhibitions">';
                echo '<a href="'.$e->permalink() .'">';
                echo '<h3>'.$e->title().'</h3>';
                echo '<h5>'.$e->date().'</h5>';
                if($Post->coverImage()) {
                    echo '<img src="'.$e->coverImage().'" alt="Cover Image">';
                } else {
                    echo '<h4>'.$e->title().'</h4>';
                }
                echo '</a>';
                echo '</div>';
            }
            // echo '</div>';



                    echo '<div style="clear: both;"></div>';
            echo '<div style="clear: both;"></div>';
?>
