{*
 * AlunoAvaliacao => View de manipulação de dados da classe 'AlunoAvaliacao'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}
 {literal}
<script type="text/javascript">
	function proxima(){
		$('form').action = "javascript: enviarFormAvaliacao('next', 'form')";
		$('form').submit();
	}
	function anterior(){
		$('form').action = "javascript: enviarFormAvaliacao('back', 'form')";
		$('form').submit();
	}
	function finaliza(){
		$('form').action = "javascript: enviarFormAvaliacao('finish', 'form')";
		$('form').submit();
	}
</script>
{/literal}
	
{if $session->iniciar}
	{literal}
	<script type="text/javascript">
		function timer(){
			new Ajax.Updater(
					'timer',
					'/senapa/alunoavaliacao/time', 
					{
						encoding: 'ISO-8859-1',
						evalJS: true
					}
				);
		    setTimeout("timer()",1000);
		}
		timer();
	</script>
	{/literal}
{/if}
{capture name=size}
	{sizeof value=$questoes}
{/capture}

{capture name=controller}
	<span class="buttonLeft"><input type="button" {if $session->atual.numero == 1}disabled="disabled" class="goBackOff"{else}class="goBack"{/if} value="Anterior" onclick="anterior()" /></span>
	{if $session->atual.numero >= $smarty.capture.size}
	<span class="buttonRight"><input type="button" class="finish" value="Finalizar" onclick="finaliza()" /></span>
	{else}
	<span class="buttonRight"><input type="button" class="next" value="Próxima" onclick="proxima()" /></span>
	{/if}
{/capture}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="">
				<div class="alunoAvaliacaoHeader">
					<h1 class="h1AlunoAvaliacao">{$disciplina->getNome()} - {$avaliacao->getNome()}</h1>
					<div class="navegation">
						<span class="alunoAvaliacaoQuestions"><span>Questão:</span> {$session->atual.numero} / {$smarty.capture.size}</span>
						<span class="alunoAvaliacaoTimer"><span>Tempo:</span><label id="timer">&nbsp;{$session->time}</label></span>
					</div>
				</div>
				<div class="alunoAvaliacaoBody innerBody">
					<div class="controller">
						{$smarty.capture.controller}
					</div>
					<div id="question">
						<div class="question content">
							{$session->atual.questao->getDescricao()}
						</div>
						<div class="reply content">
							<div class="line">
									<ul class="popupAlternativas">
										{assign var=alternativas value=$session->atual.questao->getAlternativas()}
										{foreach item=item from=$alternativas->getAlternativas()}
										    <li><label><input type="radio" name="resposta" {if $respostaId == $item->getId()} checked="checked"{/if} value="{$item->getId()}" />{$item->getDescricao()}</label></li>
										{foreachelse}
											<label style="font-weight: 900; font-style: italic; color: #666666;">Questão anulada</label>
										{/foreach}
									</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="alunoAvaliacaoFooter">
					<div class="controller" style="margin-top: 10px;">
						{$smarty.capture.controller}
					</div>
				</div>
			</form>
		</div>
	</div>
</center>