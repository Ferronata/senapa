<?php /* Smarty version 2.6.26, created on 2010-04-12 19:25:19
         compiled from admin/menuitem.tpl */ ?>

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/sgaPhp/admin/MenuItem', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>MenuItem</h1>
				<sub>Gerencimento - MenuItem</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="<?php echo $this->_tpl_vars['menu_item']->id; ?>
" />
					<div class="line">
						<label class="label" for="menu_item_id">menu_item_id</label>
						<div class="innerLine">
							<select name=menu_item_id class="input pequeno">
								<?php $_from = $this->_tpl_vars['menu_item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['menu_item']->menu_item_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
</option>
								<?php endforeach; else: ?>
									<option>Nenhum Registro</option>
								<?php endif; unset($_from); ?>
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="nome">nome</label>
						<div class="innerLine">
							<input type="text" class="key input grande" id="nome" name="nome" maxlength="250" value="<?php echo $this->_tpl_vars['menu_item']->nome; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="url">url</label>
						<div class="innerLine">
							<input type="text" class="key input grande" id="url" name="url" maxlength="250" value="<?php echo $this->_tpl_vars['menu_item']->url; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="ordem">ordem</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="ordem" name="ordem" onkeypress="mascara(this,soNumeros)" maxlength="10" value="<?php echo $this->_tpl_vars['menu_item']->ordem; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="params">params</label>
						<div class="innerLine">
							<textarea class="input normal" id="params" name="params"><?php echo $this->_tpl_vars['menu_item']->params; ?>
</textarea>
						</div>
					</div>
					<div class="line">
						<label class="label" for="status">status</label>
						<div class="innerLine">
							<input type="checkbox" class="input" id="status" name="status"  value="1" <?php if ($this->_tpl_vars['menu_item']->status): ?>checked="checked"<?php endif; ?> />
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