<?php /* Smarty version 2.6.26, created on 2010-05-17 20:11:00
         compiled from pessoa/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_data', 'pessoa/index.tpl', 37, false),)), $this); ?>

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/senapa/pessoa/Pessoa', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>Pessoa</h1>
				<sub>Gerencimento - Pessoa</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="<?php echo $this->_tpl_vars['pessoa']->getId(); ?>
" />
					<div class="line">
						<label class="label required" for="nome">nome</label>
						<div class="innerLine">
							<input type="text" class="key input grande" id="nome" name="nome" maxlength="250" value="<?php echo $this->_tpl_vars['pessoa']->getNome(); ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="email">email</label>
						<div class="innerLine">
							<input type="text" class="input grande" id="email" name="email" maxlength="250" value="<?php echo $this->_tpl_vars['pessoa']->getEmail(); ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="site">site</label>
						<div class="innerLine">
							<input type="text" class="input grande" id="site" name="site" maxlength="250" value="<?php echo $this->_tpl_vars['pessoa']->getSite(); ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="date_create">date_create</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="date_create" name="date_create" onkeypress="mascara(this,dataHora)" maxlength="19" value="<?php echo smarty_function_html_data(array('values' => $this->_tpl_vars['pessoa']->getDateCreate()), $this);?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="date_update">date_update</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="date_update" name="date_update" onkeypress="mascara(this,dataHora)" maxlength="19" value="<?php echo smarty_function_html_data(array('values' => $this->_tpl_vars['pessoa']->getDateUpdate()), $this);?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="date_delete">date_delete</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="date_delete" name="date_delete" onkeypress="mascara(this,dataHora)" maxlength="19" value="<?php echo smarty_function_html_data(array('values' => $this->_tpl_vars['pessoa']->getDateDelete()), $this);?>
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