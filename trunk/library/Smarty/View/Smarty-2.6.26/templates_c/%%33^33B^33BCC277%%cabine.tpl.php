<?php /* Smarty version 2.6.26, created on 2010-03-16 13:20:34
         compiled from admin/cabine.tpl */ ?>

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/sgaPhp/admin/Cabine', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>Cabine</h1>
				<sub>Gerencimento - Cabine</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="<?php echo $this->_tpl_vars['cabine']->id; ?>
" />
					
					<div class="line">
						<label class="label required" for="biblioteca_id">Escola</label>
						<div class="innerLine">
							<select name=Escola class="key input pequeno" onchange="rerender(this,[<?php echo 'Biblioteca'; ?>
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
						<label class="label required" for="Biblioteca">biblioteca_id</label>
						<div class="innerLine">
							<select id="Biblioteca" name=Biblioteca class="key input pequeno">
								<?php $_from = $this->_tpl_vars['biblioteca']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['cabine']->biblioteca_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
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
							<input type="text" class="key input medio" id="nome" name="nome" maxlength="150" value="<?php echo $this->_tpl_vars['cabine']->nome; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="num_mesa">num_mesa</label>
						<div class="innerLine">
							<input type="text" class="input pequeno" id="num_mesa" name="num_mesa" onkeypress="mascara(this,soNumeros)" maxlength="10" value="<?php echo $this->_tpl_vars['cabine']->num_mesa; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="num_cadeira">num_cadeira</label>
						<div class="innerLine">
							<input type="text" class="input pequeno" id="num_cadeira" name="num_cadeira" onkeypress="mascara(this,soNumeros)" maxlength="10" value="<?php echo $this->_tpl_vars['cabine']->num_cadeira; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="area">area</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="area" name="area" onkeypress="mascara(this,monetario)" value="<?php echo $this->_tpl_vars['cabine']->area; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="status">status</label>
						<div class="innerLine">
							<input type="checkbox" class="input" id="status" name="status"  value="1" <?php if ($this->_tpl_vars['cabine']->status): ?>checked="checked"<?php endif; ?> />
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