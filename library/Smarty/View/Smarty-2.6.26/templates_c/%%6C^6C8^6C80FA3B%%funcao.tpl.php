<?php /* Smarty version 2.6.26, created on 2010-03-16 14:55:25
         compiled from admin/funcao.tpl */ ?>

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/sgaPhp/admin/Funcao', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>Funcao</h1>
				<sub>Gerencimento - Funcao</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="<?php echo $this->_tpl_vars['funcao']->id; ?>
" />
					<div class="line">
						<label class="label required" for="cargo_id">cargo_id</label>
						<div class="innerLine">
							<select name=cargo_id class="key input pequeno">
								<?php $_from = $this->_tpl_vars['cargo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['funcao']->cargo_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
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
							<input type="text" class="key input medio" id="nome" name="nome" maxlength="150" value="<?php echo $this->_tpl_vars['funcao']->nome; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="descricao">descricao</label>
						<div class="innerLine">
							<textarea class="input normal" id="descricao" name="descricao"><?php echo $this->_tpl_vars['funcao']->descricao; ?>
</textarea>
						</div>
					</div>
					<div class="line">
						<label class="label" for="status">status</label>
						<div class="innerLine">
							<input type="checkbox" class="input" id="status" name="status"  value="1" <?php if ($this->_tpl_vars['funcao']->status): ?>checked="checked"<?php endif; ?> />
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