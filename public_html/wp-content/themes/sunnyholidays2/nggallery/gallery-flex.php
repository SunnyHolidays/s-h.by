<?php
/**
Template Page for the gallery flex

Follow variables are useable :

$gallery     : Contain all about the gallery
$images      : Contain all images, path, title
$pagination  : Contain the pagination content
$current     : Contain the selected image
$prev/$next  : Contain link to the next/previous gallery page


You can check the content when you insert the tag <?php var_dump($variable) ?>
If you would like to show the timestamp of the image ,you can use <?php echo $exif['created_timestamp'] ?>
 **/
?>
<?php if (!defined('ABSPATH')) {
    die ('No direct access allowed');
} ?><?php if (!empty ($gallery)) : ?>

    <script>
        $(window).load(function () {
            // The slider being synced must be initialized first
           var id = '<?php echo $gallery->ID;?>';
			
            $('#carousel-' + id).flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                itemWidth: 120,
                itemMargin: 5,
                asNavFor: '#slider-' + id
            });

            $('#slider-' + id).flexslider({
                animation: "slide",
                directionNav: false,
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                sync: "#carousel-" + id,
                start: function (slider) {
                    $('#slider-' + id).spin('small');
                    thumbLoader();

                    imgLoader(slider.animatingTo);

                },
                before: function (slider) {
                    var handler = $('#slider-' + id + ' li').eq(slider.animatingTo).find('img');
                    if (handler.attr('src') != handler.attr('data-original')) {
                        $('#slider-' + id).spin('small');
                    }

                },
                after: function (slider) {
                    imgLoader(slider.animatingTo);
                }
            });
            function imgLoader(index) {

                var handler = $('#slider-' + id + ' .flex-active-slide img');
                var img = new Image();
                img.src = $(handler).attr('data-original');
				
                img.onload = function () {
                    var handler = $('#slider-' + id + ' li').eq(index).find('img');
                    if (handler.attr('src') != handler.attr('data-original')) {
                      $('#slider-' + id).spin(false);
                    }
                    $(handler).attr('src', img.src);
                    var aspectRatioContainer = $('#slider-' + id).width()/$('#slider-' + id).height();
                    var aspectRatioImg = img.width/img.height;
                    if (aspectRatioContainer>=aspectRatioImg){
                           $(handler).attr('width',$('#slider-' + id).width());
                         $(handler).css('top',($('#slider-' + id).height()-$('#slider-' + id +' .flex-active-slide').height())/2);

                    }
                    else{
                          $(handler).attr('height',$('#slider-' + id).height());
                         $(handler).css('left',($('#slider-' + id +' .flex-active-slide').width()-$('#slider-' + id).width())/2);

                    }
                }
            }

            function thumbLoader() {
                $(".carousel .slides li").each(function (index) {
                    $(this).spin('small');

                    var handler = $(this);
                    var imageHandler = $(this).find('img');
                    var img = new Image();
                    img.src = $(imageHandler).attr('data-original');
                    img.onload = function () {
                    $(handler).spin(false);
                        $(imageHandler).attr('src', img.src);
                    }
                });


            }

        });
        $(document).ready(function () {
		var id = '<?php echo $gallery->ID;?>';
            $('#slider-' + id + ' .slides').magnificPopup({
                delegate: 'a', // child items selector, by clicking on it popup will open
               type: 'image',
               gallery: {
                enabled: true
               }
               // other options
           });

        });
    </script>
    <div class="gallery">
        <div id="slider-<?php echo($gallery->ID); ?>" class="flexslider slider">
            <ul class="slides">
                <?php foreach ($images as $image) : ?>
                    <?php if ($image->hidden) {
                        continue;
                    } ?>
                    <li>
                        <a href="<?php echo $image->imageURL ?>" title="<?php echo $image->description ?>">
                            <img title="<?php echo $image->alttext ?>" alt="<?php echo $image->alttext ?>"
                                 data-original="<?php echo $image->imageURL ?>"
                                 src="<?php echo get_template_directory_uri(); ?>/img/sp.gif"/>
                        </a>
                    </li>
                <?php endforeach; ?>
                <!-- items mirrored twice, total of 12 -->
            </ul>
            <div class="flex-caption-wraper">
                <div class="flex-caption">
                    <p><?php echo $gallery->description ?></p>
                </div>
            </div>
        </div>

        <div id="carousel-<?php echo($gallery->ID); ?>" class="flexslider carousel">
            <ul class="slides">
                <?php foreach ($images as $image) : ?>
                    <?php if ($image->hidden) {
                        continue;
                    } ?>
                    <li>
                        <img title="<?php echo $image->alttext ?>" alt="<?php echo $image->alttext ?>"
                             data-original="<?php echo $image->thumbnailURL ?>"
                             src="<?php echo get_template_directory_uri(); ?>/img/sp.gif"/>
                    </li>
                <?php endforeach; ?>
                <!-- items mirrored twice, total of 12 -->
            </ul>
        </div>
    </div>
<?php endif; ?>