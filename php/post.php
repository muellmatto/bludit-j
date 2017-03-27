<?php
        echo '<h1>'.$Post->title().'</h1>';
        echo '<br>';
        echo '<em>'.$Post->description().'</em>';
        echo '<br>';
	    echo $Post->content();
        $currentTag = explode(',' , $Post->tags())[0];
        echo $currentTag;
        // now we need next und prev post!
        // lets start with a list of all posts
?>
