<?php /* Smarty version 2.6.26, created on 2010-03-31 14:57:05
         compiled from admin/funcionario_campos.tpl */ ?>
				<div class="content">
						<input type="hidden" id="funcionario_id" name="funcionario_id" value="<?php echo $this->_tpl_vars['funcionario']->id; ?>
" />
						<input type="hidden" id="pessoa_escola_id" name="pessoa_escola_id" value="<?php echo $this->_tpl_vars['funcionario']->pessoa_escola_id; ?>
" />
						<input type="hidden" id="pessoa_escola_pessoa_fisica_id" name="pessoa_escola_pessoa_fisica_id" value="<?php echo $this->_tpl_vars['funcionario']->pessoa_escola_pessoa_fisica_id; ?>
" />
						<input type="hidden" id="pessoa_escola_pessoa_fisica_pessoa_id" name="pessoa_escola_pessoa_fisica_pessoa_id" value="<?php echo $this->_tpl_vars['funcionario']->pessoa_escola_pessoa_fisica_pessoa_id; ?>
" />
	
						<div class="line">
							<label class="label required" for="Cargo">Cargo</label>
							<div class="innerLine">
								<select name=Cargo class="key input pequeno" onchange="rerender(this,[<?php echo 'Funcao'; ?>
])" >
									<option>Selecione</option>
									<?php $_from = $this->_tpl_vars['cargos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
										<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['cargo']->id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
</option>
									<?php endforeach; endif; unset($_from); ?>
								</select>
							</div>
						</div>
						<div class="line">
							<label class="label required" for="funcao_id">funcao_id</label>
							<div class="innerLine">
								<select id="Funcao" name=Funcao class="key input pequeno">
									<?php $_from = $this->_tpl_vars['funcoes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
										<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['funcionario']->funcao_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
</option>
									<?php endforeach; else: ?>
										<option>Nenhum Registro</option>
									<?php endif; unset($_from); ?>
								</select>
							</div>
						</div>
						<div class="line">
							<label class="label" for="carga_horaria">carga_horaria</label>
							<div class="innerLine">
								<input type="text" class="input normal" id="carga_horaria" name="carga_horaria" onkeypress="mascara(this,hora)" maxlength="5" value="<?php echo $this->_tpl_vars['funcionario']->carga_horaria; ?>
" />
							</div>
						</div>
						<div class="line">
							<label class="label" for="cnh">cnh</label>
							<div class="innerLine">
								<input type="text" class="input normal" id="cnh" name="cnh" maxlength="100" value="<?php echo $this->_tpl_vars['funcionario']->cnh; ?>
" />
							</div>
						</div>
						<div class="line">
							<label class="label" for="pis">pis</label>
							<div class="innerLine">
								<input type="text" class="input normal" id="pis" name="pis" maxlength="100" value="<?php echo $this->_tpl_vars['funcionario']->pis; ?>
" />
							</div>
						</div>
					</div>