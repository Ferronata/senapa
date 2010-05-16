<?php /* Smarty version 2.6.26, created on 2010-03-31 14:34:11
         compiled from admin/escolaridade.tpl */ ?>

<center>
	<div class="body">
		<div class="innerBody">
			<!-- <form id="form" name="form" method="post" action="javascript: enviarForm('/sgaPhp/admin/Escolaridade', 'form', 'save');" onsubmit="return(runAction(this))"> -->
			<form id="form" name="form" method="post" action="/sgaPhp/admin/Escolaridade" onsubmit="return(runAction(this))">
				<h1>Escolaridade</h1>
				<sub>Gerencimento - Escolaridade</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="<?php echo $this->_tpl_vars['escolaridade']->id; ?>
" />
					<div class="line">
						<label class="label required" for="nome">nome</label>
						<div class="innerLine">
							<input type="text" class="key input medio" id="nome" name="nome" maxlength="150" value="<?php echo $this->_tpl_vars['escolaridade']->nome; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="status">status</label>
						<div class="innerLine">
							<input type="checkbox" class="input" id="status" name="status"  value="1" <?php if ($this->_tpl_vars['escolaridade']->status): ?>checked="checked"<?php endif; ?> />
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