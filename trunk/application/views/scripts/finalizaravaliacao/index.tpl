<div>
	<h3>Finaliza��o de Avalia��o</h3>
	<hr />
	{if $usuario->getPapelId() == $usuario->ENUM('P_S_ADMIN') || $usuario->getPapelId() == $usuario->ENUM('P_ADMIN')}
		{include file='finalizaravaliacao/admin.tpl'}
	{else}
		{if $usuario->getPapelId() == $usuario->ENUM('P_PROFESSOR')}
			{include file='finalizaravaliacao/professor.tpl'}
		{else}
			{include file='negado.tpl'}
		{/if}		
	{/if}
</div>