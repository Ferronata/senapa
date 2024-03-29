{*
 * Avaliacao => View de manipula��o de dados da classe 'Avaliacao'
 * Data de Crica��o - 17/05/2010
 * @author Leonardo Popik e Jo�o Marcos=> Classgen 1.0
 * @version 1.0
 *}

<center>
	<div class="body">
		<div class="innerBody">
			<form id="form" name="form" method="post" action="javascript: enviarForm('{php}print BASE_URL;{/php}/avaliacao/Avaliacao', 'form', 'save');" onsubmit="return(runAction(this))">
				<h1>Avalia��o</h1>
				<sub>Gerencimento - Avalia��o</sub>
				
				<div id="abas" class="divAba">{html_aba value='Dados Gerais' forid='aba1' classe=selected}{html_aba value='Conte�do' forid='aba2'}</div>
				
				<div id="aba1" class="content">
					<input type="hidden" id="id" name="id" value="{$object->getId()}" />
					
					{if $usuario->getPapelId() == $usuario->ENUM('P_S_ADMIN') || $usuario->getPapelId() == $usuario->ENUM('P_ADMIN')}
					<div class="line">
						<label class="label" for="professor">Professor</label>
						<div class="innerLine">
							<select id="professor" name=professor class="input medio">
								<option>Selecione um professor</option>
								{foreach item=item from=$professores}
									<option value="{$item->getId()}" {if $professor->getId() == $item->getId()} selected="selected" {/if}>{$item->getNome()}</option>
								{/foreach}
							</select>
						</div>
					</div>
					{elseif $usuario->getPapelId() == $usuario->ENUM('P_PROFESSOR')}
						<div class="line">
							<label class="label" for="professor">Professor</label>
							<div class="innerLine">
								<input type="hidden" id="professor" name="professor" value="{$usuario->getId()}">
								<input type="text" class="input medio" disabled="disabled" value="{$usuario->getNome()}">
							</div>
						</div>
					{else}
						erro
					{/if}
					
					<div class="line">
						<label class="label required" for="nome">Nome</label>
						<div class="innerLine">
							<input type="text" class="key input medio" id="nome" name="nome" maxlength="200" value="{$object->getNome()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="data_inicio">Data de In�cio</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="data_inicio" name="data_inicio" onkeypress="mascara(this,data)" maxlength="10" value="{html_data values=$object->getDataInicio()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="hora_iniccio">Hora de In�cio</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="hora_iniccio" name="hora_iniccio" onkeypress="mascara(this,hora)" maxlength="5" value="{$object->getHoraIniccio()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="data_fim">Data de T�rmino</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="data_fim" name="data_fim" onkeypress="mascara(this,data)" maxlength="10" value="{html_data values=$object->getDataFim()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="hora_fim">Hora de T�rmino</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="hora_fim" name="hora_fim" onkeypress="mascara(this,hora)" maxlength="5" value="{$object->getHoraFim()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="tempo_minimo_prova">Tempo m�nimo da avalia��o</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="tempo_minimo_prova" name="tempo_minimo_prova" onkeypress="mascara(this,hora)" maxlength="5" value="{$object->getTempoMinimoProva()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="tempo_maximo_prova">Tempo m�ximo da avalia��o</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="tempo_maximo_prova" name="tempo_maximo_prova" onkeypress="mascara(this,hora)" maxlength="5" value="{$object->getTempoMaximoProva()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="status">Disponibilidade</label>
						<div class="innerLine">
							<input type="checkbox" class="input" id="status" name="status"  value="1" {if $object->getStatus()}checked="checked"{/if} />
						</div>
					</div>
				</div>
				<div id="aba2" style="display: none;">{include file='disciplina/disciplina_avaliacao.tpl'}</div>
				<div class="controle">
					<input type="submit" class="button save" value="Salvar" />
					<input type="button" class="button back" value="Sair" onclick="voltarForm();" />
				</div>
			</form>
		</div>
	</div>
</center>
