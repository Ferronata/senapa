<?php /* Smarty version 2.6.26, created on 2010-03-22 23:31:21
         compiled from admin/telefone.tpl */ ?>

				<div class="content">
					<div class="line">
						<label class="label" for="telefone_tipo">telefone_tipo_id</label>
						<div class="innerLine">
							<select name=telefone_tipo class="input pequeno">
								<?php $_from = $this->_tpl_vars['telefone_tipo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['telefone']->telefone_tipo_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
</option>
								<?php endforeach; else: ?>
									<option>Nenhum Registro</option>
								<?php endif; unset($_from); ?>
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label" for="fone">numero</label>
						<div class="innerLine">
							<input type="text" class="input pequeno" id="fone" name="fone" onkeypress="mascara(this,telefone)" maxlength="14" value="<?php echo $this->_tpl_vars['telefone']->numero; ?>
" />
						</div>
					</div>
					<div><input type="button" class="addElement" onclick="addComponent($('values'),[<?php echo 'telefone_tipo'; ?>
,$('fone')])" value="Adicionar"></div>
					<div class="divDatagridObjects">
						<table class="datagridObjects" id="values">
							<thead>
								<tr class="gridTitle">
									<td>Tipo</td>
									<td>Número</td>
									<td></td>
								</tr>
							</thead>
							<tbody>
								<?php $_from = $this->_tpl_vars['telefones']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
								    <tr>
								    	<td><input type="hidden" name="listatelefone_tipo[]" value="<?php echo $this->_tpl_vars['item']['tipo']['nome']; ?>
" /><?php echo $this->_tpl_vars['item']['tipo']['nome']; ?>
</td>
								    	<td><input type="hidden" name="listafone[]" value="<?php echo $this->_tpl_vars['item']['telefone']['numero']; ?>
" /><?php echo $this->_tpl_vars['item']['telefone']['numero']; ?>
</td>
								    	<td><input type="button" class="bt_remove" onclick="removeComponent(this)" value="remover" /></td>
								    </tr>
								<?php endforeach; endif; unset($_from); ?>
							</tbody>
						</table>
					</div>
				</div>