<?php /* Smarty version 2.6.26, created on 2010-03-10 01:28:02
         compiled from admin/empresa.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_data', 'admin/empresa.tpl', 25, false),)), $this); ?>

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/sgaPhp/admin/Empresa', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>Empresa</h1>
				<sub>Gerencimento - Empresa</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="<?php echo $this->_tpl_vars['empresa']->id; ?>
" />
					<div class="line">
						<label class="label required" for="nome">nome</label>
						<div class="innerLine">
							<input type="text" class="key input grande" id="nome" name="nome" maxlength="250" value="<?php echo $this->_tpl_vars['empresa']->nome; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="dt_inicio">dt_inicio</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="dt_inicio" name="dt_inicio" onkeypress="mascara(this,data)" maxlength="10" value="<?php echo smarty_function_html_data(array('values' => $this->_tpl_vars['empresa']->dt_inicio), $this);?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="dt_fim">dt_fim</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="dt_fim" name="dt_fim" onkeypress="mascara(this,data)" maxlength="10" value="<?php echo smarty_function_html_data(array('values' => $this->_tpl_vars['empresa']->dt_fim), $this);?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="status">status</label>
						<div class="innerLine">
							<input type="checkbox" class="input" id="status" name="status"  value="1" <?php if ($this->_tpl_vars['empresa']->status): ?>checked="checked"<?php endif; ?> />
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