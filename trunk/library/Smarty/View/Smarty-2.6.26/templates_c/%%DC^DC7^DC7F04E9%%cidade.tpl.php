<?php /* Smarty version 2.6.26, created on 2010-03-12 03:31:52
         compiled from admin/cidade.tpl */ ?>

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/sgaPhp/admin/Cidade', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>Cidade</h1>
				<sub>Gerencimento - Cidade</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="<?php echo $this->_tpl_vars['cidade']->id; ?>
" />
					<div class="line">
						<label class="label required" for="uf_id">uf_id</label>
						<div class="innerLine">
							<select name=uf_id class="key input pequeno">
								<?php $_from = $this->_tpl_vars['uf']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['cidade']->uf_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
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
							<input type="text" class="key input pequeno" id="nome" name="nome" maxlength="250" value="<?php echo $this->_tpl_vars['cidade']->nome; ?>
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