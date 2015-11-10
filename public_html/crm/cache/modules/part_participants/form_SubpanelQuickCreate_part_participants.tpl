

<script>
{literal}
$(document).ready(function(){
$("ul.clickMenu").each(function(index, node){
$(node).sugarActionMenu();
});
});
{/literal}
</script>
<div class="clear"></div>
<form action="index.php" method="POST" name="{$form_name}" id="{$form_id}" {$enctype}>
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="dcQuickEdit">
<tr>
<td class="buttons">
<input type="hidden" name="module" value="{$module}">
{if isset($smarty.request.isDuplicate) && $smarty.request.isDuplicate eq "true"}
<input type="hidden" name="record" value="">
<input type="hidden" name="duplicateSave" value="true">
<input type="hidden" name="duplicateId" value="{$fields.id.value}">
{else}
<input type="hidden" name="record" value="{$fields.id.value}">
{/if}
<input type="hidden" name="isDuplicate" value="false">
<input type="hidden" name="action">
<input type="hidden" name="return_module" value="{$smarty.request.return_module}">
<input type="hidden" name="return_action" value="{$smarty.request.return_action}">
<input type="hidden" name="return_id" value="{$smarty.request.return_id}">
<input type="hidden" name="module_tab"> 
<input type="hidden" name="contact_role">
{if (!empty($smarty.request.return_module) || !empty($smarty.request.relate_to)) && !(isset($smarty.request.isDuplicate) && $smarty.request.isDuplicate eq "true")}
<input type="hidden" name="relate_to" value="{if $smarty.request.return_relationship}{$smarty.request.return_relationship}{elseif $smarty.request.relate_to && empty($smarty.request.from_dcmenu)}{$smarty.request.relate_to}{elseif empty($isDCForm) && empty($smarty.request.from_dcmenu)}{$smarty.request.return_module}{/if}">
<input type="hidden" name="relate_id" value="{$smarty.request.return_id}">
{/if}
<input type="hidden" name="offset" value="{$offset}">
{assign var='place' value="_HEADER"} <!-- to be used for id for buttons with custom code in def files-->
<div class="action_buttons">{if $bean->aclAccess("save")}<input title="{$APP.LBL_SAVE_BUTTON_TITLE}"  class="button" onclick="var _form = document.getElementById('form_SubpanelQuickCreate_part_participants'); disableOnUnloadEditView(); _form.action.value='Save';if(check_form('form_SubpanelQuickCreate_part_participants'))return SUGAR.subpanelUtils.inlineSave(_form.id, 'part_participants_subpanel_save_button');return false;" type="submit" name="part_participants_subpanel_save_button" id="part_participants_subpanel_save_button" value="{$APP.LBL_SAVE_BUTTON_LABEL}">{/if}  <input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" class="button" onclick="return SUGAR.subpanelUtils.cancelCreate($(this).attr('id'));return false;" type="submit" name="part_participants_subpanel_cancel_button" id="part_participants_subpanel_cancel_button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}">  <input title="{$APP.LBL_FULL_FORM_BUTTON_TITLE}" class="button" onclick="var _form = document.getElementById('form_SubpanelQuickCreate_part_participants'); disableOnUnloadEditView(_form); _form.return_action.value='DetailView'; _form.action.value='EditView'; if(typeof(_form.to_pdf)!='undefined') _form.to_pdf.value='0';" type="submit" name="part_participants_subpanel_full_form_button" id="part_participants_subpanel_full_form_button" value="{$APP.LBL_FULL_FORM_BUTTON_LABEL}"> <input type="hidden" name="full_form" value="full_form"> {if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=part_participants", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}<div class="clear"></div></div>
</td>
<td align='right'>
{$PAGINATION}
</td>
</tr>
</table>{sugar_include include=$includes}
<span id='tabcounterJS'><script>SUGAR.TabFields=new Array();//this will be used to track tabindexes for references</script></span>
<div id="form_SubpanelQuickCreate_part_participants_tabs"
>
<div >
<div id="detailpanel_1" class="{$def.templateMeta.panelClass|default:'edit view edit508'}">
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table width="100%" border="0" cellspacing="1" cellpadding="0"  id='LBL_CONTACT_INFORMATION'  class="edit view panelContainer">
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='snamerus_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_SNAMERUS' module='part_participants'}{/capture}
{$label|strip_semicolon}:
<span class="required">*</span>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.snamerus.value) <= 0}
{assign var="value" value=$fields.snamerus.default_value }
{else}
{assign var="value" value=$fields.snamerus.value }
{/if}  
<input type='text' name='{$fields.snamerus.name}' 
id='{$fields.snamerus.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      accesskey='7'  >
<td valign="top" id='last_name_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_LAST_NAME' module='part_participants'}{/capture}
{$label|strip_semicolon}:
<span class="required">*</span>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.last_name.value) <= 0}
{assign var="value" value=$fields.last_name.default_value }
{else}
{assign var="value" value=$fields.last_name.value }
{/if}  
<input type='text' name='{$fields.last_name.name}' 
id='{$fields.last_name.name}' size='30' 
maxlength='100' 
value='{$value}' title='На английском'      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='fnamerus_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_FNAMERUS' module='part_participants'}{/capture}
{$label|strip_semicolon}:
<span class="required">*</span>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.fnamerus.value) <= 0}
{assign var="value" value=$fields.fnamerus.default_value }
{else}
{assign var="value" value=$fields.fnamerus.value }
{/if}  
<input type='text' name='{$fields.fnamerus.name}' 
id='{$fields.fnamerus.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
<td valign="top" id='first_name_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_FIRST_NAME' module='part_participants'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.first_name.value) <= 0}
{assign var="value" value=$fields.first_name.default_value }
{else}
{assign var="value" value=$fields.first_name.value }
{/if}  
<input type='text' name='{$fields.first_name.name}' 
id='{$fields.first_name.name}' size='30' 
maxlength='100' 
value='{$value}' title='На английском'      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='mnamerus_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_MNAMERUS' module='part_participants'}{/capture}
{$label|strip_semicolon}:
<span class="required">*</span>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.mnamerus.value) <= 0}
{assign var="value" value=$fields.mnamerus.default_value }
{else}
{assign var="value" value=$fields.mnamerus.value }
{/if}  
<input type='text' name='{$fields.mnamerus.name}' 
id='{$fields.mnamerus.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
<td valign="top" id='birthday_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_BIRTHDAY' module='part_participants'}{/capture}
{$label|strip_semicolon}:
<span class="required">*</span>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.birthday.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.birthday.name}" id="{$fields.birthday.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.birthday.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.birthday.name}",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.birthday.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='adress_c_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_ADRESS' module='part_participants'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}

