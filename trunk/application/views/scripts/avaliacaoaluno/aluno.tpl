
	<input type="hidden" id="idAluno" name="idAluno" value="{$usuario->getId()}" />
	
	<div id="avaliacoes">

	</div>
{literal}
<script type="text/javascript">
	rerenderAvaliacaoAluno($('idAluno'),$('avaliacoes'));
</script>
{/literal}