<?php

    // get all posts, that are not news.
    $posts = array();
    $pageNumber = 1;
    $numberOfItems = -1;
    $onlyPublished = true;
    $items = $pages->getList($pageNumber, $numberOfItems, $onlyPublished);
    foreach ($items as $pageKey) {
        $posts[] = new Page($pageKey);
    }
    // filter 'News'
    $posts = array_filter($posts, function($el){ return $el->tags() != "News"; });

    // create an sorted array of tags  
    $tag_array = array();
    foreach ($tags->keys() as $key) {
        // Create Tag-Object
        $tag = new Tag($key);
        $tag_array[] = array(
            'key' => $tag->key(),
            'count' => count($tag->pages()),
            'name' => $tag->name(),
            'link' => $tag->permalink()
        );
    }
    // sort by number of child items
    usort($tag_array, function($a, $b) {
       return $b['count'] - $a['count'];
    });

    // print menu
    echo '<ul class="taglist">';
        echo '<li class="tagItem">
            <a href="/works/">all ('.count($posts).')</a></li>';
        foreach ( $tag_array as $tag_item=>$tag ) {
            if ( $tag['name'] != 'News' ) {
                if ( $tag['key'] == $url->slug() ) {
                    $class = 'active';
                } else {
                    $class = '';
                }
                echo '<li class="tagItem '.$class.'">
                    <a href="'.$tag['link'].'">'.$tag['name'].' ('.$tag['count'].')</a>
                </li>';
            }
        }
    echo '</ul>';
    echo '<div style="clear: both;></div>"';


        echo '<div class="worksListFrame">';
        if ($url->whereAmI() == 'tag') {
            $tag = new Tag($url->slug());
            $posts = array();
            foreach ($tag->pages() as $pageKey) {
                $posts[] = new Page($pageKey);
            }
        }
        foreach ($posts as $Post) {
            echo '<div class="workslist">';
            echo '<a href="'.$Post->permalink().'">';
            if($Post->coverImage()) {
                echo '<img src="'.$Post->coverImage().'" alt="Cover Image">';
                // TODO
                // echo '<img src="'.$Post->coverImage().'&w=400&h=400" alt="Cover Image">';
            } else {
                echo '<h3 class="workslist-text">'.$Post->title().'</h3>';
            }
            echo '</a>';
            echo '</div>';
        }
        echo '<div style="clear: both;"></div>';
        echo '</div>';
?>
