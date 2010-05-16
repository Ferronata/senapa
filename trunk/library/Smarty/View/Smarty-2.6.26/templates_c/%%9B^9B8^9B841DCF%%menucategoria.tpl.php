<?php /* Smarty version 2.6.26, created on 2010-03-16 14:33:03
         compiled from admin/menucategoria.tpl */ ?>

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/sgaPhp/admin/MenuCategoria', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>MenuCategoria</h1>
				<sub>Gerencimento - MenuCategoria</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="<?php echo $this->_tpl_vars['menu_categoria']->id; ?>
" />
					<div class="line">
						<label class="label required" for="nome">nome</label>
						<div class="innerLine">
							<input type="text" class="key input grande" id="nome" name="nome" maxlength="250" value="<?php echo $this->_tpl_vars['menu_categoria']->nome; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="ordem">ordem</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="ordem" name="ordem" onkeypress="mascara(this,soNumeros)" maxlength="10" value="<?php echo $this->_tpl_vars['menu_categoria']->ordem; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="params">params</label>
						<div class="innerLine">
							<textarea class="input normal" id="params" name="params"><?php echo $this->_tpl_vars['menu_categoria']->params; ?>
</textarea>
						</div>
					</div>
					<div class="line">
						<label class="label" for="status">status</label>
						<div class="innerLine">
							<input type="checkbox" class="input" id="status" name="status"  value="1" <?php if ($this->_tpl_vars['menu_categoria']->status): ?>checked="checked"<?php endif; ?> />
						</div>
					</div>
				</div>
				<div class="controle">
					<input type="submit" class="button save" value="Salvar" />
					<input type="button" class="button back" value="Sair" onclick="voltarForm();" />
				</div>
			</form>
		</div>
	</div>
</center>