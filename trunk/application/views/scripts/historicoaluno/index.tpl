<div>
	<h3>Avaliação do Aluno</h3>
	<hr />
	{if $usuario->getPapelId() == $usuario->ENUM('P_S_ADMIN') || $usuario->getPapelId() == $usuario->ENUM('P_ADMIN')}
		{include file='historicoaluno/admin.tpl'}
	{else}
		{if $usuario->getPapelId() == $usuario->ENUM('P_ALUNO')}
			{include file='historicoaluno/aluno.tpl'}
		{else}
			{include file='negado.tpl'}
		{/if}		
	{/if}
</div>