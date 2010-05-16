<link rel="stylesheet" type="text/css" href="{php}print BASE_URL;{/php}/public/css/classgen.css" />
<script type="text/javascript" src="{php}print BASE_URL;{/php}/public/js/lib/prototype-1.6.0.3.js"></script>
<script type="text/javascript" src="{php}print BASE_URL;{/php}/public/js/classgen.js"></script>
{* popup_init deve ser utilizada uma vez no topo da página 
{popup_init src="/javascripts/overlib.js"}
*}

{* cria um link com uma janela popup que aparece quando se passa o mouse sobre ele *}
<a href="http://www.google.com.br" {popup text="Meu  Teste"}>Google</a>

{* você pode usar html, links, etc no texto do popup *}
<A href="mypage.html" {popup sticky=true caption="mypage contents" text="<UL><LI>links<LI>pages<LI>images</UL>" snapx=10 snapy=10}>mypage</A>

<form id="form" name="form" method="post">
	<select id="tabelas" name="tabelas">
	{foreach name=lista from=$tabelas item=tabela}
		<option value="{$tabela.$db_name}">{$tabela.$db_name}</option>
	{foreachelse}
		<option value="-1">Não há tabela</option>
	{/foreach}
	</select>
	
	<input type="submit" value="Ok" />
	<input type="button" value="All Class" onClick="allTables()" />
	<input type="button" value="View All Class" onClick="allViewTables()" />
</form>
{if $msg}
<div style="background: #F5F5F5; border: 1px solid #999999; margin: 0; padding: 10px;">
	{$msg}
</div>
{/if}