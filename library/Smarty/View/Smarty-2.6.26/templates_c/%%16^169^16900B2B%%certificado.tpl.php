<?php /* Smarty version 2.6.26, created on 2010-04-01 12:01:44
         compiled from admin/certificado.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_data', 'admin/certificado.tpl', 30, false),)), $this); ?>
				<div class="content">
											
					<div class="line">
						<label class="label required" for="certificado_nome">nome</label>
						<div class="innerLine">
							<input type="text" class="input grande" id="certificado_nome" name="certificado_nome" maxlength="250" value="<?php echo $this->_tpl_vars['certificado']->nome; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="carga_horaria">carga_horaria</label>
						<div class="innerLine">
							<input type="text" class="input pequeno" id="carga_horaria" name="carga_horaria" onkeypress="mascara(this,soNumeros)" maxlength="10" value="<?php echo $this->_tpl_vars['certificado']->carga_horaria; ?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="atividades">Descrição</label>
						<div class="innerLine">
							<textarea class="input normal" id="certificado_atividades" name="certificado_atividades"><?php echo $this->_tpl_vars['certificado']->atividades; ?>
</textarea>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="dt_inicio">dt_inicio</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="certificado_dt_inicio" name="certificado_dt_inicio" onkeypress="mascara(this,data)" maxlength="10" value="<?php echo smarty_function_html_data(array('values' => $this->_tpl_vars['certificado']->dt_inicio), $this);?>
" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="dt_fim">dt_fim</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="certificado_dt_fim" name="certificado_dt_fim" onkeypress="mascara(this,data)" maxlength="10" value="<?php echo smarty_function_html_data(array('values' => $this->_tpl_vars['certificado']->dt_fim), $this);?>
" />
						</div>
					</div>
					
					<div><input type="button" class="addElement" onclick="addComponent($('certificado_values'),[$('certificado_nome'),$('carga_horaria'),$('certificado_atividades'),$('certificado_dt_inicio'),$('certificado_dt_fim')])" value="Adicionar"></div>
					<div class="divDatagridObjects">
						<table class="datagridObjects" id="certificado_values">
							<thead>
								<tr class="gridTitle">
									<td>Nome</td>
									<td>Carga Horária</td>
									<td>Descrição</td>
									<td>Início</td>
									<td>Fim</td>
									<td></td>
								</tr>
							</thead>
							<tbody>
								<?php $_from = $this->_tpl_vars['certificados']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
								    <tr>
								    	<td><input type="hidden" name="listacertificado_nome[]" value="<?php echo $this->_tpl_vars['item']['certificado']['nome']; ?>
" /><?php echo $this->_tpl_vars['item']['certificado']['nome']; ?>
</td>
								    	<td><input type="hidden" name="listacarga_horaria[]" value="<?php echo $this->_tpl_vars['item']['certificado']['carga_horaria']; ?>
" /><?php echo $this->_tpl_vars['item']['certificado']['carga_horaria']; ?>
</td>
								    	<td><input type="hidden" name="listacertificado_atividades[]" value="<?php echo $this->_tpl_vars['item']['certificado']['atividades']; ?>
" /><?php echo $this->_tpl_vars['item']['certificado']['atividades']; ?>
</td>
								    	<td><input type="hidden" name="listacertificado_dt_inicio[]" value="<?php echo smarty_function_html_data(array('values' => $this->_tpl_vars['item']['certificado']['dt_inicio']), $this);?>
" /><?php echo smarty_function_html_data(array('values' => $this->_tpl_vars['item']['certificado']['dt_inicio']), $this);?>
</td>
								    	<td><input type="hidden" name="listacertificado_dt_fim[]" value="<?php echo smarty_function_html_data(array('values' => $this->_tpl_vars['item']['certificado']['dt_fim']), $this);?>
" /><?php echo smarty_function_html_data(array('values' => $this->_tpl_vars['item']['certificado']['dt_fim']), $this);?>
</td>
								    	
								    	<td><input type="button" class="bt_remove" onclick="removeComponent(this)" value="remover" /></td>
								    </tr>
								<?php endforeach; endif; unset($_from); ?>
							</tbody>
						</table>
					</div>
				</div>