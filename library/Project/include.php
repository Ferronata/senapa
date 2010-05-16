<?php

// PASTAS A SEREM VARRIDAS EM BUSCA DE ARQUIVOS .php
$include = array
	(
		"application". SYS_BAR ."models". SYS_BAR,
		"library". SYS_BAR ."Project". SYS_BAR .'class' .SYS_BAR
	);

foreach($include as $dir){
	$includes = scandir(PROJECT_ROOT.SYS_BAR.$dir);
	foreach($includes as $linha){
		$tmp = @end(explode(".",$linha));				
		if(is_file(PROJECT_ROOT.SYS_BAR.$dir.$linha) && $tmp == 'php')
			Zend_Loader::loadClass(str_replace(".php","",$linha));
	}
}
