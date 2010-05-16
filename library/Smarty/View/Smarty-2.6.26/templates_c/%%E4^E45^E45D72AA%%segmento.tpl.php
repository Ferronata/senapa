<?php /* Smarty version 2.6.26, created on 2010-03-16 00:10:38
         compiled from admin/segmento.tpl */ ?>

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/sgaPhp/admin/Segmento', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>Segmento</h1>
				<sub>Gerencimento - Segmento</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="<?php echo $this->_tpl_vars['segmento']->id; ?>
" />
					
					<div class="line">
						<label class="label required" for="Biblioteca">Biblioteca</label>
						<div class="innerLine">
							<select name=Biblioteca class="key input pequeno" onchange="rerender(this,[<?php echo 'Midia'; ?>
])">
								<option>Selecione</option>
								<?php $_from = $this->_tpl_vars['bibliotecas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['biblioteca']->id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
</option>
								<?php endforeach; endif; unset($_from); ?>
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="Midia">Midia</label>
						<div class="innerLine">
							<select id="Midia" name=Midia class="key input pequeno">
								<?php $_from = $this->_tpl_vars['midia']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['segmento']->midia_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
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
							<input type="text" class="key input medio" id="nome" name="nome" maxlength="150" value="<?php echo $this->_tpl_vars['segmento']->nome; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="descricao">descricao</label>
						<div class="innerLine">
							<textarea class="key input normal" id="descricao" name="descricao"><?php echo $this->_tpl_vars['segmento']->descricao; ?>
</textarea>
						</div>
					</div>
					<div class="line">
						<label class="label" for="status">status</label>
						<div class="innerLine">
							<input type="checkbox" class="input" id="status" name="status"  value="1" <?php if ($this->_tpl_vars['segmento']->status): ?>checked="checked"<?php endif; ?> />
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