<?php
/**
 * Template Name: Поиск туров - Merlinx
 */
 
wp_enqueue_style('tours-pl', get_template_directory_uri() . '/css/tours-pl.css');
get_header();
include('ep3gate/ep3gate.class.php');

$ep3gate=new ep3gate(
	'12298',   // agent number
	'Main',
    'ep3'   // query string variable name (used to send paramaters to ibe) configurable to avoid conflict with existing parameters in your system
);

 
$ep3gate->setSearchType('PA');
  
$ep3gate->fetch(array('menu','searchform','configcss','headercss','headerjs','footer','content'));

echo $ep3gate->getPart('headercss');
echo $ep3gate->getPart('configcss');
echo $ep3gate->getPart('headerjs');
?>
    <div id="content">
        <div class="padding-w-170">
            <div id="items">
                <div class="item item-full">
                    <h1><?php the_title(); ?></h1>
                    <div class="item-body">
                        <?php
							echo $ep3gate->getPart('menu');
							echo $ep3gate->getPart('content');
                        ?>
                    </div>
                </div>

            </div>
			<div id="right-sidebar">
				<div style="height: 38px;"></div>
				<?php 
					if($ep3gate->getStep() >1 ) { 
						echo $ep3gate->getPart('searchform');
					}
				?>				
			</div>
        </div>
    </div>
    
<?php 
echo  $ep3gate->getPart('footer');
get_footer();
?>