<?php /* Smarty version 2.6.26, created on 2010-03-16 02:47:28
         compiled from admin/livrolocar.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_data', 'admin/livrolocar.tpl', 49, false),)), $this); ?>

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/sgaPhp/admin/LivroLocar', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>LivroLocar</h1>
				<sub>Gerencimento - LivroLocar</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="<?php echo $this->_tpl_vars['livro_locar']->id; ?>
" />
					<div class="line">
						<label class="label required" for="pessoa_fisica_pessoa_id">pessoa_fisica_pessoa_id</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="pessoa_fisica_pessoa_id" name="pessoa_fisica_pessoa_id" onkeypress="mascara(this,soNumeros)" maxlength="10" value="<?php echo $this->_tpl_vars['livro_locar']->pessoa_fisica_pessoa_id; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="pessoa_fisica_id">pessoa_fisica_id</label>
						<div class="innerLine">
							<select name=pessoa_fisica_id class="key input pequeno">
								<?php $_from = $this->_tpl_vars['pessoa_fisica']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['livro_locar']->pessoa_fisica_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
</option>
								<?php endforeach; else: ?>
									<option>Nenhum Registro</option>
								<?php endif; unset($_from); ?>
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="livro_id">livro_id</label>
						<div class="innerLine">
							<select name=livro_id class="key input pequeno">
								<?php $_from = $this->_tpl_vars['livro']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['livro_locar']->livro_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
</option>
								<?php endforeach; else: ?>
									<option>Nenhum Registro</option>
								<?php endif; unset($_from); ?>
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label" for="dt_locacao">dt_locacao</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="dt_locacao" name="dt_locacao" onkeypress="mascara(this,dataHora)" maxlength="19" value="<?php echo smarty_function_html_data(array('values' => $this->_tpl_vars['livro_locar']->dt_locacao), $this);?>
" />
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