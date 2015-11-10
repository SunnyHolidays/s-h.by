<?php

require_once('include/Dashlets/DashletGeneric.php');


class MyLateOpportunitiesDashlet extends DashletGeneric
{
    function MyLateOpportunitiesDashlet($id, $def = null)
    {
        include('custom/modules/Opportunities/Dashlets/MyLateOpportunitiesDashlet/MyLateOpportunitiesDashletdata.php');

        parent::DashletGeneric($id, $def);

        if (empty($def['title'])) $this->title = translate('LBL_LATE_OPPORTUNITIES', 'Opportunities');

        $this->searchFields = $dashletData['MyLateOpportunitiesDashlet']['searchFields'];
        $this->columns = $dashletData['MyLateOpportunitiesDashlet']['columns'];

        $this->seedBean = new Opportunity();
    }

    function process($lvsParams = array())
    {
        $lvsParams = array('custom_where' => " and opportunities_cstm.next_step_date_c<='" . date('Y-m-d') . "'");
		$lvsParams['overrideOrder'] = true;
$lvsParams['orderBy'] = 'NEXT_STEP_DATE_C';
$lvsParams['sortOrder'] = 'ASC';  
        parent::process($lvsParams);
        foreach ($this->lvs->data['data'] as $rowNum => $row) {
            $next_step_date = $this->lvs->data['data'][$rowNum]['NEXT_STEP_DATE_C'];
            if ($next_step_date < date("d-m-Y")) {

                $this->lvs->data['data'][$rowNum]['NEXT_STEP_DATE_C'] = "<span style='color:red'>$next_step_date</span>";
            }

        }

    }
}


?>
