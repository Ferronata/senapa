<?php /* Smarty version 2.6.26, created on 2010-04-04 21:36:18
         compiled from admin/medicamentocontraindicado.tpl */ ?>
				<div class="content">
					<input type="hidden" id="medicamento_contraindicado_id" name="medicamento_contraindicado_id" value="<?php echo $this->_tpl_vars['medicamento_contraindicado']->id; ?>
" />

					<div class="line">
						<label class="label required" for="medicamento_contraindicado_nome">nome</label>
						<div class="innerLine">
							<input type="text" class="input medio" id="medicamento_contraindicado_nome" name="medicamento_contraindicado_nome" maxlength="150" value="<?php echo $this->_tpl_vars['medicamento_contraindicado']->nome; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="principio_ativo">principio_ativo</label>
						<div class="innerLine">
							<input type="text" class="input grande" id="principio_ativo" name="principio_ativo" maxlength="250" value="<?php echo $this->_tpl_vars['medicamento_contraindicado']->principio_ativo; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="medicamento_descricao">descricao</label>
						<div class="innerLine">
							<textarea class="input normal" id="medicamento_descricao" name="medicamento_descricao"><?php echo $this->_tpl_vars['medicamento_contraindicado']->descricao; ?>
</textarea>
						</div>
					</div>
					
					<div><input type="button" class="addElement" onclick="addComponent($('medicamento_values'),[<?php echo 'medicamento_contraindicado_nome'; ?>
,<?php echo 'principio_ativo'; ?>
,<?php echo 'medicamento_descricao'; ?>
])" value="Adicionar"></div>
					<div class="divDatagridObjects">
						<table class="datagridObjects" id="medicamento_values">
							<thead>
								<tr class="gridTitle">
									<td>Nome</td>
									<td>Princípio Ativo</td>
									<td>Descrição</td>
									<td></td>
								</tr>
							</thead>
							<tbody>
								<?php $_from = $this->_tpl_vars['medicamentos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
								    <tr>
								    	<td><input type="hidden" name="listamedicamento_contraindicado_nome[]" value="<?php echo $this->_tpl_vars['item']['medicamento_contraindicado']['nome']; ?>
" /><?php echo $this->_tpl_vars['item']['medicamento_contraindicado']['nome']; ?>
</td>
								    	<td><input type="hidden" name="listaprincipio_ativo[]" value="<?php echo $this->_tpl_vars['item']['medicamento_contraindicado']['principio_ativo']; ?>
" /><?php echo $this->_tpl_vars['item']['medicamento_contraindicado']['principio_ativo']; ?>
</td>
								    	<td><input type="hidden" name="listamedicamento_descricao[]" value="<?php echo $this->_tpl_vars['item']['medicamento_contraindicado']['descricao']; ?>
" /><?php echo $this->_tpl_vars['item']['medicamento_contraindicado']['descricao']; ?>
</td>
								    	
								    	<td><input type="button" class="bt_remove" onclick="removeComponent(this)" value="remover" /></td>
								    </tr>
								<?php endforeach; endif; unset($_from); ?>
							</tbody>
						</table>
					</div>
				</div>