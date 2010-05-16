<?php /* Smarty version 2.6.26, created on 2010-03-16 02:19:46
         compiled from admin/livro.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_aba', 'admin/livro.tpl', 14, false),array('function', 'html_data', 'admin/livro.tpl', 84, false),)), $this); ?>

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/sgaPhp/admin/Livro', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>Livro</h1>
				<sub>Gerencimento - Livro</sub>
				<div id="abas" class="divAba"><?php echo smarty_function_html_aba(array('value' => 'Controle','forid' => 'aba1','classe' => 'selected'), $this);?>
<?php echo smarty_function_html_aba(array('value' => 'Dados','forid' => 'aba2'), $this);?>
<?php echo smarty_function_html_aba(array('value' => 'Complemento','forid' => 'aba3'), $this);?>
<?php echo smarty_function_html_aba(array('value' => 'Autor','forid' => 'aba4'), $this);?>
</div>
				<div id="aba1">
					<div class="content">
						<input type="hidden" id="id" name="id" value="<?php echo $this->_tpl_vars['livro']->id; ?>
" />
						<div class="line">
							<label class="label required" for="Biblioteca">Biblioteca</label>
							<div class="innerLine">
								<select name=Biblioteca class="key input pequeno" onchange="rerender(this,[<?php echo 'Midia'; ?>
,<?php echo 'Segmento'; ?>
])">
									<option>Selecione</option>
									<?php $_from = $this->_tpl_vars['biblioteca']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
										<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['livro']->biblioteca_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
</option>
									<?php endforeach; endif; unset($_from); ?>
								</select>
							</div>
						</div>
						<div class="line">
							<label class="label required" for="Midia">Midia</label>
							<div class="innerLine">
								<select id="Midia" name=Midia class="key input pequeno" onchange="rerender(this,[<?php echo 'Segmento'; ?>
])">
									<?php $_from = $this->_tpl_vars['midias']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
										<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['midia']->id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
</option>
									<?php endforeach; else: ?>
										<option>Nenhum Registro</option>
									<?php endif; unset($_from); ?>
								</select>
							</div>
						</div>
						<div class="line">
							<label class="label required" for="Segmento">Segmento</label>
							<div class="innerLine">
								<select id="Segmento" name=Segmento class="key input pequeno">
									<?php $_from = $this->_tpl_vars['segmentos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
										<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['segmento']->id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
</option>
									<?php endforeach; else: ?>
										<option>Nenhum Registro</option>
									<?php endif; unset($_from); ?>
								</select>
							</div>
						</div>
						<div class="line">
							<label class="label required" for="livro_situacao_id">livro_situacao_id</label>
							<div class="innerLine">
								<select name=livro_situacao_id class="key input pequeno">
									<?php $_from = $this->_tpl_vars['livro_situacao']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
										<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['livro']->livro_situacao_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
</option>
									<?php endforeach; else: ?>
										<option>Nenhum Registro</option>
									<?php endif; unset($_from); ?>
								</select>
							</div>
						</div>
						<div class="line">
							<label class="label required" for="codigo">codigo</label>
							<div class="innerLine">
								<input type="text" class="key input normal" id="codigo" name="codigo" maxlength="100" value="<?php echo $this->_tpl_vars['livro']->codigo; ?>
" />
							</div>
						</div>
						<div class="line">
							<label class="label required" for="titulo">titulo</label>
							<div class="innerLine">
								<input type="text" class="key input grande" id="titulo" name="titulo" maxlength="250" value="<?php echo $this->_tpl_vars['livro']->titulo; ?>
" />
							</div>
						</div>
					</div>
				</div>
				<div  id="aba2" style="display:none;">
					<div class="content">	
						<div class="line">
							<label class="label required" for="dt_aquisicao">dt_aquisicao</label>
							<div class="innerLine">
								<input type="text" class="key input normal" id="dt_aquisicao" name="dt_aquisicao" onkeypress="mascara(this,data)" maxlength="10" value="<?php echo smarty_function_html_data(array('values' => $this->_tpl_vars['livro']->dt_aquisicao), $this);?>
" />
							</div>
						</div>
						<div class="line">
							<label class="label required" for="localizacao">localizacao</label>
							<div class="innerLine">
								<input type="text" class="key input medio" id="localizacao" name="localizacao" maxlength="150" value="<?php echo $this->_tpl_vars['livro']->localizacao; ?>
" />
							</div>
						</div>
						<div class="line">
							<label class="label" for="numero_exemplar">numero_exemplar</label>
							<div class="innerLine">
								<input type="text" class="input normal" id="numero_exemplar" name="numero_exemplar" maxlength="20" value="<?php echo $this->_tpl_vars['livro']->numero_exemplar; ?>
" />
							</div>
						</div>
						<div class="line">
							<label class="label" for="descricao">descricao</label>
							<div class="innerLine">
								<textarea class="input normal" id="descricao" name="descricao"><?php echo $this->_tpl_vars['livro']->descricao; ?>
</textarea>
							</div>
						</div>
					</div>
				</div>
				<div  id="aba3" style="display:none;">
					<div class="content">	
						<div class="line">
							<label class="label" for="edicao">edicao</label>
							<div class="innerLine">
								<input type="text" class="input normal" id="edicao" name="edicao" maxlength="100" value="<?php echo $this->_tpl_vars['livro']->edicao; ?>
" />
							</div>
						</div>
						<div class="line">
							<label class="label" for="volume">volume</label>
							<div class="innerLine">
								<input type="text" class="input normal" id="volume" name="volume" maxlength="100" value="<?php echo $this->_tpl_vars['livro']->volume; ?>
" />
							</div>
						</div>
						<div class="line">
							<label class="label" for="editora">editora</label>
							<div class="innerLine">
								<input type="text" class="input medio" id="editora" name="editora" maxlength="150" value="<?php echo $this->_tpl_vars['livro']->editora; ?>
" />
							</div>
						</div>
						<div class="line">
							<label class="label" for="n_edicao">n_edicao</label>
							<div class="innerLine">
								<input type="text" class="input normal" id="n_edicao" name="n_edicao" maxlength="100" value="<?php echo $this->_tpl_vars['livro']->n_edicao; ?>
" />
							</div>
						</div>
						<div class="line">
							<label class="label" for="mes_edicao">mes_edicao</label>
							<div class="innerLine">
								<input type="text" class="input pequeno" id="mes_edicao" name="mes_edicao" onkeypress="mascara(this,soNumeros)" maxlength="10" value="<?php echo $this->_tpl_vars['livro']->mes_edicao; ?>
" />
							</div>
						</div>
						<div class="line">
							<label class="label" for="ano_edicao">ano_edicao</label>
							<div class="innerLine">
								<input type="text" class="input pequeno" id="ano_edicao" name="ano_edicao" onkeypress="mascara(this,soNumeros)" maxlength="10" value="<?php echo $this->_tpl_vars['livro']->ano_edicao; ?>
" />
							</div>
						</div>
					</div>
				</div>
				<div  id="aba4" style="display:none;"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin/autor.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
				<div class="controle">
					<input type="submit" class="button save" value="Salvar" />
					<input type="button" class="button back" value="Sair" onclick="voltarForm();" />
				</div>
			</form>
		</div>
	</div>
</center>