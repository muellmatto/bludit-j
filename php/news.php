<?php
            echo $treadmill->get();

            $newsExhiPosts = $APL->getPostsByTaglist(['News', 'Exhib']);
            
            foreach ($newsExhiPosts as $i) {
                if ( strpos($i->tags(), 'News') !== false ) {
                    $class = "news";
                } else {
                    $class = "exhibitions";
                }
                echo '<div class="workslist '.$class.'">';
                echo '<a href="'.$i->permalink() .'">';
                echo '<h3>'.$i->title().'</h3>';
                echo '<h5>'.$i->date().'</h5>';
                if($i->coverImage()) {
                    echo '<img src="'.$i->coverImage().'" alt="Cover Image">';
                }
                echo '</a>';
                echo '</div>';
            }
            echo '<div style="clear: both;"></div>';
?>
