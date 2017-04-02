
    <?php
        $content = $Page->content();
        $title = $Page->title();
        // error_log($title);
        if ( $title == 'START' ) {
            // get content line by line (each line will be an image)
            $contentArray = explode(PHP_EOL, $content);
            // add just ONE random image
            echo '<div class="conent startpage-content">';
            echo $contentArray[array_rand($contentArray)];
            echo '</div>';
        } else {
            echo '<h2>'.$title.'</h2>';
            echo '<div class="content">'.$content.'</div>';
        }
    ?>
