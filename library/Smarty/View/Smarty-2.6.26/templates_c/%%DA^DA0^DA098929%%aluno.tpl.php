<?php /* Smarty version 2.6.26, created on 2010-05-15 16:59:33
         compiled from admin/aluno.tpl */ ?>

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/sgaPhp/admin/Aluno', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>Aluno</h1>
				<sub>Gerencimento - Aluno</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="<?php echo $this->_tpl_vars['aluno']->id; ?>
" />
					<div class="line">
						<label class="label required" for="pessoa_escola_id">pessoa_escola_id</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="pessoa_escola_id" name="pessoa_escola_id" onkeypress="mascara(this,soNumeros)" maxlength="10" value="<?php echo $this->_tpl_vars['aluno']->pessoa_escola_id; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="pessoa_escola_pessoa_fisica_id">pessoa_escola_pessoa_fisica_id</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="pessoa_escola_pessoa_fisica_id" name="pessoa_escola_pessoa_fisica_id" onkeypress="mascara(this,soNumeros)" maxlength="10" value="<?php echo $this->_tpl_vars['aluno']->pessoa_escola_pessoa_fisica_id; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="pessoa_escola_pessoa_fisica_pessoa_id">pessoa_escola_pessoa_fisica_pessoa_id</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="pessoa_escola_pessoa_fisica_pessoa_id" name="pessoa_escola_pessoa_fisica_pessoa_id" onkeypress="mascara(this,soNumeros)" maxlength="10" value="<?php echo $this->_tpl_vars['aluno']->pessoa_escola_pessoa_fisica_pessoa_id; ?>
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