{if strlen($fields.adress_c.value) <= 0}
{assign var="value" value=$fields.adress_c.default_value }
{else}
{assign var="value" value=$fields.adress_c.value }
{/if}  
<input type='text' name='{$fields.adress_c.name}' 
id='{$fields.adress_c.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
</table>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_CONTACT_INFORMATION").style.display='none';</script>
{/if}
<div id="detailpanel_2" class="{$def.templateMeta.panelClass|default:'edit view edit508'}">
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table width="100%" border="0" cellspacing="1" cellpadding="0"  id='LBL_EDITVIEW_PANEL1'  class="edit view panelContainer">
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='passport_num_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PASSPORT_NUM' module='part_participants'}{/capture}
{$label|strip_semicolon}:
<span class="required">*</span>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.passport_num.value) <= 0}
{assign var="value" value=$fields.passport_num.default_value }
{else}
{assign var="value" value=$fields.passport_num.value }
{/if}  
<input type='text' name='{$fields.passport_num.name}' 
id='{$fields.passport_num.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
<td valign="top" id='assigned_user_name_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_ASSIGNED_TO_NAME' module='part_participants'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<input type="text" name="{$fields.assigned_user_name.name}" class="sqsEnabled" tabindex="0" id="{$fields.assigned_user_name.name}" size="" value="{$fields.assigned_user_name.value}" title='' autocomplete="off"  	 >
<input type="hidden" name="{$fields.assigned_user_name.id_name}" 
id="{$fields.assigned_user_name.id_name}" 
value="{$fields.assigned_user_id.value}">
<span class="id-ff multiple">
<button type="button" name="btn_{$fields.assigned_user_name.name}" id="btn_{$fields.assigned_user_name.name}" tabindex="0" title="{sugar_translate label="LBL_ACCESSKEY_SELECT_USERS_TITLE"}" class="button firstChild" value="{sugar_translate label="LBL_ACCESSKEY_SELECT_USERS_LABEL"}"
onclick='open_popup(
"{$fields.assigned_user_name.module}", 
600, 
400, 
"", 
true, 
false, 
{literal}{"call_back_function":"set_return","form_name":"form_SubpanelQuickCreate_part_participants","field_to_name_array":{"id":"assigned_user_id","user_name":"assigned_user_name"}}{/literal}, 
"single", 
true
);' ><img src="{sugar_getimagepath file="id-ff-select.png"}"></button><button type="button" name="btn_clr_{$fields.assigned_user_name.name}" id="btn_clr_{$fields.assigned_user_name.name}" tabindex="0" title="{sugar_translate label="LBL_ACCESSKEY_CLEAR_USERS_TITLE"}"  class="button lastChild"
onclick="SUGAR.clearRelateField(this.form, '{$fields.assigned_user_name.name}', '{$fields.assigned_user_name.id_name}');"  value="{sugar_translate label="LBL_ACCESSKEY_CLEAR_USERS_LABEL"}" ><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
<script type="text/javascript">
SUGAR.util.doWhen(
		"typeof(sqs_objects) != 'undefined' && typeof(sqs_objects['{$form_name}_{$fields.assigned_user_name.name}']) != 'undefined'",
		enableQS
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='passport_who_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PASSPORT_WHO' module='part_participants'}{/capture}
{$label|strip_semicolon}:
<span class="required">*</span>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}

