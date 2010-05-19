{*
 * Avaliacao => View de manipulação de dados da classe 'Avaliacao'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('/senapa/avaliacao/Avaliacao', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>Avaliação</h1>
				<sub>Gerencimento - Avaliação</sub>
				<div class="content">
					<input type="hidden" id="id" name="id" value="{$avaliacao->getId()}" />
					<div class="line">
						<label class="label required" for="avaliacao_situacao_id">avaliacao_situacao_id</label>
						<div class="innerLine">
							<select name=avaliacao_situacao_id class="key input pequeno">
								{foreach item=item from=$avaliacao_situacao}
									<option value="{$item.id}" {if $item.id == $avaliacao->getAvaliacaoSituacaoId()}selected="selected"{/if}>{$item.nome}</option>
								{foreachelse}
									<option>Nenhum Registro</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="line">
						<label class="label required" for="nome">nome</label>
						<div class="innerLine">
							<input type="text" class="key input medio" id="nome" name="nome" maxlength="200" value="{$avaliacao->getNome()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="data_inicio">data_inicio</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="data_inicio" name="data_inicio" onkeypress="mascara(this,data)" maxlength="10" value="{html_data values=$avaliacao->getDataInicio()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="hora_iniccio">hora_iniccio</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="hora_iniccio" name="hora_iniccio" onkeypress="mascara(this,hora)" maxlength="5" value="{$avaliacao->getHoraIniccio()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="data_fim">data_fim</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="data_fim" name="data_fim" onkeypress="mascara(this,data)" maxlength="10" value="{html_data values=$avaliacao->getDataFim()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="hora_fim">hora_fim</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="hora_fim" name="hora_fim" onkeypress="mascara(this,hora)" maxlength="5" value="{$avaliacao->getHoraFim()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="tempo_minimo_prova">tempo_minimo_prova</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="tempo_minimo_prova" name="tempo_minimo_prova" onkeypress="mascara(this,hora)" maxlength="5" value="{$avaliacao->getTempoMinimoProva()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="tempo_maximo_prova">tempo_maximo_prova</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="tempo_maximo_prova" name="tempo_maximo_prova" onkeypress="mascara(this,hora)" maxlength="5" value="{$avaliacao->getTempoMaximoProva()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="status">status</label>
						<div class="innerLine">
							<input type="checkbox" class="input" id="status" name="status"  value="1" {if $avaliacao->getStatus()}checked="checked"{/if} />
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
