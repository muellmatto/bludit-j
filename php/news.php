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
                if($e->coverImage()) {
                    // echo '<img src="'.$Post->coverImage().'" alt="Cover Image">';
                    $style = 'style="';
                    $style .= 'background-image: url('.$e->coverImage().');';
                    $style .= 'background-size: cover;';
                    $style .= 'background-position: 50% 50%;';
                    $style .= '"';
                } else {
                    $style = '';
                }
                echo '<div class="workslist" '.$style.'>';
                // echo '<div class="">';
                echo '<a href="'.$e->permalink() .'">';
                echo '<h3>'.$e->title().'</h3>';
                if($e->coverImage()) {
                    // echo '<img src="'.$e->coverImage().'" alt="Cover Image">';
                }
                echo '</a>';
                echo '</div>';
            }
            // echo '</div>';



                    echo '<div style="clear: both;"></div>';
            echo '<div style="clear: both;"></div>';
?>
