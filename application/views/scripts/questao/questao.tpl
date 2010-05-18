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
				<div class="content">
					<input type="hidden" id="id" name="id" value="{$questao->getId()}" />
					<div class="line">
						<label class="label required" for="descricao">descricao</label>
						<div class="innerLine">
							<textarea class="key input normal" id="descricao" name="descricao">{$questao->getDescricao()}</textarea>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="resposta">resposta</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="resposta" name="resposta" onkeypress="mascara(this,soNumeros)" maxlength="10" value="{$questao->getResposta()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="descricao_resposta">descricao_resposta</label>
						<div class="innerLine">
							<textarea class="key input normal" id="descricao_resposta" name="descricao_resposta">{$questao->getDescricaoResposta()}</textarea>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="date_create">date_create</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="date_create" name="date_create" onkeypress="mascara(this,dataHora)" maxlength="19" value="{html_data values=$questao->getDateCreate()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="date_update">date_update</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="date_update" name="date_update" onkeypress="mascara(this,dataHora)" maxlength="19" value="{html_data values=$questao->getDateUpdate()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="date_delete">date_delete</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="date_delete" name="date_delete" onkeypress="mascara(this,dataHora)" maxlength="19" value="{html_data values=$questao->getDateDelete()}" />
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
