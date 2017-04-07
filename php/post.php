<?php

        Theme::plugins('postBegin');

        if ( !(empty( $_GET['fromTag'] )) ) {
            $fromTag = $_GET['fromTag'];
            echo '<h3>'.$fromTag.'</h3>';
        }
        echo '<h2>'.$Post->title().'</h2>';
        echo '<div id="workDiv" class="content">';
        echo '<em>'.$Post->description().'</em>';
        echo '<br>';
	    echo $Post->content();
        echo '</div>';

        // show Prev / Next post-links
        echo '<div class="content">';
            // are we browsing on specific tag?
            if (isset($fromTag)) {
                echo '<a style="float: right;" href="'.$APL->getNextPostByTagList([$fromTag])->permalink().'?fromTag='.$fromTag.'">NEXT</a>';
                echo '<a style="float: left;" href="'.$APL->getPrevPostByTagList([$fromTag])->permalink().'?fromTag='.$fromTag.'">PREV</a>';
            // are we browsing all warks?
            } elseif ( $Post->tags() != 'News' ) {
                echo '<a style="float: right;" href="'.$APL->getNextPostByBlackList(['News'])->permalink().'">NEXT</a>';
                echo '<a style="float: left;" href="'.$APL->getPrevPostByBlackList(['News'])->permalink().'">PREV</a>';
            }
            echo '<div style="clear: both;"></div>';
        echo '</div>';

        Theme::plugins('postEnd');
        
        // now add touchgestures wth hammer js!
?>
        <script type="text/javascript" src="<?php echo HTML_PATH_THEME_JS.'hammer.min.js' ?>"></script>
        <script>
            /*
            var workDiv = document.getElementById('workDiv');

            // create a simple instance
            // by default, it only adds horizontal recognizers
            var mc = new Hammer(workDiv);
            
            // der rotz läuf nicht wie er soll, viel zu empfindlich
            mc.get('swipe').set({ threshold: 10000, velocity: 30});

            // listen to events...
            mc.on("panleft panright tap press", function(ev) {
                if (ev.type == 'panleft' ) { document.location.href = "<?php echo $nextPath ?>";}
                else if (ev.type == 'panright' ) { document.location.href = "<?php echo $prevPath ?>";}
                // myElement.textContent = ev.type +" gesture detected.";
            });
            */
        </script>
