{include file="frame/head.tpl"}

<div class="mainbox">

{include file="frame/error.tpl"}

<form method="post" enctype="multipart/form-data">
<input type="hidden" name="{$bps.pkey}" value="{$item[{$bps.pkey}]}" />
{foreach $field as $k => $v}
    {if $v.edit && $v.type eq 'hidden'}
    <input type="hidden" name="{$k}" value="{$item[{$k}]}" />
    {/if}
{/foreach}
<table class="titem" >
{foreach $field as $k => $v}
	{if $v.edit && $v.type ne 'hidden'}
	<tr id="tr_{$k}">
		<td class="field">{$v.name}{if $v.validate.notempty !== 0 && $v.validate.notempty !== false} *{/if}</td>
		<td class="value">
            <div{if $v.type eq 'file'} style="width:400px"{/if}>
    		{include file="base/crud/item.tpl" from="edit"}
            </div>
		</td>
	</tr>
	{/if}
{/foreach}
	<tr>
		<td class="submit" colspan="2">
			{include file="base/form/submit.tpl" _submit_once="1"}
		</td>
	</tr>
</table>
</form>

</div>

{include file="frame/datetimepicker.tpl"}
{include file="frame/colorpicker.tpl"}
{include file="frame/editor.tpl"}
{if !$_no_foot}
{include file="frame/foot.tpl"}
{/if}