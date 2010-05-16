<?php /* Smarty version 2.6.26, created on 2010-04-01 12:01:44
         compiled from admin/formacao.tpl */ ?>

				<div class="content">
					
					<div class="line">
						<label class="label required" for="formacao_area_id">formacao_area_id</label>
						<div class="innerLine">
							<select name=formacao_area_id class="input pequeno">
								<?php $_from = $this->_tpl_vars['formacao_area']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['formacao']->formacao_area_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
</option>
								<?php endforeach; else: ?>
									<option>Nenhum Registro</option>
								<?php endif; unset($_from); ?>
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="escolaridade_id">escolaridade_id</label>
						<div class="innerLine">
							<select name=escolaridade_id class="input pequeno">
								<?php $_from = $this->_tpl_vars['escolaridade']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['formacao']->escolaridade_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
</option>
								<?php endforeach; else: ?>
									<option>Nenhum Registro</option>
								<?php endif; unset($_from); ?>
							</select>
						</div>
					</div>
					
					<div class="line">
						<label class="label required" for="formacao_nome">nome</label>
						<div class="innerLine">
							<input type="text" class="input grande" id="formacao_nome" name="formacao_nome" maxlength="250" value="<?php echo $this->_tpl_vars['formacao']->nome; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="instituicao">instituicao</label>
						<div class="innerLine">
							<input type="text" class="input grande" id="instituicao" name="instituicao" maxlength="300" value="<?php echo $this->_tpl_vars['formacao']->instituicao; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="ano_conclusao">ano_conclusao</label>
						<div class="innerLine">
							<input type="text" class="input pequeno" id="formacao_ano_conclusao" name="formacao_ano_conclusao" onkeypress="mascara(this,soNumeros)" maxlength="4" value="<?php echo $this->_tpl_vars['formacao']->ano_conclusao; ?>
" />
						</div>
					</div>
					
					<div><input type="button" class="addElement" onclick="addComponent($('formacao_values'),[<?php echo 'formacao_area_id'; ?>
,<?php echo 'escolaridade_id'; ?>
,$('formacao_nome'),$('instituicao'),$('formacao_ano_conclusao')])" value="Adicionar"></div>
					<div class="divDatagridObjects">
						<table class="datagridObjects" id="formacao_values">
							<thead>
								<tr class="gridTitle">
									<td>Área</td>
									<td>Escolaridade</td>
									<td>Formação</td>
									<td>Instituição</td>
									<td>Conclusão</td>
									<td></td>
								</tr>
							</thead>
							<tbody>
								<?php $_from = $this->_tpl_vars['formacoes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
								    <tr>
								    	<td><input type="hidden" name="listaformacao_area_id[]" value="<?php echo $this->_tpl_vars['item']['formacao_area']['nome']; ?>
" /><?php echo $this->_tpl_vars['item']['formacao_area']['nome']; ?>
</td>
								    	<td><input type="hidden" name="listaescolaridade_id[]" value="<?php echo $this->_tpl_vars['item']['escolaridade']['nome']; ?>
" /><?php echo $this->_tpl_vars['item']['escolaridade']['nome']; ?>
</td>
								    	<td><input type="hidden" name="listaformacao_nome[]" value="<?php echo $this->_tpl_vars['item']['formacao']['nome']; ?>
" /><?php echo $this->_tpl_vars['item']['formacao']['nome']; ?>
</td>
								    	<td><input type="hidden" name="listainstituicao[]" value="<?php echo $this->_tpl_vars['item']['formacao']['instituicao']; ?>
" /><?php echo $this->_tpl_vars['item']['formacao']['instituicao']; ?>
</td>
								    	<td><input type="hidden" name="listaformacao_ano_conclusao[]" value="<?php echo $this->_tpl_vars['item']['formacao']['ano_conclusao']; ?>
" /><?php echo $this->_tpl_vars['item']['formacao']['ano_conclusao']; ?>
</td>
								    	
								    	<td><input type="button" class="bt_remove" onclick="removeComponent(this)" value="remover" /></td>
								    </tr>
								<?php endforeach; endif; unset($_from); ?>
							</tbody>
						</table>
					</div>
				</div>