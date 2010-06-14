{*
 * FeedbackAvaliacaoAluno => View de manipulação de dados da classe 'FeedbackAvaliacaoAluno'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<!--  --><form id="form" name="form" method="post" action="javascript: enviarForm('/senapa/feedbackavaliacaoaluno/resposta', 'form', 'save');" onsubmit="return(runAction(this))"><!-- -->
			<!--  --<form id="form" name="form" method="post" action="/senapa/feedbackavaliacaoaluno/resposta" onsubmit="return(runAction(this))"><!-- -->
				<h1>Feedback do Aluno</h1>
				<div class="content">
					<div class="line">
						<div class="innerLine">
					{foreach item=item from=$perguntas}
							<ul class="popupQuestions">
								<li>
									<input type="hidden" name="id[]" value="{$item->getId()}" />{$item->getDescricao()}
									<ul class="popupAlternativas">
									{assign var=alternativas value=$item->getAlternativas()}
									{foreach item=resposta from=$alternativas->getAlternativas()}
									    <li><label><input type="radio" name="alternativa{$item->getId()}" value="{$resposta->getId()}" />{$resposta->getDescricao()}</label></li>
									{foreachelse}
										Não Possui alternativas
									{/foreach}
									</ul>
								</li>
							</ul>
					{foreachelse}
						Nenhum Registro
					{/foreach}	
						</div>
					</div>				
				</div>
				<div class="controle">
					<input type="submit" class="button save" value="Finalizar" />
				</div>
			</form>
		</div>
	</div>
</center>
