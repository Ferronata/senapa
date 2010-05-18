{*
 * FeedbackAvaliacaoAluno => View de manipulação de dados da classe 'FeedbackAvaliacaoAluno'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/senapa/feedbackavaliacaoaluno/FeedbackAvaliacaoAluno', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>FeedbackAvaliacaoAluno</h1>
				<sub>Gerencimento - FeedbackAvaliacaoAluno</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="{$feedback_avaliacao_aluno->getId()}" />
					<div class="line">
						<label class="label required" for="feedback_avaliacao_alternativa_id">feedback_avaliacao_alternativa_id</label>
						<div class="innerLine">
							<select name=feedback_avaliacao_alternativa_id class="key input pequeno">
								{foreach item=item from=$feedback_avaliacao_alternativa}
									<option value="{$item.id}" {if $item.id == $feedback_avaliacao_aluno->getFeedbackAvaliacaoAlternativaId()}selected="selected"{/if}>{$item.nome}</option>
								{foreachelse}
									<option>Nenhum Registro</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="aluno_avaliacao_id">aluno_avaliacao_id</label>
						<div class="innerLine">
							<select name=aluno_avaliacao_id class="key input pequeno">
								{foreach item=item from=$aluno_avaliacao}
									<option value="{$item.id}" {if $item.id == $feedback_avaliacao_aluno->getAlunoAvaliacaoId()}selected="selected"{/if}>{$item.nome}</option>
								{foreachelse}
									<option>Nenhum Registro</option>
								{/foreach}
							</select>
						</div>
					</div>
				</div>
				<div class="controle">
					<input type="submit" class="button save" value="Salvar" />
					<input type="button" class="button back" value="Sair" onclick="voltarForm();" />
				</div>
			</form>
		</div>
	</div>
</center>
