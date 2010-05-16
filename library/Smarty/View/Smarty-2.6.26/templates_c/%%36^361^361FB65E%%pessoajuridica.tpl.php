<?php /* Smarty version 2.6.26, created on 2010-03-11 17:24:01
         compiled from admin/pessoajuridica.tpl */ ?>

				<div class="content">
					<input type="hidden" id="pessoa_id" name="pessoa_id" value="<?php echo $this->_tpl_vars['pessoa_juridica']->pessoa_id; ?>
" />
					
					<div class="line">
						<label class="label required" for="cnpj">cnpj</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="cnpj" name="cnpj" onkeypress="mascara(this,cnpj)" maxlength="18" value="<?php echo $this->_tpl_vars['pessoa_juridica']->cnpj; ?>
" />
						</div>
					</div>
				</div>