<?php /* Smarty version 2.6.26, created on 2010-03-21 22:15:06
         compiled from admin/pessoa.tpl */ ?>

				<div class="content">
					<input type="hidden" id="pessoa_id" name="pessoa_id" value="<?php echo $this->_tpl_vars['pessoa']->id; ?>
" />
					<div class="line">
						<label class="label required" for="nome">nome</label>
						<div class="innerLine">
							<input type="text" class="key input grande" id="nome" name="nome" maxlength="250" value="<?php echo $this->_tpl_vars['pessoa']->nome; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="email">email</label>
						<div class="innerLine">
							<input type="text" class="input grande" id="email" name="email" maxlength="250" value="<?php echo $this->_tpl_vars['pessoa']->email; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="site">site</label>
						<div class="innerLine">
							<input type="text" class="input grande" id="site" name="site" maxlength="250" value="<?php echo $this->_tpl_vars['pessoa']->site; ?>
" />
						</div>
					</div>
				</div>
