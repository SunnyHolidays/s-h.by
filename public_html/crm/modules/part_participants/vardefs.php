<?php
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2012 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/

$dictionary['part_participants'] = array(
	'table'=>'part_participants',
	'audited'=>true,
		'duplicate_merge'=>true,
		'fields'=>array (
  'birthday' => 
  array (
    'required' => true,
    'name' => 'birthday',
    'vname' => 'LBL_BIRTHDAY',
    'type' => 'date',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'size' => '20',
    'enable_range_search' => false,
  ),
  'fnamerus' => 
  array (
    'required' => true,
    'name' => 'fnamerus',
    'vname' => 'LBL_FNAMERUS',
    'type' => 'varchar',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '&ETH;&ETH;&deg; &Ntilde;€&Ntilde;ƒ&Ntilde;&Ntilde;&ETH;&ordm;&ETH;&frac34;&ETH;&frac14;',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => '255',
    'size' => '20',
  ),
  'snamerus' => 
  array (
    'required' => true,
    'name' => 'snamerus',
    'vname' => 'LBL_SNAMERUS',
    'type' => 'varchar',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '&ETH;&ETH;&deg; &Ntilde;€&Ntilde;ƒ&Ntilde;&Ntilde;&ETH;&ordm;&ETH;&frac34;&ETH;&frac14;',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => '255',
    'size' => '20',
  ),
  'mnamerus' => 
  array (
    'required' => true,
    'name' => 'mnamerus',
    'vname' => 'LBL_MNAMERUS',
    'type' => 'varchar',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '&ETH;&ETH;&deg; &Ntilde;€&Ntilde;ƒ&Ntilde;&Ntilde;&ETH;&ordm;&ETH;&frac34;&ETH;&frac14;',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => '255',
    'size' => '20',
  ),
  'passport_num' => 
  array (
    'required' => true,
    'name' => 'passport_num',
    'vname' => 'LBL_PASSPORT_NUM',
    'type' => 'varchar',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => '255',
    'size' => '20',
  ),
  'passport_date' => 
  array (
    'required' => true,
    'name' => 'passport_date',
    'vname' => 'LBL_PASSPORT_DATE',
    'type' => 'date',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'size' => '20',
    'enable_range_search' => false,
  ),
  'passport_who' => 
  array (
    'required' => true,
    'name' => 'passport_who',
    'vname' => 'LBL_PASSPORT_WHO',
    'type' => 'varchar',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => '255',
    'size' => '20',
  ),
  'first_name' => 
  array (
    'name' => 'first_name',
    'vname' => 'LBL_FIRST_NAME',
    'type' => 'varchar',
    'len' => '100',
    'unified_search' => false,
    'full_text_search' => 
    array (
      'boost' => 3,
    ),
    'comment' => 'First name of the contact',
    'merge_filter' => 'disabled',
    'required' => false,
    'massupdate' => 0,
    'no_default' => false,
    'comments' => 'First name of the contact',
    'help' => 'ĞĞ° Ğ°Ğ½Ğ³Ğ»Ğ¸Ğ¹ÑĞºĞ¾Ğ¼',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'size' => '20',
  ),
  'passport_valid' => 
  array (
    'required' => true,
    'name' => 'passport_valid',
    'vname' => 'LBL_PASSPORT_VALID',
    'type' => 'date',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'size' => '20',
    'enable_range_search' => false,
  ),
  'last_name' => 
  array (
    'name' => 'last_name',
    'vname' => 'LBL_LAST_NAME',
    'type' => 'varchar',
    'len' => '100',
    'unified_search' => false,
    'full_text_search' => 
    array (
      'boost' => 3,
    ),
    'comment' => 'Last name of the contact',
    'merge_filter' => 'disabled',
    'required' => true,
    'importable' => 'required',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => 'Last name of the contact',
    'help' => 'ĞĞ° Ğ°Ğ½Ğ³Ğ»Ğ¸Ğ¹ÑĞºĞ¾Ğ¼',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'size' => '20',
  ),
),
	'relationships'=>array (
),
	'optimistic_locking'=>true,
		'unified_search'=>true,
	);
if (!class_exists('VardefManager')){
        require_once('include/SugarObjects/VardefManager.php');
}
VardefManager::createVardef('part_participants','part_participants', array('basic','assignable','person'));