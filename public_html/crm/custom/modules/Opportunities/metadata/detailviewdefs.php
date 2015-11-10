<?php
$viewdefs ['Opportunities'] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => 'FIND_DUPLICATES',
          4 => 
          array (
            'customCode' => '
<input title="Договор оказания туруслуг" accesskey="Ctrl+Alt+W" class="button" onclick="document.location=\'index.php?module=Opportunities&action=ExportToDoc&record={$fields.id.value}\'" name="exporttoword" value="Договор оказания туруслуг" type="button">',
          ),
        ),
      ),
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_DETAILVIEW_PANEL1' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_PANEL_ASSIGNMENT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 'account_name',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'amount',
            'label' => '{$MOD.LBL_AMOUNT} ({$CURRENCY})',
          ),
          1 => 'date_closed',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'rate_c',
            'label' => 'LBL_RATE',
          ),
          1 => 
          array (
            'name' => 'full_payment_date_c',
            'label' => 'LBL_FULL_PAYMENT_DATE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'prepayment_c',
            'label' => 'LBL_PREPAYMENT',
          ),
          1 => 
          array (
            'name' => 'amount_of_services_c',
            'label' => 'LBL_AMOUNT_OF_SERVICES',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'date_contract_c',
            'label' => 'LBL_DATE_CONTRACT',
          ),
          1 => 
          array (
            'name' => 'contract_num_c',
            'label' => 'LBL_CONTRACT_NUM',
          ),
        ),
        5 => 
        array (
          0 => 'sales_stage',
          1 => 'opportunity_type',
        ),
        6 => 
        array (
          0 => 'probability',
          1 => 'lead_source',
        ),
        7 => 
        array (
          0 => 'next_step',
          1 => 
          array (
            'name' => 'next_step_date_c',
            'label' => 'LBL_NEXT_STEP_DATE',
          ),
        ),
        8 => 
        array (
          0 => 'campaign_name',
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'nl2br' => true,
          ),
        ),
      ),
      'lbl_detailview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'country_c',
            'studio' => 'visible',
            'label' => 'LBL_COUNTRY',
          ),
          1 => 
          array (
            'name' => 'resort_c',
            'label' => 'LBL_RESORT',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'airport_dep_c',
            'label' => 'LBL_AIRPORT_DEP',
          ),
          1 => 
          array (
            'name' => 'airport_des_c',
            'label' => 'LBL_AIRPORT_DES',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'date_start_c',
            'label' => 'LBL_DATE_START',
          ),
          1 => 
          array (
            'name' => 'date_end_c',
            'label' => 'LBL_DATE_END',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'hotel_c',
            'label' => 'LBL_HOTEL',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'hotel_room_c',
            'label' => 'LBL_HOTEL_ROOM',
          ),
          1 => 
          array (
            'name' => 'food_c',
            'studio' => 'visible',
            'label' => 'LBL_FOOD',
          ),
        ),
      ),
      'LBL_PANEL_ASSIGNMENT' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO',
          ),
          1 => 
          array (
            'name' => 'date_modified',
            'label' => 'LBL_DATE_MODIFIED',
            'customCode' => '{$fields.date_modified.value} {$APP.LBL_BY} {$fields.modified_by_name.value}',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'date_entered',
            'customCode' => '{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}',
          ),
        ),
      ),
    ),
  ),
);
?>
