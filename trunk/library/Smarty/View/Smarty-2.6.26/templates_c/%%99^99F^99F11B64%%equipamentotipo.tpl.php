<?php /* Smarty version 2.6.26, created on 2010-03-14 00:57:17
         compiled from admin/equipamentotipo.tpl */ ?>

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/sgaPhp/admin/EquipamentoTipo', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>EquipamentoTipo</h1>
				<sub>Gerencimento - EquipamentoTipo</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="<?php echo $this->_tpl_vars['equipamento_tipo']->id; ?>
" />
					<input type="hidden" id="escola_pessoa_juridica_id" name="escola_pessoa_juridica_id" value="<?php echo $this->_tpl_vars['equipamento_tipo']->escola_pessoa_juridica_id; ?>
" />
					<input type="hidden" id="escola_pessoa_juridica_pessoa_id" name="escola_pessoa_juridica_pessoa_id" value="<?php echo $this->_tpl_vars['equipamento_tipo']->escola_pessoa_juridica_pessoa_id; ?>
" />
					<div class="line">
						<label class="label required" for="escola_id">escola_id</label>
						<div class="innerLine">
							<select name=escola_id class="key input pequeno">
								<?php $_from = $this->_tpl_vars['escolas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['equipamento_tipo']->escola_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
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
							<input type="text" class="key input grande" id="nome" name="nome" maxlength="250" value="<?php echo $this->_tpl_vars['equipamento_tipo']->nome; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="status">status</label>
						<div class="innerLine">
							<input type="checkbox" class="input" id="status" name="status"  value="1" <?php if ($this->_tpl_vars['equipamento_tipo']->status): ?>checked="checked"<?php endif; ?> />
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