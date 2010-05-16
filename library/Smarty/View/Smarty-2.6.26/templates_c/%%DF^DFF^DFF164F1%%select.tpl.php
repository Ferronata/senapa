<?php /* Smarty version 2.6.26, created on 2010-03-18 02:48:31
         compiled from function/select.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sizeof', 'function/select.tpl', 17, false),)), $this); ?>
<table>
	<thead>
		<tr class="title">
		<?php $_from = $this->_tpl_vars['titulo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		    <td><?php echo $this->_tpl_vars['item']; ?>
</td>
		<?php endforeach; endif; unset($_from); ?>
		</tr>
	</thead>
	<tbody>
		<?php $_from = $this->_tpl_vars['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
			<tr>
			<?php $_from = $this->_tpl_vars['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['col']):
?>
				<td><?php echo $this->_tpl_vars['col']; ?>
</td>
			<?php endforeach; endif; unset($_from); ?>
			</tr>
		<?php endforeach; else: ?>
			<tr><td colspan="<?php echo smarty_function_sizeof(array('item' => $this->_tpl_vars['titulo']), $this);?>
">Nenhum Registro Encontrado</td></tr>
	    <?php endif; unset($_from); ?>
	</tbody>
</table>