<?php
// created: 2013-03-03 15:33:57
$dictionary["part_participants"]["fields"]["part_participants_opportunities"] = array (
  'name' => 'part_participants_opportunities',
  'type' => 'link',
  'relationship' => 'part_participants_opportunities',
  'source' => 'non-db',
  'vname' => 'LBL_PART_PARTICIPANTS_OPPORTUNITIES_FROM_OPPORTUNITIES_TITLE',
  'id_name' => 'part_participants_opportunitiesopportunities_ida',
);
$dictionary["part_participants"]["fields"]["part_participants_opportunities_name"] = array (
  'name' => 'part_participants_opportunities_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_PART_PARTICIPANTS_OPPORTUNITIES_FROM_OPPORTUNITIES_TITLE',
  'save' => true,
  'id_name' => 'part_participants_opportunitiesopportunities_ida',
  'link' => 'part_participants_opportunities',
  'table' => 'opportunities',
  'module' => 'Opportunities',
  'rname' => 'name',
);
$dictionary["part_participants"]["fields"]["part_participants_opportunitiesopportunities_ida"] = array (
  'name' => 'part_participants_opportunitiesopportunities_ida',
  'type' => 'link',
  'relationship' => 'part_participants_opportunities',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_PART_PARTICIPANTS_OPPORTUNITIES_FROM_PART_PARTICIPANTS_TITLE',
);
