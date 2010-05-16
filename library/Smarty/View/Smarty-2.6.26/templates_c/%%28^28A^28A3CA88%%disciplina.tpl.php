<?php /* Smarty version 2.6.26, created on 2010-03-15 18:50:41
         compiled from admin/disciplina.tpl */ ?>

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/sgaPhp/admin/Disciplina', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>Disciplina</h1>
				<sub>Gerencimento - Disciplina</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="<?php echo $this->_tpl_vars['disciplina']->id; ?>
" />
					
					<div class="line">
						<label class="label required" for="curso_id">Escola</label>
						<div class="innerLine">
							<select name=Escola class="key input pequeno" onchange="rerender(this,[<?php echo 'Curso'; ?>
])">
								<option>Selecione</option>
								<?php $_from = $this->_tpl_vars['escolas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['escola']->id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
</option>
								<?php endforeach; else: ?>
									<option>Nenhum Registro</option>
								<?php endif; unset($_from); ?>
							</select>
						</div>
					</div>
					
					<div class="line">
						<label class="label required" for="curso_id">curso_id</label>
						<div class="innerLine">
							<select id='Curso' name=Curso class="key input pequeno">
								<?php $_from = $this->_tpl_vars['curso']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['disciplina']->curso_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
</option>
								<?php endforeach; else: ?>
									<option>Nenhum Registro</option>
								<?php endif; unset($_from); ?>
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="codigo">codigo</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="codigo" name="codigo" onkeypress="mascara(this,soNumeros)" maxlength="10" value="<?php echo $this->_tpl_vars['disciplina']->codigo; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="nome">nome</label>
						<div class="innerLine">
							<input type="text" class="key input grande" id="nome" name="nome" maxlength="250" value="<?php echo $this->_tpl_vars['disciplina']->nome; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="status">status</label>
						<div class="innerLine">
							<input type="checkbox" class="input" id="status" name="status"  value="1" <?php if ($this->_tpl_vars['disciplina']->status): ?>checked="checked"<?php endif; ?> />
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