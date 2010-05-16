<?php /* Smarty version 2.6.26, created on 2010-03-09 02:19:40
         compiled from classgen/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup', 'classgen/index.tpl', 9, false),)), $this); ?>
<link rel="stylesheet" type="text/css" href="<?php print BASE_URL; ?>/public/css/classgen.css" />
<script type="text/javascript" src="<?php print BASE_URL; ?>/public/js/lib/prototype-1.6.0.3.js"></script>
<script type="text/javascript" src="<?php print BASE_URL; ?>/public/js/classgen.js"></script>

<a href="http://www.google.com.br" <?php echo smarty_function_popup(array('text' => 'Meu  Teste'), $this);?>
>Google</a>

<A href="mypage.html" <?php echo smarty_function_popup(array('sticky' => true,'caption' => 'mypage contents','text' => "<UL><LI>links<LI>pages<LI>images</UL>",'snapx' => 10,'snapy' => 10), $this);?>
>mypage</A>

<form id="form" name="form" method="post">
	<select id="tabelas" name="tabelas">
	<?php $_from = $this->_tpl_vars['tabelas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['lista'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['lista']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tabela']):
        $this->_foreach['lista']['iteration']++;
?>
		<option value="<?php echo $this->_tpl_vars['tabela'][$this->_tpl_vars['db_name']]; ?>
"><?php echo $this->_tpl_vars['tabela'][$this->_tpl_vars['db_name']]; ?>
</option>
	<?php endforeach; else: ?>
		<option value="-1">Não há tabela</option>
	<?php endif; unset($_from); ?>
	</select>
	
	<input type="submit" value="Ok" />
	<input type="button" value="All Class" onClick="allTables()" />
	<input type="button" value="View All Class" onClick="allViewTables()" />
</form>
<?php if ($this->_tpl_vars['msg']): ?>
<div style="background: #F5F5F5; border: 1px solid #999999; margin: 0; padding: 10px;">
	<?php echo $this->_tpl_vars['msg']; ?>

</div>
<?php endif; ?>