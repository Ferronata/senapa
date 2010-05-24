{*
 * Questao => View de manipulação de dados da classe 'Questao'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/senapa/questao/Questao', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>Questao</h1>
				<sub>Gerencimento - Questao</sub>
				
				<div id="abas" class="divAba">{html_aba value='Questão' forid='aba1' classe=selected}{html_aba value='Alternativas' forid='aba2'}</div>
				
				<div id="aba1" class="content">
					<input type="hidden" id="id" name="id" value="{$questao->getId()}" />
					<div class="line">
						<label class="label required" for="descricao">Descrição</label>
						<div class="innerLine">
							<textarea class="key input normal" id="descricao" name="descricao">{$questao->getDescricao()}</textarea>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="descricao_resposta">Explicação da Resposta</label>
						<div class="innerLine">
							<textarea class="key input normal" id="descricao_resposta" name="descricao_resposta">{$questao->getDescricaoResposta()}</textarea>
						</div>
					</div>
				</div>
				
				<div id="aba2" style="display: none;">{include file='questaoalternativa/questaoalternativa.tpl'}</div>
				
				
				<div class="controle">
					<input type="submit" class="button save" value="Salvar" />
					<input type="button" class="button back" value="Sair" onclick="voltarForm();" />
				</div>
			</form>
		</div>
	</div>
</center>
