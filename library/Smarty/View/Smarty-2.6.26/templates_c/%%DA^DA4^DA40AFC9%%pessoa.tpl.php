<?php /* Smarty version 2.6.26, created on 2010-05-17 23:29:36
         compiled from pessoa/pessoa.tpl */ ?>

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
				</div>
				<div class="controle">
					<input type="submit" class="button save" value="Salvar" />
					<input type="button" class="button back" value="Sair" onclick="voltarForm();" />
				</div>
			</form>
		</div>
	</div>
</center>