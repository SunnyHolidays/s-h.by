
<?php 
include('ep3gate.class.php');

 $ep3gate=new ep3gate(
        '12298',   // agent number
        'itaka',
    		'ep3'   // query string variable name (used to send paramaters to ibe) configurable to avoid conflict with existing parameters in your system
    );

 
	$ep3gate->setSearchType('PA');
  
$ep3gate->fetch(array('menu','searchform','configcss','headercss','headerjs','footer','content'));

    echo $ep3gate->getPart('headercss');
    echo $ep3gate->getPart('configcss');
    echo $ep3gate->getPart('headerjs');
    //$ep3gate->getStep();
?>



<table cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td valign="top">
        <table id="menupath" cellspacing="0" cellpadding="0" border="0">
          <tbody>
            <tr>
              <td width="6" class="color1bg" valign="top"><img src="http://ibe01.merlinx.pl/easypax3/img/pixel.gif" height="6" width="6"/></td>
              <td class="color1bg ep3_pt5" valign="bottom">

                <?php echo $ep3gate->getPart('menu') ?>

              </td>
              <td width="6" class="color1bg" valign="top"><img src="http://ibe01.merlinx.pl/easypax3/img/pixel.gif" height="6" width="6"/></td>
            </tr>

            <?php echo $ep3gate->getPart('content') ?>

            <tr>
              <td colspan="3" class="color1bg"><img src="http://ibe01.merlinx.pl/easypax3/img/pixel.gif" height="6" width="6"/></td>
            </tr>
          </tbody>
        </table>
      </td>


      <?php if($ep3gate->getStep() >1 ) { ?>
  

      <td>&nbsp;</td>
      <td valign="top">
        <table width="185" cellspacing="0" cellpadding="0" border="0">
          <tbody>
            <tr>
              <td width="6"><img src="http://ibe01.merlinx.pl/easypax3/img/pixel.gif" height="6" width="6"/></td>
              <td style="text-align:center;" class="color1bg ep3_pt5 ep3_pb5 color2">
                <strong>Kryteria wyboru</strong>
              </td>
              <td width="6"><img src="http://ibe01.merlinx.pl/easypax3/img/pixel.gif" height="6" width="6"/></td>
            </tr>
            
            
            
            
            <tr>
              <td width="6"><img src="http://ibe01.merlinx.pl/easypax3/img/pixel.gif" height="6" width="6"/></td>

              <td class="color0bg ep3_pl10 ep3_pr10 ep3_pt10">
              
                <?php echo $ep3gate->getPart('searchform') ?></td>

              <td width="6"><img src="http://ibe01.merlinx.pl/easypax3/img/pixel.gif" height="6" width="6"/></td>
            </tr>


            <tr>
              <?php } ?></tr>
          </tbody>
        </table>

        <?php  echo  $ep3gate->getPart('footer'); ?>

