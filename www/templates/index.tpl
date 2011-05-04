{*
/**
 * 
 * Index Template 
 * 
 * @version $Id: index.tpl 155 2008-01-13 20:01:44Z mimait04 $
 * @copyright 
 * @author 
 *  
 */
*}
<?xml version="1.0" encoding="{$HTMLOUT.ENCODING}"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
{include file='header.tpl'}
</head>
<body>
{foreach from=$HTMLOUT.SCRIPTURLS item=SCRIPT}
	<script type="text/javascript" src="{$SCRIPT.href}"></script>
{/foreach}

<script type="text/javascript">
<!--
{*//if (!_c) document.write('<div class="lhcl_browserwarning">You are using a browser that is not fully supported. Some features may not work too well, but you are welcome to have a look around.<\/div>');*}
-->
</script>
<noscript>
<div class="lhcl_browserwarning">You are using a browser that is not fully supported. Some features may not work too well, but you are welcome to have a look around.</div>
</noscript>
{*
#############################################
# Top navigation bar
*}
{if $HTMLOUT.TPLS.TOPNAV}
<table id="lhid_topnav">
<tr>
   <td valign="top" style="padding-top: 1em;"><a href="{$STRINGS.TPL_LOGO_URL_HREF}"><img alt="{$STRINGS.TPL_LOGO_URL_ALT}" id="lhid_logo" src="img/mksurveyweblogo-en_US.gif"/></a></td>
   <td>
   {if $APP_DATA.IS_ADMIN}
   {include file=$HTMLOUT.TPLS.TOPNAV}
   {/if}
   </td>
</tr>
</table>
{/if}
{*
#############################################
# Navigations bar
*}
{if $HTMLOUT.TPLS.NAVBAR}
<table width="100%" id="lhid_navbar_nz">
<tr>
<td>
	{include file=$HTMLOUT.TPLS.NAVBAR}
</td>
</tr>
</table>
{/if}
{*
#
#############################################
*}

{if $MESSAGE}
<div style="border: 1px solid #0000ff; 
			padding: 5px; 
			background-color: #FFFF99; 
			margin:2px 10px 2px 10px">
{$MESSAGE}     
</div>
{/if}
{*
#############################################
# Body
*}
{if $HTMLOUT.TPLS.BODY}
{include file=$HTMLOUT.TPLS.BODY}
<div class="lhcl_body">
<table>
<tr>
{*
#############################################
# Leftbox
*}
{if $HTMLOUT.TPLS.LEFTBOX}
<td id="lhid_leftbox">
{include file=$HTMLOUT.TPLS.LEFTBOX}
</td>
{/if}
{*
#
#############################################
*}
{*
#############################################
# Rightbox
*}
{if $HTMLOUT.TPLS.RIGHTBOX}
<td id="lhid_rightbox">
{include file=$HTMLOUT.TPLS.RIGHTBOX}
</td>
{/if}
{*
#
#############################################
*}
</tr>
</table>
</div>
{/if}
{*
#
#############################################
*}

{if $HTMLOUT.TPLS.FOOTER}
<div id="lhid_footer">
{include file=$HTMLOUT.TPLS.FOOTER}
</div>
{/if}
<div class="lhcl_cover" id="lhcl_cover" style="display:none;"/>
</body>
</html>