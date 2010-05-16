<?php /* Smarty version 2.6.26, created on 2010-04-01 12:01:44
         compiled from admin/experiencia.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_data', 'admin/experiencia.tpl', 35, false),)), $this); ?>
				<div class="content">
					<div class="line">
						<label class="label required" for="experiencia_nome">nome</label>
						<div class="innerLine">
							<input type="text" class="input medio" id="experiencia_nome" name="experiencia_nome" maxlength="150" value="<?php echo $this->_tpl_vars['experiencia']->nome; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="empresa_cnpj">empresa_cnpj</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="empresa_cnpj" name="empresa_cnpj" maxlength="18" value="<?php echo $this->_tpl_vars['experiencia']->empresa_cnpj; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="cargo">cargo</label>
						<div class="innerLine">
							<input type="text" class="input grande" id="cargo" name="cargo" maxlength="250" value="<?php echo $this->_tpl_vars['experiencia']->cargo; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="descricao">descricao</label>
						<div class="innerLine">
							<textarea class="input normal" id="descricao" name="descricao"><?php echo $this->_tpl_vars['experiencia']->descricao; ?>
</textarea>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="experiencia_dt_inicio">dt_inicio</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="experiencia_dt_inicio" name="experiencia_dt_inicio" onkeypress="mascara(this,data)" maxlength="10" value="<?php echo smarty_function_html_data(array('values' => $this->_tpl_vars['experiencia']->dt_inicio), $this);?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="experiencia_dt_fim">dt_fim</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="experiencia_dt_fim" name="experiencia_dt_fim" onkeypress="mascara(this,data)" maxlength="10" value="<?php echo smarty_function_html_data(array('values' => $this->_tpl_vars['experiencia']->dt_fim), $this);?>
" />
						</div>
					</div>
										
					<div><input type="button" class="addElement" onclick="addComponent($('experiencia_values'),[$('empresa_cnpj'),$('experiencia_nome'),$('cargo'),$('descricao'),$('experiencia_dt_inicio'),$('experiencia_dt_fim')])" value="Adicionar"></div>
					<div class="divDatagridObjects">
						<table class="datagridObjects" id="experiencia_values">
							<thead>
								<tr class="gridTitle">
									<td>CNPJ</td>
									<td>Nome</td>
									<td>Cargo</td>
									<td>Descrição</td>
									<td>Início</td>
									<td>Fim</td>
									<td></td>
								</tr>
							</thead>
							<tbody>
								<?php $_from = $this->_tpl_vars['experiencias']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
								    <tr>
								    	<td><input type="hidden" name="listaempresa_cnpj[]" value="<?php echo $this->_tpl_vars['item']['experiencia']['empresa_cnpj']; ?>
" /><?php echo $this->_tpl_vars['item']['experiencia']['empresa_cnpj']; ?>
</td>
								    	<td><input type="hidden" name="listaexperiencia_nome[]" value="<?php echo $this->_tpl_vars['item']['experiencia']['nome']; ?>
" /><?php echo $this->_tpl_vars['item']['experiencia']['nome']; ?>
</td>
								    	<td><input type="hidden" name="listacargo[]" value="<?php echo $this->_tpl_vars['item']['experiencia']['cargo']; ?>
" /><?php echo $this->_tpl_vars['item']['experiencia']['cargo']; ?>
</td>							    	
								    	<td><input type="hidden" name="listadescricao[]" value="<?php echo $this->_tpl_vars['item']['experiencia']['descricao']; ?>
" /><?php echo $this->_tpl_vars['item']['experiencia']['descricao']; ?>
</td>
								    	<td><input type="hidden" name="listaexperiencia_dt_inicio[]" value="<?php echo smarty_function_html_data(array('values' => $this->_tpl_vars['item']['experiencia']['dt_inicio']), $this);?>
" /><?php echo smarty_function_html_data(array('values' => $this->_tpl_vars['item']['experiencia']['dt_inicio']), $this);?>
</td>
								    	<td><input type="hidden" name="listaexperiencia_dt_fim[]" value="<?php echo smarty_function_html_data(array('values' => $this->_tpl_vars['item']['experiencia']['dt_fim']), $this);?>
" /><?php echo smarty_function_html_data(array('values' => $this->_tpl_vars['item']['experiencia']['dt_fim']), $this);?>
</td>
								    	
								    	<td><input type="button" class="bt_remove" onclick="removeComponent(this)" value="remover" /></td>
								    </tr>
								<?php endforeach; endif; unset($_from); ?>
							</tbody>
						</table>
					</div>
				</div>