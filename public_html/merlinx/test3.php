<?php 
include('ep3gate.class.php');

 $ep3gate=new ep3gate(
        '12298',   // agent number
        'itaka',
    		'ep3'   // query string variable name (used to send paramaters to ibe) configurable to avoid conflict with existing parameters in your system
        ,'iso-8859-2'
        ,'iconv'
    );

 
	$ep3gate->setSearchType('PA');
  
$ep3gate->fetch(array('menu','searchform','configcss','headercss','headerjs','footer','content'));

    echo $ep3gate->getPart('headercss');
    echo $ep3gate->getPart('configcss');
    echo $ep3gate->getPart('headerjs');

?>

<table cellspacing="0" cellpadding="0" border="0">
<!-- steps -->
  <tbody>
    <tr>
      <td valign="top" id="main" >
      
      <?php if($ep3gate->getStep() >1 ) { ?>
          <div class="color1bg">
          <?php echo $ep3gate->getPart('menu') ?>
          </div>
          <?php echo $ep3gate->getPart('content') ?>
      <?php } ?>
      </td>
        <td><div style="width:7px;overflow:hidden">&nbsp;</div></td>
        <td style="vertical-align:top;">
          <?php echo $ep3gate->getPart('searchform') ?>
        </td>
    </tr>
  </tbody>
</table>
<?php 

print $ep3gate->getPart('footer');

?>
