<?php
 // created: 2013-03-03 15:16:52
$layout_defs["Accounts"]["subpanel_setup"]['part_participants_accounts'] = array (
  'order' => 100,
  'module' => 'part_participants',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_PART_PARTICIPANTS_ACCOUNTS_FROM_PART_PARTICIPANTS_TITLE',
  'get_subpanel_data' => 'part_participants_accounts',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);
