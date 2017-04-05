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

        echo '<ul class="taglist">';
        echo '<li class="tagItem"><a href="'.$Site->url().'works">all</a></li>';
        foreach($tagArray as $tagKey=>$fields)
        {
            // Print the parent
            if ( $fields['name'] != 'News') {
                echo '<li class="tagItem"><a href="'.HTML_PATH_ROOT.$filter.'/'.$fields['tagKey'].'">'.$fields['name'].' ('.$fields['count'].')</a></li>';
            }
        }
        echo '</ul>';
        echo '<div style="clear: both;></div>"';
        
        echo '<div class="worksListFrame">';

        if ($Url->whereAmI() == 'blog') {
            // list all posts
            $totalPublishedPosts = $dbPosts->numberPost(true);
            $posts = buildPostsForPage(0, $totalPublishedPosts, true, false);
        }
        foreach ($posts as $Post) {
            if ( $Post->tags() != 'News' ) {
                echo '<div class="workslist">';
                echo '<a href="'.$Post->permalink() .'">';
                if($Post->coverImage()) {
                    echo '<img src="'.$Post->coverImage().'" alt="Cover Image">';
                } else {
                    echo '<h4>'.$Post->title().'</h4>';
                }
                echo '</a>';
                echo '</div>';
            }
        }
        echo '<div style="clear: both;"></div>';
        echo '</div>';
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
