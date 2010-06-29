{*
 * FeedbackAvaliacao => View de manipulação de dados da classe 'FeedbackAvaliacao'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('{php}print BASE_URL;{/php}/feedbackavaliacao/Feedbackavaliacao', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>Feedback de Avaliação</h1>
				<sub>Gerencimento - Feedback de Avaliação</sub>
				<div id="abas" class="divAba">{html_aba value='Pergunta' forid='aba1' classe=selected}{html_aba value='Alternativas' forid='aba2'}</div>
				
				<div id="aba1" class="content">
					<input type="hidden" id="id" name="id" value="{$object->getId()}" />
					<div class="line">
						<label class="label" for="descricao">Pergunta</label>
						<div class="innerLine">
							<textarea class="input normal" id="descricao" name="descricao">{$object->getDescricao()}</textarea>
						</div>
					</div>
				</div>
				<div id="aba2" style="display: none;">{include file='feedbackavaliacaoalternativa/feedbackavaliacaoalternativa.tpl'}</div>
				
				<div class="controle">
					<input type="submit" class="button save" value="Salvar" />
					<input type="button" class="button back" value="Sair" onclick="voltarForm();" />
				</div>
			</form>
		</div>
	</div>
</center>
{literal}
<script type="text/javascript">
	createEditorPanel('basic_text_html','descricao');
</script>
{/literal}
