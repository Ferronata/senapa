<?php /* Smarty version 2.6.26, created on 2010-03-13 21:56:34
         compiled from admin/anoletivo.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_data', 'admin/anoletivo.tpl', 40, false),)), $this); ?>

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/sgaPhp/admin/AnoLetivo', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>AnoLetivo</h1>
				<sub>Gerencimento - AnoLetivo</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="<?php echo $this->_tpl_vars['ano_letivo']->id; ?>
" />
					<input type="hidden" id="escola_pessoa_juridica_id" name="escola_pessoa_juridica_id" value="<?php echo $this->_tpl_vars['ano_letivo']->escola_pessoa_juridica_id; ?>
" />
					<input type="hidden" id="escola_pessoa_juridica_pessoa_id" name="escola_pessoa_juridica_pessoa_id" value="<?php echo $this->_tpl_vars['ano_letivo']->escola_pessoa_juridica_pessoa_id; ?>
" />

					<div class="line">
						<label class="label required" for="escola_id">escola_id</label>
						<div class="innerLine">
							<select name=escola_id class="key input pequeno">
								<?php $_from = $this->_tpl_vars['escolas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['ano_letivo']->escola_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
</option>
								<?php endforeach; else: ?>
									<option>Nenhum Registro</option>
								<?php endif; unset($_from); ?>
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="ano">ano</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="ano" name="ano" onkeypress="mascara(this,soNumeros)" maxlength="4" value="<?php echo $this->_tpl_vars['ano_letivo']->ano; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="dt_inicio">dt_inicio</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="dt_inicio" name="dt_inicio" onkeypress="mascara(this,data)" maxlength="10" value="<?php echo smarty_function_html_data(array('values' => $this->_tpl_vars['ano_letivo']->dt_inicio), $this);?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="dt_fim">dt_fim</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="dt_fim" name="dt_fim" onkeypress="mascara(this,data)" maxlength="10" value="<?php echo smarty_function_html_data(array('values' => $this->_tpl_vars['ano_letivo']->dt_fim), $this);?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="status">status</label>
						<div class="innerLine">
							<input type="checkbox" class="input" id="status" name="status"  value="1" <?php if ($this->_tpl_vars['ano_letivo']->status): ?>checked="checked"<?php endif; ?> />
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