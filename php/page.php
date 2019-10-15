
    <?php
        Theme::plugins('pageBegin');
        $content = $page->content();
        $title = $page->title();
        if ( $title == 'START' ) {
            // get content line by line (each line will be an image)
            $contentArray = explode(PHP_EOL, $content);
            // add just ONE random image
            echo '<div class="conent startpage-content">';
            echo $contentArray[array_rand($contentArray)];
            echo '</div>';
        } elseif( $title == 'match') {
            include(THEME_DIR_PHP.'test.php');
        } else {
            // Returns the parent key, if the page doesn't have a parent returns FALSE
            if ( $page->parentKey() !== false) {
                // we are a child!
                $Parent = buildPage($page->parentKey());
                $children = $page->parentMethod('children');
                // hide subpage navigation of startpage children!
                if ($page->parentKey() === 'start'){
                    $children = Null;
                }
            } else {
                // we are parent!
                $Parent = $page;
                $children = $Parent->children();
            }

            // add content
            echo '<div class="content">'.$content.'</div>';
        }
        Theme::plugins('pageEnd');
    ?>
