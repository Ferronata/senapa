<?php /* Smarty version 2.6.26, created on 2010-04-04 21:19:14
         compiled from admin/certidao.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_data', 'admin/certidao.tpl', 50, false),)), $this); ?>

				<div class="content">
					<input type="hidden" id="certidao_id" name="certidao_id" value="<?php echo $this->_tpl_vars['certidao']->id; ?>
" />

					<div class="line">
						<label class="label required" for="uf_id">uf_id</label>
						<div class="innerLine">
							<select name=uf_id class="key input pequeno">
								<?php $_from = $this->_tpl_vars['ufs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['certidao']->uf_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['sigla']; ?>
</option>
								<?php endforeach; else: ?>
									<option>Nenhum Registro</option>
								<?php endif; unset($_from); ?>
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="certidao_tipo">tipo</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="certidao_tipo" name="certidao_tipo" maxlength="80" value="<?php echo $this->_tpl_vars['certidao']->tipo; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="certidao_numero">numero</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="certidao_numero" name="certidao_numero" maxlength="80" value="<?php echo $this->_tpl_vars['certidao']->numero; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="folha">folha</label>
						<div class="innerLine">
							<input type="text" class="input medio" id="folha" name="folha" maxlength="150" value="<?php echo $this->_tpl_vars['certidao']->folha; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="livro">livro</label>
						<div class="innerLine">
							<input type="text" class="input medio" id="livro" name="livro" maxlength="150" value="<?php echo $this->_tpl_vars['certidao']->livro; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="dt_emissao">dt_emissao</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="dt_emissao" name="dt_emissao" onkeypress="mascara(this,data)" maxlength="10" value="<?php echo smarty_function_html_data(array('values' => $this->_tpl_vars['certidao']->dt_emissao), $this);?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="cartorio">cartorio</label>
						<div class="innerLine">
							<input type="text" class="input grande" id="cartorio" name="cartorio" maxlength="250" value="<?php echo $this->_tpl_vars['certidao']->cartorio; ?>
" />
						</div>
					</div>
				</div>