<?php /* Smarty version 2.6.26, created on 2010-04-04 21:36:18
         compiled from admin/vacina.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_data', 'admin/vacina.tpl', 18, false),)), $this); ?>

				<div class="content">
					<div class="line">
						<label class="label required" for="vacina_nome">nome</label>
						<div class="innerLine">
							<input type="text" class="input medio" id="vacina_nome" name="vacina_nome" maxlength="150" value="<?php echo $this->_tpl_vars['vacina']->nome; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="dt_aplicacao">dt_aplicacao</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="dt_aplicacao" name="dt_aplicacao" onkeypress="mascara(this,data)" maxlength="10" value="<?php echo smarty_function_html_data(array('values' => $this->_tpl_vars['vacina']->dt_aplicacao), $this);?>
" />
						</div>
					</div>
					
					<div><input type="button" class="addElement" onclick="addComponent($('vacina_values'),[<?php echo 'vacina_nome'; ?>
,<?php echo 'dt_aplicacao'; ?>
])" value="Adicionar"></div>
					<div class="divDatagridObjects">
						<table class="datagridObjects" id="vacina_values">
							<thead>
								<tr class="gridTitle">
									<td>Nome</td>
									<td>Data de Vacinação</td>
									<td></td>
								</tr>
							</thead>
							<tbody>
								<?php $_from = $this->_tpl_vars['vacinas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
								    <tr>
								    	<td><input type="hidden" name="listavacina_nome[]" value="<?php echo $this->_tpl_vars['item']['vacina']['nome']; ?>
" /><?php echo $this->_tpl_vars['item']['vacina']['nome']; ?>
</td>
								    	<td><input type="hidden" name="listadt_aplicacao[]" value="<?php echo smarty_function_html_data(array('values' => $this->_tpl_vars['item']['vacina']['dt_aplicacao']), $this);?>
" /><?php echo smarty_function_html_data(array('values' => $this->_tpl_vars['item']['vacina']['dt_aplicacao']), $this);?>
</td>
								    	
								    	<td><input type="button" class="bt_remove" onclick="removeComponent(this)" value="remover" /></td>
								    </tr>
								<?php endforeach; endif; unset($_from); ?>
							</tbody>
						</table>
					</div>
				</div>