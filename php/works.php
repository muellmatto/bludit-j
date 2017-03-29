<?php
        
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
            if ( $fields['name'] != 'News') {
                echo '<li><a href="'.HTML_PATH_ROOT.$filter.'/'.$fields['tagKey'].'">'.$fields['name'].' ('.$fields['count'].')</a></li>';
            }
        }
        echo '</ul>';

        if ($Url->whereAmI() == 'blog') {
            // list all posts
            $totalPublishedPosts = $dbPosts->numberPost(true);
            $posts = buildPostsForPage(0, $totalPublishedPosts, true, false);
        }
        foreach ($posts as $Post) {
            if ( $Post->tags() != 'News' ) {
                if($Post->coverImage()) {
                    // echo '<img src="'.$Post->coverImage().'" alt="Cover Image">';
                    $style = 'style="';
                    $style .= 'background-image: url('.$Post->coverImage().');';
                    $style .= 'background-size: cover;';
                    $style .= 'background-position: 50% 50%;';
                    $style .= '"';
                } else {
                    $style = '';
                }
                // echo '<div class="workslist" '.$style.'>';
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
?>

<div id="test">
</div>

<script>
    function listWorks () {
        var worksList = this.responseText;
        console.log(worksList[0]);
        // getWorkItem(worksList[0].key);
    }

    function showWork() {
        var work = this.responseText;
        console.log(work);
    }

    function getWorkItem (work) {
        var req = new XMLHttpRequest();
        req.addEventListener("load", showWork);
        req.open("GET", "<?php $Site->url()?>api/show/post/" + work);
        req.send();
    }

    function getWorksList () {
        var req = new XMLHttpRequest();
        req.addEventListener("load", listWorks);
        req.open("GET", "http://localhost:8000/api/show/all/posts/93d779a0a7b653fa81dcc81ec076c557");
        req.send();
    }
</script>
