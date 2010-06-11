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
</script>
{/literal}
	
{if !$session->inicio}
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
	<span class="buttonLeft"><input type="button" {if $session->questaoAtual.numero == 1}disabled="disabled" class="backOff"{else}class="back"{/if} value="Anterior" onclick="anterior()" /></span>
	<span class="buttonRight"><input type="button" {if $session->questaoAtual.numero == $smarty.capture.size}disabled="disabled" class="nextOff"{else}class="next"{/if} value="Próxima" onclick="proxima()" /></span>
{/capture}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="">
				<div class="alunoAvaliacaoHeader">
					<h1 class="h1AlunoAvaliacao">{$disciplina->getNome()} - {$avaliacao->getNome()}</h1>
					<div class="navegation">
						<span class="alunoAvaliacaoQuestions"><span>Questão:</span> {$session->questaoAtual.numero} / {$smarty.capture.size}</span>
						<span class="alunoAvaliacaoTimer"><span>Tempo:</span><label id="timer">&nbsp;{$time}</label></span>
					</div>
				</div>
				<div class="alunoAvaliacaoBody innerBody">
					<div class="controller">
						{$smarty.capture.controller}
					</div>
					<div id="question">
						<div class="question content">
							{$session->questaoAtual.questao->getDescricao()}
						</div>
						<div class="reply content">
							<div class="line">
									<ul class="popupAlternativas">
										{assign var=alternativas value=$questaoAtual.questao->getAlternativas()}
										{foreach item=item from=$alternativas->getAlternativas()}
										    <li><label><input type="radio" name="resposta" value="{$item->getId()}" />{$item->getDescricao()}</label></li>
										{foreachelse}
											<li><label>Questão anulada</label></li>
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