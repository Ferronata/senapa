<?php /* Smarty version 2.6.26, created on 2010-05-18 01:25:50
         compiled from admin/index.tpl */ ?>
<div class="border">
	<div id="top">
		<div id="logo">SGA - Sistema de Gerenciamento Acadêmico</div>
	</div>

	<div id="middle">
		<table class="table_menu" cellpadding="0" cellspacing="0" >
			<tr>
				<td class="td_menu">
					<div id="menu">
						<?php $_from = $this->_tpl_vars['categorias']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
						    <div class="openned">
								<a class="title-menu" href="#"><span class="title-menu_span"><?php echo $this->_tpl_vars['item']['nome']; ?>
</span></a>
								<?php $this->assign('counter', '0'); ?>
						    	<?php $_from = $this->_tpl_vars['item']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['menu']):
?>
						    		<div class="submenu <?php if ($this->_tpl_vars['counter']++ == 0): ?>openned<?php else: ?>closed<?php endif; ?>">
										<div class="submenu_bar">
											<a class="submenu_bar_a" href="<?php echo $this->_tpl_vars['menu'][0]->url; ?>
"><?php echo $this->_tpl_vars['menu']['nome']; ?>
</a>
											<div class="content_menu">
												<ul class="sub-menu">
												<?php $this->assign('counterInner', '0'); ?>
												<?php $_from = $this->_tpl_vars['menu']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['menuItem']):
?>
													<li<?php if ($this->_tpl_vars['counterInner']++%2 == 0): ?> class="highlight"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['menuItem']['url']; ?>
"><span><?php echo $this->_tpl_vars['menuItem']['nome']; ?>
</span></a></li>
												<?php endforeach; endif; unset($_from); ?>
												</ul>
											</div>
											<div class="footer_submenu_bar"></div>
										</div>										
									</div>
						    	<?php endforeach; endif; unset($_from); ?>
						    </div>
						<?php endforeach; else: ?>
							Não Há Itens de Menu Cadastrado
						<?php endif; unset($_from); ?>
					</div>
				</td>
				<!-- 
				<td class="td_work">
					<div id="work">
						Work
					</div>
				</td>
				 -->
				 <td class="td_work">
				 	<div id="work">
				 		<!-- <iframe id="myWork" name="myWork" src="http://www.google.com.br" height="*" marginheight="0" scrolling="no" frameborder="0"></iframe> -->
				 	</div>
				 </td>
			</tr>
		</table>
	</div>
	
	<div id="bottom">
		Rodape
	</div>
	
</div>