<div>
	<h3>Avalia��o do Aluno</h3>
	<hr />
	{if $usuario->getPapelId() == $usuario->ENUM('P_S_ADMIN') || $usuario->getPapelId() == $usuario->ENUM('P_ADMIN')}
		{include file='avaliacaoaluno/admin.tpl'}
	{else}
		{if $usuario->getPapelId() == $usuario->ENUM('P_ALUNO')}
			{include file='avaliacaoaluno/aluno.tpl'}
		{else}
			{include file='negado.tpl'}
		{/if}		
	{/if}
</div>