<?php /* Smarty version 2.6.26, created on 2010-03-12 04:10:01
         compiled from admin/logradouro.tpl */ ?>

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/sgaPhp/admin/Logradouro', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>Logradouro</h1>
				<sub>Gerencimento - Logradouro</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="<?php echo $this->_tpl_vars['logradouro']->id; ?>
" />
					<div class="line">
						<label class="label required" for="bairro_id">bairro_id</label>
						<div class="innerLine">
							<select name=bairro_id class="key input pequeno">
								<?php $_from = $this->_tpl_vars['bairro']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['logradouro']->bairro_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
</option>
								<?php endforeach; else: ?>
									<option>Nenhum Registro</option>
								<?php endif; unset($_from); ?>
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="cep">cep</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="cep" name="cep" onkeypress="mascara(this,cep_mask)" maxlength="9" value="<?php echo $this->_tpl_vars['logradouro']->cep; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="nome">nome</label>
						<div class="innerLine">
							<input type="text" class="key input grande" id="nome" name="nome" maxlength="250" value="<?php echo $this->_tpl_vars['logradouro']->nome; ?>
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