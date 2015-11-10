<?php /* Smarty version 2.6.11, created on 2013-03-13 12:45:24
         compiled from include/SugarFields/Fields/File/DetailView.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugarvar', 'include/SugarFields/Fields/File/DetailView.tpl', 38, false),array('function', 'sugarvar_connector', 'include/SugarFields/Fields/File/DetailView.tpl', 50, false),)), $this); ?>
{*
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

*}
<span class="sugar_field" id="<?php if (empty ( $this->_tpl_vars['displayParams']['idName'] )):  echo smarty_function_sugarvar(array('key' => 'name'), $this); else:  echo $this->_tpl_vars['displayParams']['idName'];  endif; ?>">
<a href="index.php?entryPoint=download&id={$fields.<?php echo $this->_tpl_vars['vardef']['fileId']; ?>
.value}&type=<?php echo $this->_tpl_vars['vardef']['linkModule']; ?>
" class="tabDetailViewDFLink" target='_blank'><?php echo smarty_function_sugarvar(array('key' => 'value'), $this);?>
</a>
</span>
<?php if (isset ( $this->_tpl_vars['vardef'] ) && isset ( $this->_tpl_vars['vardef']['allowEapm'] ) && $this->_tpl_vars['vardef']['allowEapm']): ?>
{if isset($fields.<?php echo $this->_tpl_vars['vardef']['docType']; ?>
) && !empty($fields.<?php echo $this->_tpl_vars['vardef']['docType']; ?>
.value) && $fields.<?php echo $this->_tpl_vars['vardef']['docType']; ?>
.value != 'SugarCRM' && !empty($fields.<?php echo $this->_tpl_vars['vardef']['docUrl']; ?>
.value) }
{capture name=imageNameCapture assign=imageName}
{$fields.<?php echo $this->_tpl_vars['vardef']['docType']; ?>
.value}_image_inline.png
{/capture}
<a href="{$fields.<?php echo $this->_tpl_vars['vardef']['docUrl']; ?>
.value}" class="tabDetailViewDFLink" target="_blank">{sugar_getimage name=$imageName alt=$imageName other_attributes='border="0" '}</a>
{/if}
<?php endif;  if (! empty ( $this->_tpl_vars['displayParams']['enableConnectors'] )):  echo smarty_function_sugarvar_connector(array('view' => 'DetailView'), $this);?>

<?php endif; ?>