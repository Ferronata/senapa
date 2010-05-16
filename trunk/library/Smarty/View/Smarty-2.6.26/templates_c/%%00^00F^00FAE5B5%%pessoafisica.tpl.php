<?php /* Smarty version 2.6.26, created on 2010-03-13 12:45:17
         compiled from admin/pessoafisica.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_aba', 'admin/pessoafisica.tpl', 15, false),array('function', 'html_data', 'admin/pessoafisica.tpl', 31, false),)), $this); ?>

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/sgaPhp/admin/PessoaFisica', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>Pessoa Física</h1>
				<sub>Gerencimento - Pessoa Física</sub>
				
				<div id="abas" class="divAba"><?php echo smarty_function_html_aba(array('value' => 'Dados','forid' => 'aba1','classe' => 'selected'), $this);?>
<?php echo smarty_function_html_aba(array('value' => 'Pessoa Física','forid' => 'aba2'), $this);?>
<?php echo smarty_function_html_aba(array('value' => 'Telefone','forid' => 'aba3'), $this);?>
<?php echo smarty_function_html_aba(array('value' => 'Endereço','forid' => 'aba4'), $this);?>
<?php echo smarty_function_html_aba(array('value' => 'Usuário','forid' => 'aba5'), $this);?>
</div>
				<div id="aba1"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/pessoa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
				<div id="aba2" style="display: none;">
					<div class="content">
						<input type="hidden" id="id" name="id" value="<?php echo $this->_tpl_vars['pessoa_fisica']->id; ?>
" />						
						<input type="hidden" id="pessoa_id" name="pessoa_id" maxlength="10" value="<?php echo $this->_tpl_vars['pessoa_fisica']->pessoa_id; ?>
" />
						
						<div class="line">
							<label class="label required" for="cpf">cpf</label>
							<div class="innerLine">
								<input type="text" class="key input normal" id="cpf" name="cpf" onkeypress="mascara(this,cpf)" maxlength="14" value="<?php echo $this->_tpl_vars['pessoa_fisica']->cpf; ?>
" />
							</div>
						</div>
						<div class="line">
							<label class="label required" for="dt_nascimento">dt_nascimento</label>
							<div class="innerLine">
								<input type="text" class="key input normal" id="dt_nascimento" name="dt_nascimento" onkeypress="mascara(this,data)" maxlength="10" value="<?php echo smarty_function_html_data(array('values' => $this->_tpl_vars['pessoa_fisica']->dt_nascimento), $this);?>
" />
							</div>
						</div>
					</div>
				</div>
				<div id="aba3" style="display: none;"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/telefone.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
				<div id="aba4" style="display: none;"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/endereco.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
				<div id="aba5" style="display: none;"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/usuario.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
				
				<div class="controle">
					<input type="submit" class="button save" value="Salvar" />
					<input type="button" class="button back" value="Sair" onclick="voltarForm();" />
				</div>
			</form>
		</div>
	</div>
</center>