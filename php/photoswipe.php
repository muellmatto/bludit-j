<?php
    // get images
    $html = $Post->content();
    $doc = new DOMDocument();
    $doc->loadHTML($html); // loads your html
    $xpath = new DOMXPath($doc);
    $nodelist = $xpath->query("//img"); // find your image
    // prepare photoswipe dom
?>


<!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe. 
         It's a separate element as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides. 
            PhotoSwipe keeps only 3 of them in the DOM to save memory.
            Don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                <button class="pswp__button pswp__button--share" title="Share"></button>

                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div> 
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center" style="font-size: initial;"></div>
            </div>

        </div>

    </div>

</div>
<script>

    "use strict";

    // this is dirty, but works

    function createPhotoswipeFunction(i, pswpElement) {
        var list = [];

        <?php
            foreach ($nodelist as $node) {
                $imgSrc = $node->attributes->getNamedItem('src')->nodeValue;
                $imgAlt = $node->attributes->getNamedItem('alt')->nodeValue;
                list($width, $height) = getimagesize(PATH_ROOT.$imgSrc);
                if ($width > $height) {
                    $height = intval($height * 1000 / $width);
                    $width = 1000;
                } else {
                    $width = intval($width*1000 / $height);
                    $height = 1000;
                }
                echo '
                    list.push(
                                {
                                    src: "'.$imgSrc.'",
                                    w: '.$width.',
                                    h: '.$height.',
                                    title: "'.$imgAlt.'"
                                });
                ';
            }
        ?>



        // console.log('list ' + i.toString() +':');
        // console.log(list);

        var options =   {
                            index: i,
                            shareEl: false,
                            zoomEl: false
                        };
        return function() {
            var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, list, options);
            gallery.init();
        }
    }

    function addOnClickPhotoswipe() {
        var pswpElement = document.querySelectorAll('.pswp')[0];
        var tmp = document.getElementsByTagName('img');
        for (var i=0; i < tmp.length; i++)  {
            tmp[i].onclick = createPhotoswipeFunction(i,pswpElement);
        }
    }

    addOnClickPhotoswipe();
</script>
