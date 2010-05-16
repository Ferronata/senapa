<?php /* Smarty version 2.6.26, created on 2010-03-14 02:05:02
         compiled from admin/equipamento.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_data', 'admin/equipamento.tpl', 61, false),)), $this); ?>

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/sgaPhp/admin/Equipamento', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>Equipamento</h1>
				<sub>Gerencimento - Equipamento</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="<?php echo $this->_tpl_vars['equipamento']->id; ?>
" />
					
					<div class="line">
						<label class="label required" for="Escola">Escola</label>
						<div class="innerLine">
							<select name=Escola class="key input pequeno" onchange="rerender(this,[<?php echo 'EquipamentoTipo'; ?>
])">
								<option>Selecione</option>
								<?php $_from = $this->_tpl_vars['escolas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['escola']->id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
</option>
								<?php endforeach; endif; unset($_from); ?>
							</select>
						</div>
					</div>
					
					<div class="line">
						<label class="label required" for="EquipamentoTipo">equipamento_tipo_id</label>
						<div class="innerLine">
							<select id="EquipamentoTipo" name=EquipamentoTipo class="key input pequeno">
								<option>Nenhum Registro</option>
								<?php $_from = $this->_tpl_vars['equipamento_tipo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['equipamento']->equipamento_tipo_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
</option>
								<?php endforeach; endif; unset($_from); ?>
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="nome">nome</label>
						<div class="innerLine">
							<input type="text" class="key input grande" id="nome" name="nome" maxlength="250" value="<?php echo $this->_tpl_vars['equipamento']->nome; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="patrimonio">patrimonio</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="patrimonio" name="patrimonio" maxlength="100" value="<?php echo $this->_tpl_vars['equipamento']->patrimonio; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="modelo">modelo</label>
						<div class="innerLine">
							<input type="text" class="input medio" id="modelo" name="modelo" maxlength="150" value="<?php echo $this->_tpl_vars['equipamento']->modelo; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="dt_aquisicao">dt_aquisicao</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="dt_aquisicao" name="dt_aquisicao" onkeypress="mascara(this,data)" maxlength="10" value="<?php echo smarty_function_html_data(array('values' => $this->_tpl_vars['equipamento']->dt_aquisicao), $this);?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="status">status</label>
						<div class="innerLine">
							<input type="checkbox" class="input" id="status" name="status"  value="1" <?php if ($this->_tpl_vars['equipamento']->status): ?>checked="checked"<?php endif; ?> />
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