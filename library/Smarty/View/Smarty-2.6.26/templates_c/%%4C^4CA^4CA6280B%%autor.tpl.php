<?php /* Smarty version 2.6.26, created on 2010-03-16 02:46:22
         compiled from admin/autor.tpl */ ?>

				<div class="content">
					<div class="line">
						<label class="label" for="fone">Nome</label>
						<div class="innerLine">
							<input type="text" class="input grande" id="autor_nome" name="autor_nome" maxlength="250" value="<?php echo $this->_tpl_vars['autor']->nome; ?>
" />
						</div>
					</div>
					<div><input type="button" class="addElement" onclick="addComponent($('values'),[$('autor_nome')])" value="Adicionar"></div>
					<table id="values">
						<thead>
							<tr class="gridTitle">
								<td>Autor</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							<?php $_from = $this->_tpl_vars['autores']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
							    <tr>
							    	<td><input type="hidden" name="listaautor_nome[]" value="<?php echo $this->_tpl_vars['item']['nome']; ?>
" /><?php echo $this->_tpl_vars['item']['nome']; ?>
</td>
							    	<td><input type="button" class="bt_remove" onclick="removeComponent(this)" value="remover" /></td>
							    </tr>
							<?php endforeach; endif; unset($_from); ?>
						</tbody>
					</table>
				</div>
				