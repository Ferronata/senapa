{*
 * AvaliacaoNivel => View de manipulação de dados da classe 'AvaliacaoNivel'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('{php}print BASE_URL;{/php}/avaliacaonivel/AvaliacaoNivel', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>AvaliacaoNivel</h1>
				<sub>Gerencimento - AvaliacaoNivel</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="{$avaliacao_nivel->getId()}" />
					<div class="line">
						<label class="label required" for="avaliacao_id">avaliacao_id</label>
						<div class="innerLine">
							<select name=avaliacao_id class="key input pequeno">
								{foreach item=item from=$avaliacao}
									<option value="{$item.id}" {if $item.id == $avaliacao_nivel->getAvaliacaoId()}selected="selected"{/if}>{$item.nome}</option>
								{foreachelse}
									<option>Nenhum Registro</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="nivel">nivel</label>
						<div class="innerLine">
							<input type="text" class="key input pequeno" id="nivel" name="nivel" onkeypress="mascara(this,soNumeros)" maxlength="10" value="{$avaliacao_nivel->getNivel()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="data_nivelamento">data_nivelamento</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="data_nivelamento" name="data_nivelamento" onkeypress="mascara(this,dataHora)" maxlength="19" value="{html_data values=$avaliacao_nivel->getDataNivelamento()}" />
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
