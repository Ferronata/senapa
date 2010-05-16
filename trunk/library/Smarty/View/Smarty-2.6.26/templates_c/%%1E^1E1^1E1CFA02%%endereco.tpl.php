<?php /* Smarty version 2.6.26, created on 2010-03-13 22:49:47
         compiled from admin/endereco.tpl */ ?>

				<div class="content">
					<input type="hidden" id="endereco_id" name="endereco_id" value="<?php echo $this->_tpl_vars['endereco']->id; ?>
" />
					<div class="line">
						<label class="label required" for="Uf">UF</label>
						<div class="innerLine">
							<select id="Uf" name=Uf class="key input pequeno" onchange="rerender(this,[<?php echo 'Cidade'; ?>
,<?php echo 'Bairro'; ?>
,<?php echo 'Logradouro'; ?>
])">
								<option>Selecione</option>
								<?php $_from = $this->_tpl_vars['ufs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['uf']->id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['sigla']; ?>
</option>
								<?php endforeach; endif; unset($_from); ?>
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="Cidade">Cidade</label>
						<div class="innerLine">
							<select id="Cidade" name=Cidade class="key input pequeno" onchange="rerender(this,[<?php echo 'Bairro'; ?>
,<?php echo 'Logradouro'; ?>
])">
								<option>Selecione</option>
								<?php $_from = $this->_tpl_vars['cidades']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['cidade']->id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
</option>
								<?php endforeach; endif; unset($_from); ?>
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="bairro">Bairro</label>
						<div class="innerLine">
							<select id="Bairro" name=Bairro class="key input pequeno" onchange="rerender(this,[<?php echo 'Logradouro'; ?>
])">
								<option>Selecione</option>
								<?php $_from = $this->_tpl_vars['bairros']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['bairro']->id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
</option>
								<?php endforeach; endif; unset($_from); ?>
							</select>
						</div>
					</div>
					
					<div class="line">
						<label class="label required" for="logradouro_id">Logradouro</label>
						<div class="innerLine">
							<select id="Logradouro" name=Logradouro class="key input pequeno">
								<option>Selecione</option>
								<?php $_from = $this->_tpl_vars['logradouros']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['endereco']->logradouro_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
</option>
								<?php endforeach; endif; unset($_from); ?>
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label" for="numero">numero</label>
						<div class="innerLine">
							<input type="text" class="input pequeno" id="numero" name="numero" maxlength="10" value="<?php echo $this->_tpl_vars['endereco']->numero; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="complemento">complemento</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="complemento" name="complemento" maxlength="100" value="<?php echo $this->_tpl_vars['endereco']->complemento; ?>
" />
						</div>
					</div>
				</div>