<?php /* Smarty version 2.6.26, created on 2010-04-12 19:32:51
         compiled from admin/professor.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_aba', 'admin/professor.tpl', 15, false),)), $this); ?>

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/sgaPhp/admin/Professor', 'form', 'save');" onsubmit="return(runAction(this))">
			
				<h1>Professor</h1>
				<sub>Gerencimento - Professor</sub>
				<div id="abas" class="divAba"><?php echo smarty_function_html_aba(array('value' => 'Formação','forid' => 'aba7'), $this);?>
<?php echo smarty_function_html_aba(array('value' => 'Certificados','forid' => 'aba8'), $this);?>
<?php echo smarty_function_html_aba(array('value' => 'Experiênca Profissional','forid' => 'aba9'), $this);?>
<?php echo smarty_function_html_aba(array('value' => 'Disciplina','forid' => 'aba10'), $this);?>
<br /><?php echo smarty_function_html_aba(array('value' => 'Identificação','forid' => 'aba1','classe' => 'selected'), $this);?>
<?php echo smarty_function_html_aba(array('value' => 'Dados','forid' => 'aba2'), $this);?>
<?php echo smarty_function_html_aba(array('value' => 'Professor','forid' => 'aba3'), $this);?>
<?php echo smarty_function_html_aba(array('value' => 'Telefone','forid' => 'aba4'), $this);?>
<?php echo smarty_function_html_aba(array('value' => 'Endereço','forid' => 'aba5'), $this);?>
<?php echo smarty_function_html_aba(array('value' => 'Usuário','forid' => 'aba6'), $this);?>
</div>
				
				<div id="aba1">
					<div class="content">
						<div class="line">
							<label class="label required" for="pessoa_escola_id">CPF</label>
							<div class="innerLine">
								<input type="text" class="key input normal" id="cpf" name="cpf" onkeypress="mascara(this,cpf_mask)" maxlength="14" value="<?php echo $this->_tpl_vars['pessoa_fisica']->cpf; ?>
" />
								<input type="button" class="find" value="Find" onclick="rerenderObject('professor','renderpessoa',$('cpf'),'cpf')" />
							</div>
						</div>
						<div class="line">
							<label class="label" for="matricula">Matrícula</label>
							<div class="innerLine">
								<input type="text" disabled="disabled" class="input pequeno" id="matricula" name="matricula" value="<?php echo $this->_tpl_vars['pessoa_escola']->matricula; ?>
" />
							</div>
						</div>
					</div>
				</div>
				<div id="aba2" style="display: none;"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/pessoa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
				<div id="aba3" class="content" style="display: none;">
					<input type="hidden" id="professor_id" name="professor_id" value="<?php echo $this->_tpl_vars['professor']->id; ?>
" />
					<input type="hidden" id="funcionario_pessoa_escola_id" name="funcionario_pessoa_escola_id" value="<?php echo $this->_tpl_vars['professor']->funcionario_pessoa_escola_id; ?>
" />
					<input type="hidden" id="funcionario_id" name="funcionario_id" value="<?php echo $this->_tpl_vars['professor']->funcionario_id; ?>
" />
					<input type="hidden" id="funcionario_pessoa_escola_pessoa_fisica_pessoa_id" name="funcionario_pessoa_escola_pessoa_fisica_pessoa_id" value="<?php echo $this->_tpl_vars['professor']->funcionario_pessoa_escola_pessoa_fisica_pessoa_id; ?>
" />
					<input type="hidden" id="funcionario_pessoa_escola_pessoa_fisica_id" name="funcionario_pessoa_escola_pessoa_fisica_id" value="<?php echo $this->_tpl_vars['professor']->funcionario_pessoa_escola_pessoa_fisica_id; ?>
" />
						
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/funcionario_campos.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</div>
				<div id="aba4" style="display: none;"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/telefone.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
				<div id="aba5" style="display: none;"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/endereco.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
				<div id="aba6" style="display: none;"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/usuario.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
				<div id="aba7" style="display: none;"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/formacao.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
				<div id="aba8" style="display: none;"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/certificado.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
				<div id="aba9" style="display: none;"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/experiencia.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
				<div id="aba10" style="display: none;"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/professordisciplina.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
				 
				<div class="msg"><?php echo $this->_tpl_vars['msg']; ?>
</div>
				<div class="controle">
					<input type="submit" class="button save" value="Salvar" />
					<input type="button" class="button back" value="Sair" onclick="voltarForm();" />
				</div>
			</form>
		</div>
	</div>
</center>