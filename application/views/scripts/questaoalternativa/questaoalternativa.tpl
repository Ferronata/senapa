{*
 * QuestaoAlternativa => View de manipulação de dados da classe 'QuestaoAlternativa'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/senapa/questaoalternativa/QuestaoAlternativa', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>QuestaoAlternativa</h1>
				<sub>Gerencimento - QuestaoAlternativa</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="{$questao_alternativa->getId()}" />
					<div class="line">
						<label class="label required" for="questao_id">questao_id</label>
						<div class="innerLine">
							<select name=questao_id class="key input pequeno">
								{foreach item=item from=$questao}
									<option value="{$item.id}" {if $item.id == $questao_alternativa->getQuestaoId()}selected="selected"{/if}>{$item.nome}</option>
								{foreachelse}
									<option>Nenhum Registro</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="descricao">descricao</label>
						<div class="innerLine">
							<textarea class="key input normal" id="descricao" name="descricao">{$questao_alternativa->getDescricao()}</textarea>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="date_create">date_create</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="date_create" name="date_create" onkeypress="mascara(this,dataHora)" maxlength="19" value="{html_data values=$questao_alternativa->getDateCreate()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="date_update">date_update</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="date_update" name="date_update" onkeypress="mascara(this,dataHora)" maxlength="19" value="{html_data values=$questao_alternativa->getDateUpdate()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="date_delete">date_delete</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="date_delete" name="date_delete" onkeypress="mascara(this,dataHora)" maxlength="19" value="{html_data values=$questao_alternativa->getDateDelete()}" />
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
