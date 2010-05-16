<?php /* Smarty version 2.6.26, created on 2010-03-21 21:21:06
         compiled from admin/usuario.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'crypt', 'admin/usuario.tpl', 33, false),)), $this); ?>

				<div class="content">
					<input type="hidden" id="pessoa_fisica_pessoa_id" name="pessoa_fisica_pessoa_id" maxlength="10" value="<?php echo $this->_tpl_vars['usuario']->pessoa_fisica_pessoa_id; ?>
" />
					<input type="hidden" id="pessoa_fisica_id" name="pessoa_fisica_id" maxlength="10" value="<?php echo $this->_tpl_vars['usuario']->pessoa_fisica_id; ?>
" />
					
					<div class="line">
						<label class="label required" for="papel_id">papel_id</label>
						<div class="innerLine">
							<select name=papel_id class="key input pequeno">
								<?php $_from = $this->_tpl_vars['papel']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['usuario']->papel_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
</option>
								<?php endforeach; else: ?>
									<option>Nenhum Registro</option>
								<?php endif; unset($_from); ?>
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label" for="usuario">usuario</label>
						<div class="innerLine">
							<input type="text" disabled="disabled" class="input pequeno" id="usuario" name="usuario" maxlength="250" value="<?php echo $this->_tpl_vars['usuario']->usuario; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="senha">senha</label>
						<div class="innerLine">
							<input type="password" class="key input normal" id="senha" name="senha" maxlength="250" value="<?php echo smarty_function_crypt(array('crypt' => 'md5','action' => 'decrypt','value' => $this->_tpl_vars['usuario']->senha), $this);?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="status">status</label>
						<div class="innerLine">
							<input type="checkbox" class="input" id="status" name="status"  value="1" <?php if ($this->_tpl_vars['usuario']->status): ?>checked="checked"<?php endif; ?> />
						</div>
					</div>
				</div>