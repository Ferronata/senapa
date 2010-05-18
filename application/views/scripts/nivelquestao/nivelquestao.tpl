{*
 * NivelQuestao => View de manipulação de dados da classe 'NivelQuestao'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/senapa/nivelquestao/NivelQuestao', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>NivelQuestao</h1>
				<sub>Gerencimento - NivelQuestao</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="{$nivel_questao->getId()}" />
					<div class="line">
						<label class="label required" for="questao_id">questao_id</label>
						<div class="innerLine">
							<select name=questao_id class="key input pequeno">
								{foreach item=item from=$questao}
									<option value="{$item.id}" {if $item.id == $nivel_questao->getQuestaoId()}selected="selected"{/if}>{$item.nome}</option>
								{foreachelse}
									<option>Nenhum Registro</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="nivel">nivel</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="nivel" name="nivel" onkeypress="mascara(this,soNumeros)" maxlength="10" value="{$nivel_questao->getNivel()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="data_nivelamento">data_nivelamento</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="data_nivelamento" name="data_nivelamento" onkeypress="mascara(this,dataHora)" maxlength="19" value="{html_data values=$nivel_questao->getDataNivelamento()}" />
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
