<?php /* Smarty version 2.6.26, created on 2010-03-15 18:32:46
         compiled from admin/turno.tpl */ ?>

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/sgaPhp/admin/Turno', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>Turno</h1>
				<sub>Gerencimento - Turno</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="<?php echo $this->_tpl_vars['turno']->id; ?>
" />
					<input type="hidden" id="escola_pessoa_juridica_id" name="escola_pessoa_juridica_id" value="<?php echo $this->_tpl_vars['turno']->escola_pessoa_juridica_id; ?>
" />
					<input type="hidden" id="escola_pessoa_juridica_pessoa_id" name="escola_pessoa_juridica_pessoa_id" value="<?php echo $this->_tpl_vars['turno']->escola_pessoa_juridica_pessoa_id; ?>
" />

					<div class="line">
						<label class="label required" for="escola_id">escola_id</label>
						<div class="innerLine">
							<select name=escola_id class="key input pequeno">
								<?php $_from = $this->_tpl_vars['escolas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['turno']->escola_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
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
							<input type="text" class="key input grande" id="nome" name="nome" maxlength="250" value="<?php echo $this->_tpl_vars['turno']->nome; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="hr_entrada">hr_entrada</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="hr_entrada" name="hr_entrada" onkeypress="mascara(this,hora)" maxlength="5" value="<?php echo $this->_tpl_vars['turno']->hr_entrada; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="hr_saida">hr_saida</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="hr_saida" name="hr_saida" onkeypress="mascara(this,hora)" maxlength="5" value="<?php echo $this->_tpl_vars['turno']->hr_saida; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="hr_intervalo_ini">hr_intervalo_ini</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="hr_intervalo_ini" name="hr_intervalo_ini" onkeypress="mascara(this,hora)" maxlength="5" value="<?php echo $this->_tpl_vars['turno']->hr_intervalo_ini; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="hr_intervalo_fim">hr_intervalo_fim</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="hr_intervalo_fim" name="hr_intervalo_fim" onkeypress="mascara(this,hora)" maxlength="5" value="<?php echo $this->_tpl_vars['turno']->hr_intervalo_fim; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="status">status</label>
						<div class="innerLine">
							<input type="checkbox" class="input" id="status" name="status"  value="1" <?php if ($this->_tpl_vars['turno']->status): ?>checked="checked"<?php endif; ?> />
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