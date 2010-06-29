
	<input type="hidden" id="idProfessor" name="idProfessor" value="{$usuario->getId()}" />
	
	<div id="avaliacoes">

	</div>
{literal}
<script type="text/javascript">
	rerenderFinalizarAvaliacao($('idProfessor'),$('avaliacoes'));
</script>
{/literal}