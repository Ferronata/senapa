<?php /* Smarty version 2.6.26, created on 2010-03-13 12:39:07
         compiled from admin/escola.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_aba', 'admin/escola.tpl', 15, false),)), $this); ?>

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/sgaPhp/admin/Escola', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>Escola</h1>
				<sub>Gerencimento - Escola</sub>
				
				<div id="abas" class="divAba"><?php echo smarty_function_html_aba(array('value' => 'Dados','forid' => 'aba1','classe' => 'selected'), $this);?>
<?php echo smarty_function_html_aba(array('value' => 'Documentos','forid' => 'aba2'), $this);?>
<?php echo smarty_function_html_aba(array('value' => 'Escola','forid' => 'aba3'), $this);?>
<?php echo smarty_function_html_aba(array('value' => 'Telefone','forid' => 'aba4'), $this);?>
<?php echo smarty_function_html_aba(array('value' => 'Endereço','forid' => 'aba5'), $this);?>
</div>
				<div id="aba1"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/pessoa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
				<div id="aba2" style="display: none;"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/pessoajuridica.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
				
				<div id="aba3" style="display: none;">
				
					<div class="content">
						<input type="hidden" id="id" name="id" value="<?php echo $this->_tpl_vars['escola']->id; ?>
" />
						<input type="hidden" id="pessoa_juridica_pessoa_id" name="pessoa_juridica_pessoa_id" value="<?php echo $this->_tpl_vars['escola']->pessoa_juridica_pessoa_id; ?>
" />
						<input type="hidden" id="pessoa_juridica_id" name="pessoa_juridica_id" value="<?php echo $this->_tpl_vars['escola']->pessoa_juridica_id; ?>
" />
						<input type="hidden" id="empresa_id" name="empresa_id" value="<?php echo $this->_tpl_vars['escola']->empresa_id; ?>
" />
						<input type="hidden" id="pessoa_id" name="pessoa_id" value="<?php echo $this->_tpl_vars['pessoa_juridica']->pessoa_id; ?>
" />

						<div class="line">
							<label class="label required" for="condigo_inep">condigo_inep</label>
							<div class="innerLine">
								<input type="text" class="key input normal" id="condigo_inep" name="condigo_inep" maxlength="100" value="<?php echo $this->_tpl_vars['escola']->condigo_inep; ?>
" />
							</div>
						</div>
						<div class="line">
							<label class="label required" for="nota_maxima">nota_maxima</label>
							<div class="innerLine">
								<input type="text" class="key input normal" id="nota_maxima" name="nota_maxima" onkeypress="mascara(this,monetario)" value="<?php echo $this->_tpl_vars['escola']->nota_maxima; ?>
" />
							</div>
						</div>
						<div class="line">
							<label class="label required" for="media">media</label>
							<div class="innerLine">
								<input type="text" class="key input pequeno" id="media" name="media" onkeypress="mascara(this,soNumeros)" maxlength="2" value="<?php echo $this->_tpl_vars['escola']->media; ?>
" />
							</div>
						</div>
						<div class="line">
							<label class="label required" for="duracao_aula">duracao_aula</label>
							<div class="innerLine">
								<input type="text" class="key input pequeno" id="duracao_aula" name="duracao_aula" onkeypress="mascara(this,soNumeros)" maxlength="3" value="<?php echo $this->_tpl_vars['escola']->duracao_aula; ?>
" />
							</div>
						</div>
						<div class="line">
							<label class="label" for="status">status</label>
							<div class="innerLine">
								<input type="checkbox" class="input" id="status" name="status"  value="1" <?php if ($this->_tpl_vars['escola']->status): ?>checked="checked"<?php endif; ?> />
							</div>
						</div>
					</div>
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

				<div class="controle">
					<input type="submit" class="button save" value="Salvar" />
					<input type="button" class="button back" value="Sair" onclick="voltarForm();" />
				</div>
			</form>
		</div>
	</div>
</center>