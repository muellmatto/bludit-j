
    <?php
        Theme::plugins('pageBegin');
        $content = $Page->content();
        $title = $Page->title();
        if ( $title == 'START' ) {
            // get content line by line (each line will be an image)
            $contentArray = explode(PHP_EOL, $content);
            // add just ONE random image
            echo '<div class="conent startpage-content">';
            echo $contentArray[array_rand($contentArray)];
            echo '</div>';
        } else {
            // Returns the parent key, if the page doesn't have a parent returns FALSE
            if ( $Page->parentKey() !== false) {
                // we are a child!
                $Parent = buildPage($Page->parentKey());
                $children = $Page->parentMethod('children');
            } else {
                // we are parent!
                $Parent = $Page;
                $children = $Parent->children();
            }
            if ( $Page->slug() == $Parent->slug() ) {
                $class = 'active';
            } else {
                $class = '';
            }
            echo '<a href="'.$Parent->permalink().'">';
            echo '<h2 class="subNavigation '.$class.'">'.$Parent->title().'</h2>';
            echo '</a>';
            foreach ($children as $ChildKey) {
                $Child = buildPage($Parent->slug().'/'.$ChildKey);
                if ( $Page->slug() == $Child->slug() ) {
                    $class = 'active';
                } else {
                    $class = '';
                }
                echo '<a href="'.$Child->permalink().'">';
                echo '<h2 class="subNavigation '.$class.'">'.$Child->title().'</h2>';
                echo '</a>';
            }
            echo '<div style="clear: both;"></div>';
                        /*
                        // check if page has childs or is child
                        if ( array_key_exists( $Page->key() , $pagesParents ) || $Page->parentKey() ) {
                            // get children if Parent or siblings if child
                            if ($Page->parentKey()) {
                                $ParentKey = $Page->parentKey();
                                $children = $pagesParents[$Page->parentKey()];
                            } else {
                                $ParentKey = $Page->key();
                                $children = $pagesParents[$Page->key()];
                            }
                            foreach( $children as $Child ) {
                                echo '<p>'.$Child->title().'</p>';
                            }
                        }
                         */
            echo '<div class="content">'.$content.'</div>';
        }
        Theme::plugins('pageEnd');
    ?>
