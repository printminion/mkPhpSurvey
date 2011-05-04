{*

	$Id: header.tpl 153 2008-01-13 18:56:21Z mimait04 $
	
*}
<meta http-equiv="Content-Type" content="text/html; charset={$HTMLOUT.ENCODING}" />
<title>{$HTMLOUT.TITLE}</title>
{foreach from=$HTMLOUT.METAS item=META}
   <meta name="{$META.name}" content="{$META.content}" />
{/foreach}
{if $HTMLOUT.SHORTCUT_ICON_URL}
   <link rel="shortcut icon" href="{$HTMLOUT.SHORTCUT_ICON_URL}" />
{/if}
{foreach from=$HTMLOUT.STYLEURLS key=k item=STYLE}
   {if $STYLE}
   <link href="{$STYLE.href}" {if $k == "PRINT_CSS"}media="print"{/if} rel="stylesheet" type="text/css" />
   {/if}
{/foreach}

{*foreach from=$HTMLOUT.SCRIPTURLS item=JAVASCRIPT}
   <script type="text/javascript" src="{$JAVASCRIPT.href}"></script>
{/foreach*}

   <base href="{$HTMLOUT.BASE_HREF}/" />

{$HTMLOUT.XAJAX}
