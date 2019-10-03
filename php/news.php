<?php
            echo $treadmill->get();

            $newsExhiPosts = array();
            // get all Posts
            $pageNumber = 1;
            $numberOfItems = -1;
            $onlyPublished = true;
            $items = $pages->getList($pageNumber, $numberOfItems, $onlyPublished);
            foreach ($items as $pageKey) {
                $posts[] = new Page($pageKey);
            }
            // filter 'News'
            $posts = array_filter(
                $posts,
                function($el) {
                    $tags = $el->tags();     
                    return strpos($tags, 'News')!==false or strpos($tags, 'Exhib')!==false; 
                }
            );

            
            foreach ($posts as $i) {
                if ( strpos($i->tags(), 'News') !== false ) {
                    $class = "news";
                } else {
                    $class = "exhibitions";
                }
                echo '<div class="workslist '.$class.'">';
                echo '<a href="'.$i->permalink() .'">';
                echo '<h3>'.$i->title().'</h3>';
                if($i->coverImage()) {
                    // echo '<img src="'.$i->coverImage().'&w=400&h=400" alt="Cover Image">';
                    // TODO
                    echo '<img src="'.$i->coverImage().'" alt="Cover Image">';
                }
                echo '<h6>'.$i->description().'</h6>';
                echo '<h5>'.$i->date().'</h5>';
                echo '</a>';
                echo '</div>';
            }
            echo '<div style="clear: both;"></div>';
?>