{if strlen($fields.passport_who.value) <= 0}
{assign var="value" value=$fields.passport_who.default_value }
{else}
{assign var="value" value=$fields.passport_who.value }
{/if}  
<input type='text' name='{$fields.passport_who.name}' 
id='{$fields.passport_who.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='passport_date_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PASSPORT_DATE' module='part_participants'}{/capture}
{$label|strip_semicolon}:
<span class="required">*</span>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.passport_date.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.passport_date.name}" id="{$fields.passport_date.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.passport_date.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.passport_date.name}",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.passport_date.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
<td valign="top" id='passport_valid_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PASSPORT_VALID' module='part_participants'}{/capture}
{$label|strip_semicolon}:
<span class="required">*</span>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.passport_valid.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.passport_valid.name}" id="{$fields.passport_valid.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.passport_valid.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.passport_valid.name}",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.passport_valid.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
</table>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_EDITVIEW_PANEL1").style.display='none';</script>
{/if}
</div></div>

<script language="javascript">
    var _form_id = '{$form_id}';
    {literal}
    SUGAR.util.doWhen(function(){
        _form_id = (_form_id == '') ? 'EditView' : _form_id;
        return document.getElementById(_form_id) != null;
    }, SUGAR.themes.actionMenu);
    {/literal}
</script>
{assign var='place' value="_FOOTER"} <!-- to be used for id for buttons with custom code in def files-->
<div class="buttons">
<div class="action_buttons">{if $bean->aclAccess("save")}<input title="{$APP.LBL_SAVE_BUTTON_TITLE}"  class="button" onclick="var _form = document.getElementById('form_SubpanelQuickCreate_part_participants'); disableOnUnloadEditView(); _form.action.value='Save';if(check_form('form_SubpanelQuickCreate_part_participants'))return SUGAR.subpanelUtils.inlineSave(_form.id, 'part_participants_subpanel_save_button');return false;" type="submit" name="part_participants_subpanel_save_button" id="part_participants_subpanel_save_button" value="{$APP.LBL_SAVE_BUTTON_LABEL}">{/if}  <input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" class="button" onclick="return SUGAR.subpanelUtils.cancelCreate($(this).attr('id'));return false;" type="submit" name="part_participants_subpanel_cancel_button" id="part_participants_subpanel_cancel_button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}">  <input title="{$APP.LBL_FULL_FORM_BUTTON_TITLE}" class="button" onclick="var _form = document.getElementById('form_SubpanelQuickCreate_part_participants'); disableOnUnloadEditView(_form); _form.return_action.value='DetailView'; _form.action.value='EditView'; if(typeof(_form.to_pdf)!='undefined') _form.to_pdf.value='0';" type="submit" name="part_participants_subpanel_full_form_button" id="part_participants_subpanel_full_form_button" value="{$APP.LBL_FULL_FORM_BUTTON_LABEL}"> <input type="hidden" name="full_form" value="full_form"> {if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=part_participants", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}<div class="clear"></div></div>
</div>
</form>
{$set_focus_block}
<script>SUGAR.util.doWhen("document.getElementById('EditView') != null",
function(){ldelim}SUGAR.util.buildAccessKeyLabels();{rdelim});
</script><script type="text/javascript">
YAHOO.util.Event.onContentReady("form_SubpanelQuickCreate_part_participants",
    function () {ldelim} initEditView(document.forms.form_SubpanelQuickCreate_part_participants) {rdelim});
