<?php
        echo '<h2>'.$Post->title().'</h2>';
        echo '<div class="content">';
        echo '<em>'.$Post->description().'</em>';
        echo '<br>';
	    echo $Post->content();
        //$currentTag = explode(',' , $Post->tags())[0];
        //echo "<em>$currentTag</em>";
        //echo "<em>".$Post->tags()."</em>";
        echo '</div>';


        echo '<div class="content">';
        // now we need next und prev post!
        // lets start with a list of all posts
        $totalPublishedPosts = $dbPosts->numberPost(true);
        $posts = buildPostsForPage(0, $totalPublishedPosts, true, false);
        // $filteredPosts = buildPostsForPage(0, $totalPublishedPosts, true, false);

        // lets filter out news only
        $filteredPosts = [];
        foreach ($posts as $x) {
            if ( $x->tags() != 'News' ) {
                $filteredPosts[] = $x;
            }
        }
        //$filteredPosts = $posts;
        foreach ($filteredPosts as $index=>$p) {
            if ($p->title() == $Post->title()) {
                // echo "$index - <b><em>".$p->permalink()."</em></b>";
                // echo '<br>';
                // echo 'index - '.$index.'<br>';
                // echo 'num posts - '.count($posts).'<br>';
                if ($index + 1 > count($filteredPosts) - 1 ) {
                    // echo "next ist 0";
                    // echo '<a href="'.$posts[0]->permalink().'">'.$posts[0]->title().'</a>';
                    echo '<a style="float: right;" href="'.$filteredPosts[0]->permalink().'">NEXT</a>';
                } else {
                    // echo "next ist ".($index + 1).' - ';
                    // echo '<a href="'.$posts[$index + 1]->permalink().'">'.$posts[$index + 1]->title().'</a>';
                    echo '<a style="float: right;" href="'.$filteredPosts[$index + 1]->permalink().'">NEXT</a>';
                }
                if ( $index == 0) {
                    // echo "prev ist ".(count($posts) -1);
                    // echo '<a href="'.$posts[count($posts) - 1]->permalink().'">'.$posts[count($posts) - 1]->title().'</a>';
                    echo '<a style="float: left;" href="'.$filteredPosts[count($filteredPosts) - 1]->permalink().'">PREV</a>';
                } else {
                    // echo "prev ist ".($index - 1).' - ';
                    // echo '<a href="'.$posts[$index - 1]->permalink().'">'.$posts[$index - 1]->title().'</a>';
                    echo '<a style="float: left;" href="'.$filteredPosts[$index - 1]->permalink().'">PREV</a>';
                }
                echo '<div style="clear: both;"></div>';
            }
        }
        echo '</div>';
?>
