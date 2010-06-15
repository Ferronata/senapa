{include file='html/admin/header.tpl'}
	<div id="middle">
		<table class="table_menu" cellpadding="0" cellspacing="0" >
			<tr>
				<td class="td_menu">
					<div id="menu">
						{foreach item=item from=$categorias}
						    <div class="openned">
								<a class="title-menu" href="#"><span class="title-menu_span">{$item.nome}</span></a>
								{assign var="counter" value="0"}
						    	{foreach item=menu from=$item.data}
						    		<div class="submenu {if $counter++ == 0}openned{else}closed{/if}">
										<div class="submenu_bar">
											<a class="submenu_bar_a" href="{$menu[0]->url}">{$menu.nome}</a>
											<div class="content_menu">
												<ul class="sub-menu">
												{assign var="counterInner" value="0"}
												{foreach item=menuItem from=$menu.data}
													<li{if $counterInner++%2==0} class="highlight"{/if}><a href="{$menuItem.url}"><span>{$menuItem.nome}</span></a></li>
												{/foreach}
												</ul>
											</div>
											<div class="footer_submenu_bar"></div>
										</div>										
									</div>
						    	{/foreach}
						    </div>
						{foreachelse}
							Não Há Itens de Menu Cadastrado
						{/foreach}
					</div>
				</td>
				 <td class="td_work">
				 	<div id="work">
				 		<h1>{$saudacao}</h1>
				 		<hr />
				 	</div>
				 </td>
			</tr>
		</table>
	</div>
{include file='html/admin/footer.tpl'}