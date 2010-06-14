{*
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

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
					<label class="label">Avaliação</label>
					<div class="innerLine">
						{$avaliacao->getNome()}
					</div>
				</div>
				<div class="line">
					<label class="label">Tempo de Resolução</label>
					<div class="innerLine">
						Inicio: {html_data values=$avaliacaoAluno->getDataInicio()}<br />
						Fim: {html_data values=$avaliacaoAluno->getDataFim()}<br /> 
					</div>
				</div>
				<hr />
				<div class="question">
					<ul class="popupQuestions">
				{foreach item=item from=$listaQuestao}
						<li>
							{$item.questao->getDescricao()}
							<ul>
								{if $item.questao->getResposta()}
								<li>{$item.resposta}</li>
								{else}
								Questão Anulada
								{/if}
							</ul>
							{if $item.questao->getResposta()}
							<div style="color: navy" class="questionDescription">
								<h3>Descrição da Resposta</h3>
					    		{$item.questao->getDescricaoResposta()}
					    	</div>
					    	<div class="questionDescription">
								<h3>Resposta do Aluno</h3>
								{if $item.questao->getResposta() == $item.alunoResolveQuestao->getQuestaoId()}
									<span style="color:yellow;">{$item.respostaAluno}</span>
								{else}
									<span style="color:red;">{$item.respostaAluno}</span>
					    		{/if}
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