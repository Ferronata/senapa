<?php /* Smarty version 2.6.26, created on 2010-04-13 21:48:21
         compiled from admin/professordisciplina.tpl */ ?>
				<div class="content">
					<input type="hidden" id="professor_disciplina_id" name="professor_disciplina_id" value="<?php echo $this->_tpl_vars['professor_disciplina']->id; ?>
" />
					
					<div class="line">
						<label class="label required" for="Escola">Escola</label>
						<div class="innerLine">
							<select name=Escola class="input pequeno" onchange="listRender(this,new Array(new Objeto('Curso','Curso','nome'),new Objeto('AnoLetivo','AnoLetivo','ano')))">
								<option>Selecione</option>
								<?php $_from = $this->_tpl_vars['escolas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['escola']['id']; ?>
" <?php if ($this->_tpl_vars['item']['escola']['id'] == $this->_tpl_vars['professor_disciplina']->disciplina_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['pessoa']['nome']; ?>
</option>
								<?php endforeach; endif; unset($_from); ?>
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="Curso">Curso</label>
						<div class="innerLine">
							<select id="Curso" name=Curso class="input pequeno">
								<?php $_from = $this->_tpl_vars['cursos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['professor_disciplina']->disciplina_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
</option>
								<?php endforeach; else: ?>
									<option>Nenhum Registro</option>
								<?php endif; unset($_from); ?>
							</select>
						</div>
					</div>
					
					<div class="line">
						<label class="label required" for="AnoLetivo">Ano Letivo</label>
						<div class="innerLine">
							<select id="AnoLetivo" name=AnoLetivo class="key input pequeno">
								<?php $_from = $this->_tpl_vars['ano_letivo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['id']; ?>
" <?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['professor_disciplina']->ano_letivo_id): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['nome']; ?>
</option>
								<?php endforeach; else: ?>
									<option>Nenhum Registro</option>
								<?php endif; unset($_from); ?>
							</select>
						</div>
					</div>
					
					<div class="line">
						<label class="label required" for="disciplina_id">Disciplinas</label>
						<div class="innerLine">
							<div class="checkboxList">
								<label><input type="checkbox" name="disciplinas[]" value="1" />Matemática</label>
							</div>
						</div>
					</div>
				</div>