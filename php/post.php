<?php
        echo '<h2>'.$Post->title().'</h2>';
        echo '<div id="workDiv" class="content">';
        echo '<em>'.$Post->description().'</em>';
        echo '<br>';
	    echo $Post->content();
        //$currentTag = explode(',' , $Post->tags())[0];
        //echo "<em>$currentTag</em>";
        //echo "<em>".$Post->tags()."</em>";
        echo '</div>';


        // now we need next und prev post!
        echo '<div class="content">';

        // lets start with a list of all posts
        $totalPublishedPosts = $dbPosts->numberPost(true);
        $posts = buildPostsForPage(0, $totalPublishedPosts, true, false);

        // lets filter out news only
        $filteredPosts = [];
        foreach ($posts as $x) {
            if ( $x->tags() != 'News' ) {
                $filteredPosts[] = $x;
            }
        }

        // find post in list and get nextPath und prevPath
        foreach ($filteredPosts as $index=>$p) {
            if ($p->title() == $Post->title()) {
                if ($index + 1 > count($filteredPosts) - 1 ) {
                    $nextPath = $filteredPosts[0]->permalink();
                } else {
                    $nextPath = $filteredPosts[$index + 1]->permalink();
                }
                if ( $index == 0) {
                    $prevPath = $filteredPosts[count($filteredPosts) - 1]->permalink();
                } else {
                    $prevPath = $filteredPosts[$index - 1]->permalink();
                }
                echo '<a style="float: right;" href="'.$nextPath.'">NEXT</a>';
                echo '<a style="float: left;" href="'.$prevPath.'">PREV</a>';
                echo '<div style="clear: both;"></div>';
            }
        }
        echo '</div>';

        // now add touchgestures wth hammer js!
?>
        <script type="text/javascript" src="<?php echo HTML_PATH_THEME_JS.'hammer.min.js' ?>"></script>
        <script>
            var workDiv = document.getElementById('workDiv');

            // create a simple instance
            // by default, it only adds horizontal recognizers
            var mc = new Hammer(workDiv);

            // listen to events...
            mc.on("panleft panright tap press", function(ev) {
                if (ev.type == 'panleft' ) { document.location.href = "<?php echo $nextPath ?>";}
                else if (ev.type == 'panright' ) { document.location.href = "<?php echo $prevPath ?>";}
                // myElement.textContent = ev.type +" gesture detected.";
            });
        </script>
