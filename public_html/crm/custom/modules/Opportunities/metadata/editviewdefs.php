<?php
$viewdefs ['Opportunities'] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
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
      'javascript' => '{$PROBABILITY_SCRIPT}',
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL1' => 
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
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 
          array (
            'customCode' => '<input title="Save [Alt+S]" accessKey="S" onclick="this.form.action.value=\'Save\'; return check_custom_data();" type="submit" name="button" value="Сохранить">',
          ),
          1 => 'CANCEL',
        ),
      ),
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'custom/modules/Opportunities/validation_ew.js',
        ),
      ),
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name',
          ),
          1 => 'account_name',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'currency_id',
            'label' => 'LBL_CURRENCY',
          ),
          1 => 
          array (
            'name' => 'date_closed',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'amount',
          ),
          1 => 
          array (
            'name' => 'prepayment_c',
            'label' => 'LBL_PREPAYMENT',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'rate_c',
            'label' => 'LBL_RATE',
          ),
          1 => 
          array (
            'name' => 'amount_of_services_c',
            'label' => 'LBL_AMOUNT_OF_SERVICES',
          ),
        ),
        4 => 
        array (
          0 => 'opportunity_type',
          1 => 
          array (
            'name' => 'full_payment_date_c',
            'label' => 'LBL_FULL_PAYMENT_DATE',
          ),
        ),
        5 => 
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
        6 => 
        array (
          0 => 'sales_stage',
          1 => 'lead_source',
        ),
        7 => 
        array (
          0 => '',
          1 => '',
        ),
        8 => 
        array (
          0 => 'probability',
          1 => 'campaign_name',
        ),
        9 => 
        array (
          0 => 'next_step',
          1 => 
          array (
            'name' => 'next_step_date_c',
            'label' => 'LBL_NEXT_STEP_DATE',
          ),
        ),
        10 => 
        array (
          0 => 'description',
        ),
      ),
      'lbl_editview_panel1' => 
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
          1 => 
          array (
            'name' => 'hotel_room_c',
            'label' => 'LBL_HOTEL_ROOM',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'food_c',
            'studio' => 'visible',
            'label' => 'LBL_FOOD',
          ),
          1 => '',
        ),
      ),
      'LBL_PANEL_ASSIGNMENT' => 
      array (
        0 => 
        array (
          0 => 'assigned_user_name',
        ),
      ),
    ),
  ),
);
?>
