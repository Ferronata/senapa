{*
 * Data de Crica��o - 17/05/2010
 * @author Leonardo Popik e Jo�o Marcos=> Classgen 1.0
 * @version 1.0
 *}
{capture name=nQuestoes}
	{sizeof value=$listaQuestao}
{/capture}
<center>
	<div class="body">
		<div class="innerBody">
			<div id="aba1" class="content">
				<div class="line">
					<label class="label">Aluno</label>
					<div class="innerLine">
						{$usuario->getNome()}
					</div>
				</div>
				<div class="line">
					<label class="label">Disciplina</label>
					<div class="innerLine">
						{$disciplina->getNome()}
					</div>
				</div>
				<div class="line">
					<label class="label">Avalia��o</label>
					<div class="innerLine">
						{$avaliacao->getNome()}
					</div>
				</div>
				<div class="line">
					<label class="label">Tempo de Resolu��o</label>
					<div class="innerLine">
						<table class="datagridObjects" id="values">
							<thead>
								<tr class="gridTitle">
									<td style="text-align: left; padding: 0 2px; width: 80px">Descri��o</td>
									<td class="left">Conte�do</td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="left">Inicio</td>
									<td class="left">{html_data values=$avaliacaoAluno->getDataInicio()}</td>
								</tr>
								<tr>
									<td class="left">Fim</td>
									<td class="left">{html_data values=$avaliacaoAluno->getDataFim()}</td>
								</tr>
								<tr>
									<td class="left">Tempo</td>
									<td class="left">{$tempo}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="line">
					<label class="label">Quest�es Anuladas</label>
					<div class="innerLine">
						{$nulas} / {$smarty.capture.nQuestoes}
					</div>
				</div>
				<div class="line">
					<label class="label">Acertos</label>
					<div class="innerLine">
						{$acertos} / {$soma}
					</div>
				</div>
				<hr />
				<div class="question">
					<ul class="popupQuestions">
				{foreach item=item from=$listaQuestao}
				{assign var=alternativas value=$item.questao->getAlternativas()}
						<li class="popupAlternativas">
							{$item.questao->getDescricao()}
							{if $item.questao->getResposta()}
							<ul>								
								{foreach item=alternativa from=$alternativas->getAlternativas()}
									{assign var=style value=""}
									{assign var=class value=""}
									{if $item.questao->getResposta() == $alternativa->getId()}
										{assign var=style value="font-weight: 900; color: #666666 !important;"}
									{/if}
									{if $item.questao->getResposta() == $alternativa->getId() && $item.resposta->getId() == $item.respostaAluno->getId()}
										{assign var=style value="font-weight: 900; color: navy !important; text-decoration: underline;"}
										{assign var=class value="certo"}
									{/if}
									{if $item.respostaAluno->getId() == $alternativa->getId() && $item.resposta->getId() != $item.respostaAluno->getId()}
										{assign var=style value="color: red !important; text-decoration: underline;"}
										{assign var=class value="errado"}
									{/if}
									<li style="{$style}">{$alternativa->getDescricao()}{if $class}<span class="{$class}">{$class}</span>{/if}</li>
								{/foreach}
							</ul>
							{else}
							<p style="color:#999999; font-style: italic;">Quest�o Anulada</p>
							{/if}
							{if $item.questao->getResposta()}
							<div style="color: navy" class="questionDescription">
								<h3>Explica��o da Resposta</h3>
					    		{$item.questao->getDescricaoResposta()}
					    	</div>
					    	{/if}
						</li>
				{/foreach}
					</ul>
				</div>
			</div>
		</div>
	</div>
</center>