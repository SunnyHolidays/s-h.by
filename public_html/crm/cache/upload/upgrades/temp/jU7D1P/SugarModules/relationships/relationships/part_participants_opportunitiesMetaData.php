<?php
// created: 2013-03-03 15:16:52
$dictionary["part_participants_opportunities"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'part_participants_opportunities' => 
    array (
      'lhs_module' => 'Opportunities',
      'lhs_table' => 'opportunities',
      'lhs_key' => 'id',
      'rhs_module' => 'part_participants',
      'rhs_table' => 'part_participants',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'part_participants_opportunities_c',
      'join_key_lhs' => 'part_participants_opportunitiesopportunities_ida',
      'join_key_rhs' => 'part_participants_opportunitiespart_participants_idb',
    ),
  ),
  'table' => 'part_participants_opportunities_c',
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'id',
      'type' => 'varchar',
      'len' => 36,
    ),
    1 => 
    array (
      'name' => 'date_modified',
      'type' => 'datetime',
    ),
    2 => 
    array (
      'name' => 'deleted',
      'type' => 'bool',
      'len' => '1',
      'default' => '0',
      'required' => true,
    ),
    3 => 
    array (
      'name' => 'part_participants_opportunitiesopportunities_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'part_participants_opportunitiespart_participants_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'part_participants_opportunitiesspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'part_participants_opportunities_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'part_participants_opportunitiesopportunities_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'part_participants_opportunities_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'part_participants_opportunitiespart_participants_idb',
      ),
    ),
  ),
);