//window.setTimeout(, 100);
window.onbeforeunload = function () {ldelim} return onUnloadEditView(); {rdelim};
// bug 55468 -- IE is too aggressive with onUnload event
if ($.browser.msie) {ldelim}
$(document).ready(function() {ldelim}
    $(".collapseLink,.expandLink").click(function (e) {ldelim} e.preventDefault(); {rdelim});
  {rdelim});
{rdelim}
</script>{literal}
<script type="text/javascript">
addForm('form_SubpanelQuickCreate_part_participants');addToValidate('form_SubpanelQuickCreate_part_participants', 'name', 'name', false,'{/literal}{sugar_translate label='LBL_NAME' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'date_entered_date', 'date', false,'Дата создания' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'date_modified_date', 'date', false,'Дата изменения' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'modified_user_id', 'assigned_user_name', false,'{/literal}{sugar_translate label='LBL_MODIFIED' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'modified_by_name', 'relate', false,'{/literal}{sugar_translate label='LBL_MODIFIED_NAME' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'created_by', 'assigned_user_name', false,'{/literal}{sugar_translate label='LBL_CREATED' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'created_by_name', 'relate', false,'{/literal}{sugar_translate label='LBL_CREATED' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'description', 'text', false,'{/literal}{sugar_translate label='LBL_DESCRIPTION' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'deleted', 'bool', false,'{/literal}{sugar_translate label='LBL_DELETED' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'assigned_user_id', 'relate', false,'{/literal}{sugar_translate label='LBL_ASSIGNED_TO_ID' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'assigned_user_name', 'relate', false,'{/literal}{sugar_translate label='LBL_ASSIGNED_TO_NAME' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'salutation', 'enum', false,'{/literal}{sugar_translate label='LBL_SALUTATION' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'first_name', 'varchar', false,'{/literal}{sugar_translate label='LBL_FIRST_NAME' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'last_name', 'varchar', true,'{/literal}{sugar_translate label='LBL_LAST_NAME' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'full_name', 'fullname', false,'{/literal}{sugar_translate label='LBL_NAME' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'title', 'varchar', false,'{/literal}{sugar_translate label='LBL_TITLE' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'department', 'varchar', false,'{/literal}{sugar_translate label='LBL_DEPARTMENT' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'do_not_call', 'bool', false,'{/literal}{sugar_translate label='LBL_DO_NOT_CALL' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'phone_home', 'phone', false,'{/literal}{sugar_translate label='LBL_HOME_PHONE' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'email', 'email', false,'{/literal}{sugar_translate label='LBL_ANY_EMAIL' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'phone_mobile', 'phone', false,'{/literal}{sugar_translate label='LBL_MOBILE_PHONE' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'phone_work', 'phone', false,'{/literal}{sugar_translate label='LBL_OFFICE_PHONE' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'phone_other', 'phone', false,'{/literal}{sugar_translate label='LBL_OTHER_PHONE' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'phone_fax', 'phone', false,'{/literal}{sugar_translate label='LBL_FAX_PHONE' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'email1', 'varchar', false,'{/literal}{sugar_translate label='LBL_EMAIL_ADDRESS' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'email2', 'varchar', false,'{/literal}{sugar_translate label='LBL_OTHER_EMAIL_ADDRESS' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'invalid_email', 'bool', false,'{/literal}{sugar_translate label='LBL_INVALID_EMAIL' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'email_opt_out', 'bool', false,'{/literal}{sugar_translate label='LBL_EMAIL_OPT_OUT' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'primary_address_street', 'varchar', false,'{/literal}{sugar_translate label='LBL_PRIMARY_ADDRESS_STREET' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'primary_address_street_2', 'varchar', false,'{/literal}{sugar_translate label='LBL_PRIMARY_ADDRESS_STREET_2' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'primary_address_street_3', 'varchar', false,'{/literal}{sugar_translate label='LBL_PRIMARY_ADDRESS_STREET_3' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'primary_address_city', 'varchar', false,'{/literal}{sugar_translate label='LBL_PRIMARY_ADDRESS_CITY' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'primary_address_state', 'varchar', false,'{/literal}{sugar_translate label='LBL_PRIMARY_ADDRESS_STATE' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'primary_address_postalcode', 'varchar', false,'{/literal}{sugar_translate label='LBL_PRIMARY_ADDRESS_POSTALCODE' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'primary_address_country', 'varchar', false,'{/literal}{sugar_translate label='LBL_PRIMARY_ADDRESS_COUNTRY' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'alt_address_street', 'varchar', false,'{/literal}{sugar_translate label='LBL_ALT_ADDRESS_STREET' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'alt_address_street_2', 'varchar', false,'{/literal}{sugar_translate label='LBL_ALT_ADDRESS_STREET_2' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'alt_address_street_3', 'varchar', false,'{/literal}{sugar_translate label='LBL_ALT_ADDRESS_STREET_3' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'alt_address_city', 'varchar', false,'{/literal}{sugar_translate label='LBL_ALT_ADDRESS_CITY' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'alt_address_state', 'varchar', false,'{/literal}{sugar_translate label='LBL_ALT_ADDRESS_STATE' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'alt_address_postalcode', 'varchar', false,'{/literal}{sugar_translate label='LBL_ALT_ADDRESS_POSTALCODE' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'alt_address_country', 'varchar', false,'{/literal}{sugar_translate label='LBL_ALT_ADDRESS_COUNTRY' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'assistant', 'varchar', false,'{/literal}{sugar_translate label='LBL_ASSISTANT' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'assistant_phone', 'phone', false,'{/literal}{sugar_translate label='LBL_ASSISTANT_PHONE' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'birthday', 'date', true,'{/literal}{sugar_translate label='LBL_BIRTHDAY' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'fnamerus', 'varchar', true,'{/literal}{sugar_translate label='LBL_FNAMERUS' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'snamerus', 'varchar', true,'{/literal}{sugar_translate label='LBL_SNAMERUS' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'mnamerus', 'varchar', true,'{/literal}{sugar_translate label='LBL_MNAMERUS' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'passport_num', 'varchar', true,'{/literal}{sugar_translate label='LBL_PASSPORT_NUM' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'passport_date', 'date', true,'{/literal}{sugar_translate label='LBL_PASSPORT_DATE' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'passport_who', 'varchar', true,'{/literal}{sugar_translate label='LBL_PASSPORT_WHO' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'passport_valid', 'date', true,'{/literal}{sugar_translate label='LBL_PASSPORT_VALID' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'part_participants_opportunities_name', 'relate', false,'{/literal}{sugar_translate label='LBL_PART_PARTICIPANTS_OPPORTUNITIES_FROM_OPPORTUNITIES_TITLE' module='part_participants' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_part_participants', 'adress_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_ADRESS' module='part_participants' for_js=true}{literal}' );
addToValidateBinaryDependency('form_SubpanelQuickCreate_part_participants', 'assigned_user_name', 'alpha', false,'{/literal}{sugar_translate label='ERR_SQS_NO_MATCH_FIELD' module='part_participants' for_js=true}{literal}: {/literal}{sugar_translate label='LBL_ASSIGNED_TO' module='part_participants' for_js=true}{literal}', 'assigned_user_id' );
</script><script language="javascript">if(typeof sqs_objects == 'undefined'){var sqs_objects = new Array;}sqs_objects['form_SubpanelQuickCreate_part_participants_assigned_user_name']={"form":"form_SubpanelQuickCreate_part_participants","method":"get_user_array","field_list":["user_name","id"],"populate_list":["assigned_user_name","assigned_user_id"],"required_list":["assigned_user_id"],"conditions":[{"name":"user_name","op":"like_custom","end":"%","value":""}],"limit":"30","no_match_text":"\u041d\u0435 \u0432\u044b\u0431\u0440\u0430\u043d\u043e"};</script>{/literal}
