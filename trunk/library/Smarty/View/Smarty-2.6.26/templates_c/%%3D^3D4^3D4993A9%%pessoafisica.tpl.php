<?php /* Smarty version 2.6.26, created on 2010-05-18 00:45:58
         compiled from pessoafisica/pessoafisica.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_data', 'pessoafisica/pessoafisica.tpl', 31, false),)), $this); ?>

<center>
	<div class="body">
		<div class="innerBody">
			<!--  <form id="form" name="form" method="post" action="javascript: enviarForm('/senapa/pessoafisica/PessoaFisica', 'form', 'save');" onsubmit="return(runAction(this))"> -->
			<form id="form" name="form" method="post" action="/senapa/pessoafisica/PessoaFisica" onsubmit="return(runAction(this))">
				<h1>PessoaFisica</h1>
				<sub>Gerencimento - PessoaFisica</sub>
				<div class="content">
					<div class="line">
						<label class="label required" for="pessoa_id">pessoa_id</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="pessoa_id" name="pessoa_id" onkeypress="mascara(this,soNumeros)" maxlength="10" value="<?php echo $this->_tpl_vars['pessoa_fisica']->getPessoaId(); ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="cpf">cpf</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="cpf" name="cpf" onkeypress="mascara(this,cpf)" maxlength="11" value="<?php echo $this->_tpl_vars['pessoa_fisica']->getCpf(); ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="data_nascimento">data_nascimento</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="data_nascimento" name="data_nascimento" onkeypress="mascara(this,data)" maxlength="10" value="<?php echo smarty_function_html_data(array('values' => $this->_tpl_vars['pessoa_fisica']->getDataNascimento()), $this);?>
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