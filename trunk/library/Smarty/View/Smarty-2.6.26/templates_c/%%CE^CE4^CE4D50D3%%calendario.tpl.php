<?php /* Smarty version 2.6.26, created on 2010-03-13 23:29:41
         compiled from admin/calendario.tpl */ ?>

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/sgaPhp/admin/Calendario', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>Calendario</h1>
				<sub>Gerencimento - Calendario</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="<?php echo $this->_tpl_vars['calendario']->id; ?>
" />
					
					<div class="line">
						<label class="label required" for="Escola">Escola</label>
						<div class="innerLine">
							<select name=Escola class="key input pequeno" onchange="rerender(this,[<?php echo 'AnoLetivo'; ?>
],'ano DESC','ano')">
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
						<label class="label required" for="AnoLetivo">ano_letivo_id</label>
						<div class="innerLine">
							<select id="AnoLetivo" name=AnoLetivo class="key input pequeno">
								<option>Selecione</option>
								<?php $_from = $this->_tpl_vars['ano_letivo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['calendario']->ano_letivo_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['ano']; ?>
</option>
								<?php endforeach; endif; unset($_from); ?>
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="calendario_tipo_id">calendario_tipo_id</label>
						<div class="innerLine">
							<select name=calendario_tipo_id class="key input pequeno">
								<?php $_from = $this->_tpl_vars['calendario_tipo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['calendario']->calendario_tipo_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
</option>
								<?php endforeach; else: ?>
									<option>Nenhum Registro</option>
								<?php endif; unset($_from); ?>
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="dt_atividade">dt_atividade</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="dt_atividade" name="dt_atividade" onkeypress="mascara(this,data)" maxlength="10" value="<?php echo $this->_tpl_vars['calendario']->dt_atividade; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="descricao">descricao</label>
						<div class="innerLine">
							<textarea class="key input normal" id="descricao" name="descricao"><?php echo $this->_tpl_vars['calendario']->descricao; ?>
</textarea>
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