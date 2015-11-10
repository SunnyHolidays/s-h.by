<?php
// created: 2013-03-03 15:14:19
$dictionary["part_participants"]["fields"]["part_participants_accounts"] = array (
  'name' => 'part_participants_accounts',
  'type' => 'link',
  'relationship' => 'part_participants_accounts',
  'source' => 'non-db',
  'vname' => 'LBL_PART_PARTICIPANTS_ACCOUNTS_FROM_ACCOUNTS_TITLE',
  'id_name' => 'part_participants_accountsaccounts_ida',
);
$dictionary["part_participants"]["fields"]["part_participants_accounts_name"] = array (
  'name' => 'part_participants_accounts_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_PART_PARTICIPANTS_ACCOUNTS_FROM_ACCOUNTS_TITLE',
  'save' => true,
  'id_name' => 'part_participants_accountsaccounts_ida',
  'link' => 'part_participants_accounts',
  'table' => 'accounts',
  'module' => 'Accounts',
  'rname' => 'name',
);
$dictionary["part_participants"]["fields"]["part_participants_accountsaccounts_ida"] = array (
  'name' => 'part_participants_accountsaccounts_ida',
  'type' => 'link',
  'relationship' => 'part_participants_accounts',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_PART_PARTICIPANTS_ACCOUNTS_FROM_PART_PARTICIPANTS_TITLE',
);
