{literal}
<style type="text/css">
.emExecucao span, .concluido span, .aFazer span{
	color:#FCFCFC;
}
.emExecucao span{
	background: yellow;
	color:#666666;
}
.concluido span{
	background: green;
	text-decoration: line-through;
}
.aFazer span{background: red;}

</style>
{/literal}
<h1>Bem Vindo</h1>

<h3>Tarefas</h3>
<div style="background: #FCFCFC; border: 1px solid #999999; padding: 10px">
	<h4>Administrativo</h4>
	<ul>
		<li class="concluido"><span>Institui��o</span></li>
		<li class="concluido"><span>Situa��o de Avalia��o</span></li>
		<li class="concluido"><span>Disciplina</span></li>
		<li class="emExecucao"><span>Professor</span></li>
		
		<li class="emExecucao"><span>Aluno</span></li>
		
	</ul>
	<h4>Professor</h4>
	<ul>
		<li class="emExecucao"><span>Assunto</span></li>
		<li class="emExecucao"><span>Quest�o</span></li>
	</ul>
	<h4>Aluno</h4>
	<ul>
		<li class="aFazer"><span>Avalia��o</span></li>
		<li class="aFazer"><span>Avalia��es</span></li>
		<li class="aFazer"><span>Hist�rico</span></li>
	</ul>
</div>